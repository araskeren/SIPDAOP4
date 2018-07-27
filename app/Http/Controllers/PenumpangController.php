<?php

namespace App\Http\Controllers;
use DateTimeZone;
use Carbon\Carbon;
use App\Target;
use Illuminate\Http\Request;
use App\Penumpang;
use App\Stasiun;
use App\komulatif_penumpang;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\MessageBag;
class PenumpangController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function indexPenumpang(){
      $stasiun = new Stasiun;
      // $data_stasiun= $this->cekStasiun(Carbon::now(new DateTimeZone('Asia/Jakarta'))->todatestring());
      $tanggal=Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('d-m-Y');
      return view('tambah_data_penumpang',compact('tanggal'));
    }
    public function tambah(Request $request){
      $this->validasi($request);
      $penumpang=new Penumpang;
      $komulatif_penumpang=new komulatif_penumpang;
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();

      if($this->duplikasi($penumpang,$tanggal,$request->stasiun)==false){
          $tanggal=Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('d-m-Y');
          $errors = new MessageBag;
          $errors->add('duplikasi_data', 'Duplikasi Data Pada Tanggal '.tanggal_indo($tanggal));
          return view('tambah_data_penumpang',compact('tanggal'))->withErrors($errors);
      }
      $request=$this->konversi($request);
      $penumpang->tambah($request);

      $sekarang=false;
      $setelah=false;
      $kemarin=false;
      if($komulatif_penumpang->ambilDataTahun($tahun)->first()!=null){
        if($komulatif_penumpang->ambilDataSetelah($tanggal,$tahun)->first()!=null){
          //hari ini + setelah
          $setelah=true;
        }
        if($komulatif_penumpang->ambilDatasekarang($tanggal,$tahun)->first()!=null){
          $sekarang=true;
        }
        if($komulatif_penumpang->ambilDatakemarin($tanggal,$tahun)->first()!=null){
          //kemarin + sekarang
          $kemarin=true;
        }
        //dd($setelah);
        if($setelah==true){
          if($sekarang==true){
            //sekarang+=request
            $komulatif_penumpang->tambahData($request,$tanggal);
            //setelah+request
          }else{
            //sekarang=request
            $komulatif_penumpang->tambahDataSekarang($request);
            //setelah+=sekarang
          }
          $komulatif_penumpang->update_data_tambah($request,$tanggal,$tahun);
        }else if($setelah==false && $kemarin==true){
          if($sekarang==true){
            //data_sekarang+request
            $komulatif_penumpang->tambahData($request,$tanggal);
          }else{
            //kemarin + data request
            $komulatif_penumpang->tambahDataKemarin($request,$tanggal,$tahun);
          }
        }else if($setelah==false&&$kemarin==false&&$sekarang==true){
          $komulatif_penumpang->tambahData($request,$tanggal);
        }
      }else{
        //tambah data sekarang
        $komulatif_penumpang->tambahDataSekarang($request);
      }

      return redirect()->action('PenumpangController@lihatKomulatif');
    }
    public function lihat(Request $request){
      if(isset($request))
      {
        $tanggal=Carbon::parse($request->tanggal)->todatestring();
      }else {
        $tanggal=Carbon::now()->todatestring();
      }
      $penumpang = new Penumpang;
      $data=$penumpang->getData($tanggal);
      $stasiun=new Stasiun;
      $data_stasiun=$stasiun->ambilPenumpang();

      return view('lihat_all_data_penumpang',compact('data','data_stasiun','tanggal'));
    }
    public function lihatDetail(Request $request){
      if($request->isMethod('post'))
      {
        $tanggal=Carbon::parse($request->tanggal)->todatestring();
        $stasiun_id=$request->stasiun_id;
      }else {
        $tanggal=Carbon::now()->todatestring();
        $stasiun_id=1;
      }

      $penumpang = new Penumpang;
      $data=$penumpang->getDataDetail($tanggal,$stasiun_id);
      $stasiun=new Stasiun;
      $data_stasiun=$stasiun->ambilPenumpang();
      return view('lihat_data_penumpang',compact('data','tanggal','data_stasiun'));
    }
    public function lihatKomulatif(Request $request){
      if(isset($request))
      {
        $tanggal=Carbon::parse($request->tanggal);
        $tahun=Carbon::parse($request->tanggal)->year;
        $tanggal=$tanggal->todatestring();
      }else {
        $tanggal=Carbon::now();
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }
      $stasiun_id=0;
      $penumpang = new Penumpang;
      $data_penumpang=$penumpang->getDataDetail($tanggal,$stasiun_id);
      //dd($data_penumpang);
      $komulatif_penumpang=new komulatif_penumpang;
      $data_komulatif_penumpang=$komulatif_penumpang->ambilDatasekarang($tanggal);
      $target_penumpang=new Target;
      $target_penumpang=$target_penumpang->getDataPenumpang($tahun);

      if(count($target_penumpang)<=0){
        return 'Silahkan Untuk Menghubungi Admin Terlebih Dahulu Agar Data Target Tahun '.$tahun.' Untuk Di Inputkan Terlebih Dahulu';
      }
      return view('lihat_data_penumpang_komulatif',compact('data_penumpang','data_komulatif_penumpang','tanggal','target_penumpang'));
    }
    public function viewedit(Request $request){
      if($request->isMethod('post'))
      {
        $tanggal=Carbon::parse($request->tanggal)->todatestring();
      }else {
        $tanggal=Carbon::now()->todatestring();
      }
      $stasiun_id=0;
      $stasiun = new Stasiun;
      $penumpang=new Penumpang;
      $data=$penumpang->getDataDetail($tanggal,$stasiun_id);
      $data_stasiun=$stasiun->ambilPenumpang();
      //dd($data[0]->stasiun_id);

      return view('edit_penumpang',compact('data_stasiun','data','tanggal'));
    }
    public function edit(Request $request){
      if($request->isMethod('post'))
      {
        $stasiun_id=$request->stasiun;
        $tanggal=Carbon::parse($request->tanggal);
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }else {
        $stasiun_id=0;
        $tanggal=Carbon::now();
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }
      $request=$this->konversi($request);
      //Mengupdate data penumpang
      $penumpang = new Penumpang;
      //$data_sekarang=$penumpang->getData($tanggal);

      $penumpang->edit($request,$tanggal,$stasiun_id);
      //Mengupdate Data Komulatif dengan data terbaru
      $komulatif_penumpang=new komulatif_penumpang;
      $selisih=$komulatif_penumpang->selisih($request,$data_sekarang);
      $komulatif_penumpang->update_data($selisih,$tanggal,$tahun);

      return redirect()->action('PenumpangController@lihatKomulatif');;
    }

    public function delete_data(Request $request){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
      $penumpang=new Penumpang;
      $data_sekarang=$penumpang->getData($tanggal);
      $penumpang->delete_data($request->tanggal,$request->stasiun_id);
      $request->Volume_Eksekutif=0;
      $request->Pendapatan_Eksekutif=0;
      $request->Volume_Bisnis=0;
      $request->Pendapatan_Bisnis=0;
      $request->Volume_Ekonomi=0;
      $request->Pendapatan_Ekonomi=0;
      $request->Volume_Lokal=0;
      $request->Pendapatan_Lokal=0;
      //lanjutkan
      $komulatif_penumpang=new komulatif_penumpang;
      $selisih=$komulatif_penumpang->selisih($request,$data_sekarang);
      //dd($selisih);
      $komulatif_penumpang->update_data($selisih,$tanggal,$tahun);
      //dd($request->Volume_Eksekutif);
      return redirect()->action('PenumpangController@lihat');
    }
    public function getStasiun(Request $request){
      $tanggal=Carbon::parse($request['tanggal'])->todatestring();
      return $this->cekStasiun($tanggal);
    }
    public function cekStasiun($tanggal){
      $penumpang = new Penumpang;
      $penumpang=$penumpang->getStasiun($tanggal);
      $stasiun = new Stasiun;
      $stasiun=$stasiun->ambilPenumpang();
      return $this->getDataStasiun($penumpang,$stasiun);
    }
    public function getDataStasiun($penumpang,$stasiun){
      $a=0;
      foreach ($stasiun as $i) {
        $b=0;
        foreach ($penumpang as $j) {
          if($i->id==$j['stasiun_id']){
            unset($stasiun[$a]);
            unset($penumpang[$b]);
            break;
          }
          $b++;
        }
        $a++;
      }
      return $stasiun;

    }
    public function cekTombol(Request $request){
      if($request->lihat!=null){
         return $this->lihatDetail($request);
      }elseif ($request->edit!=null) {
        return $this->viewedit($request);
      }elseif ($request->delete!=null) {
        return $this->delete_data($request);
      }
    }
    public function validasi(Request $request){
      return $request->validate([
        'tanggal'=>'required',
        'stasiun'=>'required',
      ]);
    }
    public function messages(){
      return [
        'stasiun.required' => 'Harap Pilih Stasiun Terlebih dahulu',
      ];
    }
    public function konversi(Request $request){
        $request->Volume_Eksekutif=angkatointeger($request->Volume_Eksekutif);
        $request->Volume_Bisnis=angkatointeger($request->Volume_Bisnis);
        $request->Volume_Ekonomi=angkatointeger($request->Volume_Ekonomi);
        $request->Volume_Lokal=angkatointeger($request->Volume_Lokal);
        $request->Pendapatan_Eksekutif=rupiahtointeger($request->Pendapatan_Eksekutif);
        $request->Pendapatan_Bisnis=rupiahtointeger($request->Pendapatan_Bisnis);
        $request->Pendapatan_Ekonomi=rupiahtointeger($request->Pendapatan_Ekonomi);
        $request->Pendapatan_Lokal=rupiahtointeger($request->Pendapatan_Lokal);
          //dd($request);
          return $request;
    }
    public function duplikasi($penumpang,$tanggal,$stasiun){
      return $penumpang->getDataDetail($tanggal,$stasiun)->first()==null;
    }
}
