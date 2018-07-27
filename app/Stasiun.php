<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Stasiun extends Model
{
    protected $table='stasiun';

    protected $fillable=['nama_stasiun','stasiun_barang','stasiun_penumpang'];

    /**
    * Untuk mendapatkan data penumpang yang berelasi dengan stasiun.
    */
    public function penumpang(){
      return $this->belongsTo(Penumpang::class);
    }
    public function tambah(Request $request){
      $this->nama_stasiun=$request->namaStasiun;
      $this->stasiun_barang=$request->stasiun_barang;
      $this->stasiun_penumpang=$request->stasiun_penumpang;
      $this->save();
    }
    public function tambahPenumpang(Request $request){
      $data=$this->cekDuplikasi($request->namaStasiun);
      if($data==null){
        $this->nama_stasiun=$request->namaStasiun;
        $this->stasiun_barang=0;
        $this->stasiun_penumpang=1;
        $this->save();
      }else{
        $this->find($data->id)->update([
          'stasiun_penumpang'=>1
        ]);
      }
    }
    public function tambahBarang(Request $request){
      $data=$this->cekDuplikasi($request->namaStasiun);
      if($data==null){
        $this->nama_stasiun=$request->namaStasiun;
        $this->stasiun_barang=1;
        $this->stasiun_penumpang=0;
        $this->save();
      }else{
        $this->find($data->id)->update([
          'stasiun_barang'=>1
        ]);
      }
    }
    public function cekDuplikasi($nama){
      $data=$this->select('nama_stasiun','id')->where('nama_stasiun','=',$nama)->get()->first();
      return $data;
    }
    public function ambilDataStasiun($id){
      return $this->where('id','=',$id)->get()->first();
    }
    public function ambilSemuaData(){
      $stasiun = $this->all();
      return $stasiun;
    }
    public function ambilPenumpang(){
      $stasiun = $this->select('id','nama_stasiun')->where('stasiun_penumpang','=',1)->get();
      return $stasiun;
    }
    public function ambilBarang(){
      $stasiun = $this->select('id','nama_stasiun')->where('stasiun_barang','=',1)->get();
      return $stasiun;
    }
}
