<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class Penumpang extends Model
{
    //
    protected $table='penumpang';

    protected $fillable=['user_id','stasiun_id','volume','pendapatan'];

    /**
    * Untuk mendapatkan data user yang berelasi dengan Penumpang.
    */
    public function user(){
      return $this->belongsTo(User::class);
    }
    /**
    * Untuk mendapatkan data stasiun yang berelasi dengan Penumpang.
    */
    public function stasiun(){
      return $this->belongsTo(Stasiun::class);
    }
    public function edit(Request $request,$tanggal,$stasiun_id){
      $data_sekarang=$this->getDataDetail($tanggal,$stasiun_id);

      $this->where('id','=',$data_sekarang[0]->id)->update([
        'volume'=>$request->Volume_Eksekutif,
        'pendapatan'=>$request->Pendapatan_Eksekutif,
      ]);
      $this->where('id','=',$data_sekarang[1]->id)->update([
        'volume'=>$request->Volume_Bisnis,
        'pendapatan'=>$request->Pendapatan_Bisnis,
      ]);
      $this->where('id','=',$data_sekarang[2]->id)->update([
        'volume'=>$request->Volume_Ekonomi,
        'pendapatan'=>$request->Pendapatan_Ekonomi,
      ]);
      $this->where('id','=',$data_sekarang[3]->id)->update([
        'volume'=>$request->Volume_Lokal,
        'pendapatan'=>$request->Pendapatan_Lokal,
      ]);
    }
    public function tambah(Request $request){
      $data=array(
              array(
                    'user_id'=>Auth::id(),
                    'stasiun_id'=>$request->stasiun,
                    'jenis'=>'Eksekutif',
                    'volume'=>$request->Volume_Eksekutif,
                    'pendapatan'=>$request->Pendapatan_Eksekutif,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'user_id'=>Auth::id(),
                    'stasiun_id'=>$request->stasiun,
                    'jenis'=>'Bisnis',
                    'volume'=>$request->Volume_Bisnis,
                    'pendapatan'=>$request->Pendapatan_Bisnis,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'user_id'=>Auth::id(),
                    'stasiun_id'=>$request->stasiun,
                    'jenis'=>'Ekonomi',
                    'volume'=>$request->Volume_Ekonomi,
                    'pendapatan'=>$request->Pendapatan_Ekonomi,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'user_id'=>Auth::id(),
                    'stasiun_id'=>$request->stasiun,
                    'jenis'=>'Lokal',
                    'volume'=>$request->Volume_Lokal,
                    'pendapatan'=>$request->Pendapatan_Lokal,
                    'created_at'=>Carbon::parse($request->tanggal)
             )
      );
      $this->insert($data);
    }
    public function delete_data($tanggal,$stasiun_id){
      //dd($this->where('created_at','=',$tanggal)->where('stasiun_id','=',$stasiun_id)->get());
      $this->where('created_at','=',$tanggal)->where('stasiun_id','=',$stasiun_id)->delete();
    }
    public function getData($tanggal){
      return $this->where('created_at','=',$tanggal)->get();
    }
    public function getStasiun($tanggal){
      return $this->select('stasiun_id')->where('created_at','=',$tanggal)->groupBy('stasiun_id')->havingRaw('count(*) > 1')->get()->toArray();
    }
    public function getDataDetail($tanggal,$id_stasiun){
      return $this->where('created_at','=',$tanggal)->where('stasiun_id','=',$id_stasiun)->get();
    }
}
