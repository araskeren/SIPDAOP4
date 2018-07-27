<?php

namespace App;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Barang extends Model
{
    //
    protected $table='barang';

    protected $fillable=['user_id','jenis','pendapatan','volume','created_at'];


    /**
    * Untuk mendapatkan data penumpang yang berelasi dengan stasiun.
    */
    public function tambah(Request $request){
      //dd($request);
      //dd($request->Volume_Petikemas);
      $data=array(
        array(
          'user_id'=>Auth::id(),
          'jenis'=>'Petikemas',
          'pendapatan'=>$request->pendapatan_Petikemas,
          'volume'=>$request->Volume_Petikemas,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
          'user_id'=>Auth::id(),
          'jenis'=>'Semen',
          'pendapatan'=>$request->pendapatan_Semen,
          'volume'=>$request->Volume_Semen,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
          'user_id'=>Auth::id(),
          'jenis'=>'BBM',
          'pendapatan'=>$request->pendapatan_BBM,
          'volume'=>$request->Volume_BBM,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
          'user_id'=>Auth::id(),
          'jenis'=>'Cargo',
          'pendapatan'=>$request->pendapatan_Cargo,
          'volume'=>$request->Volume_Cargo,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
          'user_id'=>Auth::id(),
          'jenis'=>'KA Lain',
          'pendapatan'=>$request->pendapatan_Ka_Lain,
          'volume'=>$request->Volume_KA_Lain,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
          'user_id'=>Auth::id(),
          'jenis'=>'Sharing',
          'pendapatan'=>$request->pendapatan_Sharing,
          'volume'=>null,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
      );
      $this->insert($data);
    }
    public function edit(Request $request,$tanggal){
        $data_sekarang=$this->getDataDetail($tanggal);
        // dd($request->pendapatan_BBM);

        $this->where('id','=',$data_sekarang[0]->id)->update([
          'pendapatan'=>$request->pendapatan_Petikemas,
          'volume'=>$request->Volume_Petikemas,
        ]);
        $this->where('id','=',$data_sekarang[1]->id)->update([
          'pendapatan'=>$request->pendapatan_Semen,
          'volume'=>$request->Volume_Semen,
        ]);
        $this->where('id','=',$data_sekarang[2]->id)->update([
          'pendapatan'=>$request->pendapatan_BBM,
          'volume'=>$request->Volume_BBM,
        ]);
        $this->where('id','=',$data_sekarang[3]->id)->update([
          'pendapatan'=>$request->pendapatan_Cargo,
          'volume'=>$request->Volume_Cargo,
        ]);
        $this->where('id','=',$data_sekarang[4]->id)->update([
          'pendapatan'=>$request->pendapatan_Ka_Lain,
          'volume'=>$request->Volume_KA_Lain
        ]);
        $this->where('id','=',$data_sekarang[5]->id)->update([
          'pendapatan'=>$request->pendapatan_Sharing,
          'volume'=>null
        ]);
    }
    public function ambilBarang($tanggal){
      $data_barang = $this->where('created_at','=',$tanggal)->get();
      return $data_barang;
    }

    public function getDataDetail($tanggal){
      return $this->where('created_at','=',$tanggal)->get();
    }

}
