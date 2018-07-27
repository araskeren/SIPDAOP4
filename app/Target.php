<?php

namespace App;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
  protected $table='target';
  protected $fillable=['user_id','kategori','jenis','volume','pendapatan','created_at'];
  // dd($request);
  public function tambah(Request $request){
    $data=array(
      array(
        'user_id'=>Auth::id(),
        'kategori'=>'Penumpang',
        'jenis'=>'Eksekutif',
        'pendapatan'=>$request->pendapatan_eksekutif,
        'volume'=>$request->volume_eksekutif,
        'created_at'=>Carbon::createFromDate($request->tanggal,1,1),
        'updated_at'=>Carbon::now()
        ),
      array(
          'user_id'=>Auth::id(),
          //'tahun'=>$tahun->year,
          'kategori'=>'Penumpang',
          'jenis'=>'Bisnis',
          'pendapatan'=>$request->pendapatan_bisnis,
          'volume'=>$request->volume_bisnis,
          'created_at'=>Carbon::createFromDate($request->tanggal,1,1),
          'updated_at'=>Carbon::now()
        ),
      array(
          'user_id'=>Auth::id(),
          //'tahun'=>$tahun->year,
          'kategori'=>'Penumpang',
          'jenis'=>'Ekonomi',
          'pendapatan'=>$request->pendapatan_ekonomi,
          'volume'=>$request->volume_ekonomi,
          'created_at'=>Carbon::createFromDate($request->tanggal,1,1),
          'updated_at'=>Carbon::now()
          ),
      array(
          'user_id'=>Auth::id(),
          //'tahun'=>$tahun->year,
          'kategori'=>'Penumpang',
          'jenis'=>'Lokal',
          'pendapatan'=>$request->pendapatan_lokal,
          'volume'=>$request->volume_lokal,
          'created_at'=>Carbon::createFromDate($request->tanggal,1,1),
          'updated_at'=>Carbon::now()
        ),
      array(
        'user_id'=>Auth::id(),
        'kategori'=>'Barang',
        'jenis'=>'Barang',
        'pendapatan'=>$request->pendapatan_barang,
        'volume'=>0,
        'created_at'=>Carbon::createFromDate($request->tanggal,1,1),
        'updated_at'=>Carbon::now()
      ),
      array(
        'user_id'=>Auth::id(),
          //'tahun'=>$tahun->year,
        'kategori'=>'NonAngkutan',
        'jenis'=>'NonAngkutan',
        'pendapatan'=>$request->pendapatan_nonangkutan,
        'volume'=>0,
        'created_at'=>Carbon::createFromDate($request->tanggal,1,1),
        'updated_at'=>Carbon::now()
      )
    );
    // dd($data);
      $this->insert($data);
   }
  public function ambilData($tanggal){
     $data_target = $this->whereYear('created_at','=',$tanggal)->get();
     return $data_target;
   }
  public function cekDataTerbaru($tahun){
     $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->orderBy('created_at','desc')->get()->first();
     //untuk mengkonversi create_at ke string
     if($tanggal!=NULL){
       $tanggal=$tanggal->created_at->todatestring();
     }
     return $tanggal;
   }
  public function getDataPenumpang($tahun){
    $data_target = $this->whereYear('created_at','=',$tahun)->where('kategori','=','Penumpang')->get();
    return $data_target;
  }
  public function getDataBarang($tahun){
    $data_target = $this->whereYear('created_at','=',$tahun)->where('kategori','=','Barang')->get()->first();
    return $data_target;
  }
  public function getDataNonAngkutan($tahun){
    $data_target = $this->whereYear('created_at','=',$tahun)->where('kategori','=','NonAngkutan')->get()->first();
    return $data_target;
  }
  public function update_data($request,$data_sekarang){

    $data_sekarang[0]->update([
      'volume'=>$request->volume_eksekutif,
      'pendapatan'=>$request->pendapatan_eksekutif

    ]);

    $data_sekarang[1]->update([
      'volume'=>$request->volume_bisnis,
      'pendapatan'=>$request->pendapatan_bisnis
    ]);
    $data_sekarang[2]->update([
      'volume'=>$request->volume_ekonomi,
      'pendapatan'=>$request->pendapatan_ekonomi
    ]);
    $data_sekarang[3]->update([
      'volume'=>$request->volume_lokal,
      'pendapatan'=>$request->pendapatan_lokal
    ]);
    $data_sekarang[4]->update([
      'volume'=>0,
      'pendapatan'=>$request->pendapatan_barang
    ]);
    $data_sekarang[5]->update([
      'volume'=>0,
      'pendapatan'=>$request->pendapatan_nonangkutan
    ]);
    //dd($data_sekarang);
}
 }
