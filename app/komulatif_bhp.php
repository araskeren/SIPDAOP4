<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class komulatif_bhp extends Model
{
  protected $table='komulatif_bhp';

  protected $fillable=['value','created_at'];

  public function tambahDataBHP(Request $request){
    $request->tanggal=Carbon::parse($request->tanggal);
    $tahun=$request->tanggal->year;

    $tanggal=$this->cekDataTerbaru($tahun);

    //kondisi dmn jika ada datanya maka data yg sblmnya
    //akan ditambahan dengan data yang sekarang
    if($tanggal!=NULL){
      $req_tanggal=Carbon::parse($request->tanggal)->todatestring();

      if($req_tanggal==$tanggal){
        $data=$this->ambilDatasekarang($req_tanggal);
        $data->value+=$request->pendapatan;
        $data->update();
      }else{
        $data_sekarang=$this->ambilDatasekarang($tanggal);
        $this->value=$request->pendapatan+$data_sekarang->value;
        //untuk format tanggal
        $this->created_at=Carbon::parse($request->tanggal);
        $this->save();
      }
    }else{
      $this->value=$request->pendapatan;
      //untuk format tanggal
      $this->created_at=Carbon::parse($request->tanggal);
      $this->save();
    }
  }
  public function tambahData($request,$tanggal){
    $data_sekarang=$this->ambilDatasekarang($tanggal);
    $data_sekarang->value+=$request->pendapatan;
    $data_sekarang->save();
  }
  public function tambahDataKemarin($request,$tanggal,$tahun){
    $data_kemarin=$this->whereYear('created_at','=',$tahun)->where('created_at','<',$tanggal)->orderBy('created_at','desc')->limit(1)->first();
    // dd($data_kemarin);
    $this->value=$request->pendapatan+$data_kemarin->value;
    $this->created_at=$tanggal;
    $this->save();
  }
  public function tambahDataSekarang($request){
    $this->value=$request->pendapatan;
    $this->created_at=Carbon::parse($request->tanggal);
    $this->save();
  }
  public function update_data_tambah($request,$tanggal,$tahun){
    $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','>',$tanggal)->get();
    //dd($data_sekarang);
    foreach ($data_sekarang as $i){
      $data=$this->find($i->id);

      $data->update([
        'value'=>$data->value+$request->pendapatan
      ]);
    }
  }
  public function ambilDatasekarang($tanggal){
    $data=$this->where('created_at','=',$tanggal)->get()->first();
    return $data;
  }
  public function ambilDataSetelah($tanggal,$tahun){
    return $this->whereYear('created_at','=',$tahun)->where('created_at','>',$tanggal)->get();
  }
  public function ambilDataTahun($tahun){
    return $this->select('created_at')->whereYear('created_at','=',$tahun)->get();
  }
  public function ambilDataKemarin($tanggal,$tahun){
    return $this->whereYear('created_at','=',$tahun)->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
  }
  public function cekDataTerbaru($tahun){
    $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->orderBy('created_at','desc')->get()->first();
    //untuk mengkonversi create_at ke string
    if($tanggal!=NULL){
      $tanggal=$tanggal->created_at->todatestring();
    }
    return $tanggal;
  }
  public function selisih($request,$data_sekarang){
    $selisih = array(
      'pendapatan'=>$request->pendapatan-$data_sekarang[0]->value,
      //Lanjutkan disini
    );
    //dd($selisih);
    return $selisih;
  }
  public function update_data($selisih,$tanggal,$tahun){
    $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','>=',$tanggal)->get();
    foreach ($data_sekarang as $i) {
      $data=$this->where('id','=',$i->id)->get()->first();
        $data->update([
          'value'=>$i->value+$selisih['pendapatan']
        ]);
    }
  }
}
