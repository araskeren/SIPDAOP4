<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Target;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
class TargetController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function viewTambahTarget(){
    return view('target');
  }
  public function viewTarget(Request $request){
    if($request->isMethod('post')){
      $tanggal=$request->tanggal;
    }else{
      $tanggal=Carbon::now()->year;
    }
    $target=new Target;
    $data_target=$target->ambilData($tanggal);

    return view('tabel_target_pendapatan',compact('data_target','tanggal'));
  }
  public function tambah(Request $request){
    $request=$this->konversi($request);
    $target = new Target;
    $target->tambah($request);

    return redirect()->action('TargetController@viewTambahTarget');
  }
  public function viewEditTarget(Request $request){
    if($request->isMethod('post')){
      $tanggal=$request->tanggal;
    }else{
      $tanggal=Carbon::now()->year;
    }
    $target=new Target;
    $data_target=$target->ambilData($tanggal);

    //dd($request);
    return view('edit_target',compact('data_target','tanggal'));
  }
  public function edit(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
    $request=$this->konversi($request);
    //Mengupdate data target
    $target = new Target;
    $data_sekarang=$target->ambilData($tanggal);
    $target->update_data($request,$data_sekarang);
    //dd($request);
    return redirect()->action('TargetController@viewTarget');
  }
  public function konversi(Request $request){
      $request->volume_eksekutif=angkatointeger($request->volume_eksekutif);
      $request->pendapatan_eksekutif=rupiahtointeger($request->pendapatan_eksekutif);
      $request->volume_bisnis=angkatointeger($request->volume_bisnis);
      $request->pendapatan_bisnis=rupiahtointeger($request->pendapatan_bisnis);
      $request->volume_ekonomi=angkatointeger($request->volume_ekonomi);
      $request->pendapatan_ekonomi=rupiahtointeger($request->pendapatan_ekonomi);
      $request->volume_lokal=angkatointeger($request->volume_lokal);
      $request->pendapatan_lokal=rupiahtointeger($request->pendapatan_lokal);
      $request->pendapatan_barang=rupiahtointeger($request->pendapatan_barang);
      $request->pendapatan_nonangkutan=rupiahtointeger($request->pendapatan_nonangkutan);
        //dd($request->pendapatan_nonangkutan);
      return $request;
  }

}
