<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class PendapatanUUK extends Model
{
    protected $table='pendapatan_uuk';
    protected $fillable=['user_id','value','created_at'];

    public function tambahuuk(Request $request){
      $this->user_id=Auth::id();
      $this->value=$request->Pendapatan_UUK;
      $this->created_at=Carbon::parse($request->tanggal);

      $this->save();
    }
    public function edit($pendapatan,$tanggal){
       $data_sekarang=$this->getDataDetail($tanggal)->first();
       $data_sekarang->update([
          'value'=>$pendapatan
        ]);
    }
    public function getDataDetail($tanggal){
      return $this->where('created_at','=',$tanggal)->get();
    }
    public function lihatData($tanggal){
      $data_pendapat=$this->where('created_at','=',$tanggal)->get();
      return $data_pendapat;
    }
    public function delete_dataUUK($tanggal){
      //dd($this->where('created_at','=',$tanggal)->where('stasiun_id','=',$stasiun_id)->get());
      $this->where('created_at','=',$tanggal)->delete();
    }
}
