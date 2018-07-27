<?php

namespace App\Http\Controllers;
use DateTimeZone;
use App\BHP;
use App\Stasiun;
use App\komulatif_bhp;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BhpController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function stasiun(){
    return $this->belongsTo(Stasiun::class);
  }
  public function validasi(Request $request){
    return $request->validate([
      'tanggal'=>'required',
      'stasiun'=>'required',
      'pendapatan'=>'required|min:0',
    ]);
  }
  public function getStasiun(Request $request){
    $tanggal=Carbon::parse($request['tanggal'])->todatestring();
    return $this->cekStasiun($tanggal);
  }
  public function cekStasiun($tanggal){
    $BHP = new BHP;
    $BHP=$BHP->getStasiun($tanggal);
    $stasiun = new Stasiun;
    $stasiun=$stasiun->ambilBarang();
    return $this->getDataStasiun($BHP,$stasiun);
  }
  public function getDataStasiun($BHP,$stasiun){
    $a=0;
    foreach ($stasiun as $i) {
      $b=0;
      foreach ($BHP as $j) {
        if($i->id==$j['stasiun_id']){
          unset($stasiun[$a]);
          unset($BHP[$b]);
          break;
        }
        $b++;
      }
      $a++;
    }
    return $stasiun;

  }

  public function viewTambah(){
    $stasiun=new Stasiun;
    $data_stasiun=$this->cekStasiun(Carbon::now(new DateTimeZone('Asia/Jakarta'))->todatestring());
    $tanggal=Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('d-m-Y');
    return view('tambah_data_BHP',compact('data_stasiun','tanggal'));
  }
  //menambahkan data dan mengembalikannya ke tampilan inputan awal
  public function tambah(Request $request){
   //dd($request);
   $this->validasi($request);
   $request=$this->konversi($request);

   $bhp=new BHP;
   $komulatif_bhp = new komulatif_bhp;

   $tanggal=Carbon::parse($request->tanggal);
   $tahun=$tanggal->year;
   $tanggal=$tanggal->todatestring();

   $sekarang=false;
   $setelah=false;
   $kemarin=false;

   $bhp->tambah($request);

   if($komulatif_bhp->ambilDataTahun($tahun)->first()!=null){
     if($komulatif_bhp->ambilDataSetelah($tanggal,$tahun)->first()!=null){
       //hari ini + setelah
       $setelah=true;
     }
     if($komulatif_bhp->ambilDatasekarang($tanggal,$tahun)!=null){
       $sekarang=true;
     }
     if($komulatif_bhp->ambilDataKemarin($tanggal,$tahun)->first()!=null){
       $kemarin=true;
     }

     if($setelah==true){
       if($sekarang==true){
         //sekarang+=request
         $komulatif_bhp->tambahData($request,$tanggal);
         //setelah+request
       }elseif($kemarin==true&&$sekarang==false){
         $komulatif_bhp->tambahDataKemarin($request,$tanggal,$tahun);
       }else{
         //sekarang=request
         $komulatif_bhp->tambahDataSekarang($request);
         //setelah+=sekarang
       }
       $komulatif_bhp->update_data_tambah($request,$tanggal,$tahun);
     }else if($setelah==false && $kemarin==true){
       if($sekarang==true){
         //data_sekarang+request
         $komulatif_bhp->tambahData($request,$tanggal);
       }else{
         //kemarin + data request
         $komulatif_bhp->tambahDataKemarin($request,$tanggal,$tahun);
       }
     }else if($setelah==false&&$kemarin==false&&$sekarang==true){
       $komulatif_bhp->tambahData($request,$tanggal);
     }
   }else{
     //tambah data sekarang
     $komulatif_bhp->tambahDataSekarang($request);
   }
   return redirect()->action('BhpController@viewTambah');
  }
  //menampilkan data yg sdh ditambahkan ke halaman lihat_data_barang
  public function lihatData(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal)->todatestring();
    }else {
      $tanggal=Carbon::now()->todatestring();
    }

    $bhp=new BHP;
    $data_bhp=$bhp->ambilBHP($tanggal);
    $stasiun=new Stasiun;
    $data_stasiun=$stasiun->ambilBarang();
  //  dd($data_stasiun);
    //mengembalikan bebrapa nilai dr data bhp yg diarahkan ke lihat
    return view('lihat_all_data_bhp',compact('data_bhp','tanggal','data_stasiun'));
  }
  public function lihatDataByDate(Request $request){
    return $this->lihatData($request);
  }
  public function viewEdit(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal)->todatestring();
    }else {
      $tanggal=Carbon::now()->todatestring();
    }
    $bhp= new BHP;
    $data_bhp=$bhp->ambilBHPid($request->id);
    $stasiun=new Stasiun;
    $data_stasiun=$stasiun->ambilBarang();
    // $tanggal=Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('d-m-Y');
    //dd($data_bhp);
    return view('edit_BHP',compact('data_stasiun','tanggal','data_bhp'));
  }
  public function edit(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else {
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    $request=$this->konversi($request);
    $bhp= new BHP;
    $data_sekarang=$bhp->ambilBHPid($request->id);
    $bhp->edit($request,$tanggal);
    $komulatif_bhp=new komulatif_bhp;
    $selisih=$komulatif_bhp->selisih($request,$data_sekarang);
    //dd($selisih);
    $komulatif_bhp->update_data($selisih,$tanggal,$tahun);
    //dd($request);
    return redirect()->action('BhpController@lihatData');
  }
  public function delete_data(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
      $bhp= new BHP;
    $data_sekarang=$bhp->ambilBHP($tanggal);
  $bhp->delete_data($request->tanggal,$request->id);
    $request->pendapatan=0;
    $komulatif_bhp=new komulatif_bhp;
    $selisih=$komulatif_bhp->selisih($request,$data_sekarang);
  //dd($selisih);
    $komulatif_bhp->update_data($selisih,$tanggal,$tahun);
    return redirect()->action('BhpController@lihatData');
  }
  public function cekTombol(Request $request){
    if($request->edit!=null){
      return $this->viewEdit($request);
    }elseif ($request->delete!=null) {
      return $this->delete_data($request);
    }
  }
  public function konversi(Request $request){
      $request->pendapatan=angkatointeger($request->pendapatan);
        //dd($request->Volume_Semen);
      return $request;
  }
}
