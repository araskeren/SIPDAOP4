<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth; //user_id
use App\Stasiun;

class BHP extends Model
{
  protected $table='bhp';

  protected $fillable=['user_id','jenis','value','created_at'];
//menghubungkan antara  stasiun ke bhp
//untuk mengambil informasi dan mnampilkan nama stasiun berdasarkan idnya
  public function stasiun(){
    return $this->belongsTo(Stasiun::class);
  }
  public function getStasiun($tanggal){
    return $this->select('stasiun_id')->where('created_at','=',$tanggal)->get()->toArray();
  }
//request dari user untuk di tambahkan ke sql
  public function tambah(Request $request){
    $this->user_id=Auth::id();
    $this->stasiun_id=$request->stasiun;
    $this->value=$request->pendapatan;
    //untuk format tanggal
    $this->created_at=Carbon::parse($request->tanggal);
    $this->save();
  }
   public function edit(Request $request,$tanggal){
       $data_sekarang=$this->getDataDetail($tanggal,$request->stasiun);
       $this->where('id','=',$data_sekarang[0]->id)->update([
         'value' => $request->pendapatan,
       ]);
      // dd($request);
   }
   public function getDataDetail($tanggal,$stasiun){
     return $this->where('created_at','=',$tanggal)->where('stasiun_id','=',$stasiun)->get();
   }

  // mengambil data barang saja untuk dilihat di rekap barangBHP
  public function ambilBHP($tanggal){
    //membaca data yang diambil berdasarkan tanggal yg dipilih
    $data_bhp=$this->where('created_at','=',$tanggal)->get();
    //dd($data_bhp);
    return $data_bhp;
  }
  public function ambilBHPid($id){
    //membaca data yang diambil berdasarkan tanggal yg dipilih
    $data_bhp=$this->where('id','=',$id)->get();
    //dd($data_bhp);
    return $data_bhp;
  }
  public function delete_data($tanggal,$id){
    //dd($this->where('created_at','=',$tanggal)->where('stasiun_id','=',$stasiun_id)->get());
    $this->where('created_at','=',$tanggal)->where('id','=',$id)->delete();
  }


}
