<?php

namespace App\Http\Controllers;
use App\Barang;
use App\BHP;
use App\komulatif_barang;
use App\komulatif_bhp;
use App\Target;
use Carbon\Carbon;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BarangController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function viewTambah(){
    $tanggal=Carbon::now()->todatestring();
    return view('tambah_data_barang',compact('tanggal'));
  }
  public function tambah(Request $request){

    $request=$this->konversi($request);
    $barang = new Barang;
    $komulatif_barang=new komulatif_barang;
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();

    //dd(count($this->validasi(Carbon::parse($request->tanggal)->todatestring(),$barang))==0);
    // dd($this->duplikasi($tanggal,$barang));
    if($this->duplikasi($tanggal,$barang)){
      $barang->tambah($request);
      $setelah=false;
      $kemarin=false;
      if($komulatif_barang->ambilDataTahun($tahun)->first()!=null){
        if($komulatif_barang->ambilDataSetelah($tanggal,$tahun)->first()!=null){
          $setelah=true;
        }
        if($komulatif_barang->ambilDataKemarin($tanggal,$tahun)->first()!=null){
          $kemarin=true;
        }
        if($setelah==true){
            //setelah+=sekarang
          $komulatif_barang->tambahDataSekarang($request);
          $komulatif_barang->update_data_tambah($request,$tanggal,$tahun);
        }else if($setelah==false && $kemarin==true){
            //kemarin + data request
            $komulatif_barang->tambahDataKemarin($request,$tanggal,$tahun);
        }
      }else{
        //tambah data sekarang
        $komulatif_barang->tambahDataSekarang($request);
      }

      return redirect()->action('BarangController@lihatData');
    }else{
      $errors = new MessageBag;
      $errors->add('duplikasi_data', 'Duplikasi Data Pada Tanggal '.tanggal_indo($tanggal));
      return view('tambah_data_barang',compact('tanggal'))->withErrors($errors);
    }
  }
  public function duplikasi($tanggal,$barang){
    return $barang->ambilBarang($tanggal)->first()==null;
  }
  //
  public function lihatData(Request $request){
    //dd($request);

    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal)->todatestring();
    }else {
      $tanggal=Carbon::now()->todatestring();
    }

    $barang = new Barang;
    $data_barang=$barang->getDataDetail($tanggal);
    $komulatif_barang=new komulatif_barang;
    $data_komulatif_barang=$komulatif_barang->ambilDatasekarang($tanggal);
    $target_barang=new Target;
    $target_barang=$target_barang->getDataBarang($tanggal);

    return view('lihat_data_barang',compact('data_barang','data_komulatif_barang','target_barang','tanggal'));
  }
  public function lihatDetail(Request $request){

    if($request->isMethod('post'))
    {
      $tanggal=Carbon::parse($request->tanggal)->todatestring();
    }else {
      $tanggal=Carbon::now()->todatestring();
    }
    $barang = new Barang;
    $data_barang=$barang->getDataDetail($tanggal);
    $komulatif_barang=new komulatif_barang;
    $data_komulatif_barang=$komulatif_barang->ambilDatasekarang($tanggal);
    $target_barang=new Target;
    $target_barang=$target_barang->getDataBarang($tanggal);
    return view('lihat_data_barang',compact('data_barang','tanggal'));
  }
  public function lihatKomulatif(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=Carbon::parse($request->tanggal)->year;
      $tanggal=$tanggal->todatestring();
    }else{
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }

    $komulatif_barang=new komulatif_barang;
    $data_komulatif_barang=$komulatif_barang->ambilDatasekarang($tanggal);
    $komulatif_bhp=new komulatif_bhp;
    $data_komulatif_bhp=$komulatif_bhp->ambilDatasekarang($tanggal);
    $target_barang=new Target;
    $target_barang=$target_barang->getDataBarang($tanggal);

    return view('lihat_data_barang_komulatif',compact('data_komulatif_barang','data_komulatif_bhp','tanggal','target_barang','komulatif_bhp','komulatif_barang'));
  }
  public function viewedit(Request $request){
    if($request->isMethod('post')){
      //$tanggal=Carbon::now()->todatestring();
      $tanggal=Carbon::parse($request->tanggal)->todatestring();
    }else {
      $tanggal=Carbon::now()->todatestring();
    }
    $barang=new Barang;
    //dari model Barang
    $data_barang=$barang->ambilBarang($tanggal);
    $bhp=new BHP;
    //ambil barang dari model bhp
    $data_bhp=$bhp->ambilBHP($tanggal);
    //dd($data_barang);
    return view('edit_barang', compact('tanggal','data_barang','data_bhp'));
  }
  public function edit(Request $request){
    //dd($request);
    if($request->isMethod('post')){
      //$tanggal=Carbon::now()->todatestring();
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else {
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    $request=$this->konversi($request);
    $barang=new Barang;
    $data_sekarang=$barang->ambilBarang($tanggal);
    $barang->edit($request,$tanggal);
    $komulatif_barang=new komulatif_barang;
    $selisih=$komulatif_barang->selisih($request,$data_sekarang);
    //dd($selisih);
    $komulatif_barang->update_data($selisih,$tanggal,$tahun);

  // dd($request);
    return redirect()->action('BarangController@lihatData');
  }
  public function konversi(Request $request){
      $request->pendapatan_Petikemas=rupiahtointeger($request->pendapatan_Petikemas);
      $request->pendapatan_Semen=rupiahtointeger($request->pendapatan_Semen);
      $request->pendapatan_BBM=rupiahtointeger($request->pendapatan_BBM);
      $request->pendapatan_Cargo=rupiahtointeger($request->pendapatan_Cargo);
      $request->pendapatan_Ka_Lain=rupiahtointeger($request->pendapatan_Ka_Lain);
      $request->pendapatan_Sharing=rupiahtointeger($request->pendapatan_Sharing);
      $request->Volume_Petikemas=angkatointeger($request->Volume_Petikemas);
      $request->Volume_Semen=angkatointeger($request->Volume_Semen);
      $request->Volume_BBM=angkatointeger($request->Volume_BBM);
      $request->Volume_Cargo=angkatointeger($request->Volume_Cargo);
      $request->Volume_KA_Lain=angkatointeger($request->Volume_KA_Lain);
        //dd($request->Volume_Semen);
      return $request;
  }
}
