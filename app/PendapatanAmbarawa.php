<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class PendapatanAmbarawa extends Model
{
  protected $table='pendapatan_ambarawa';
  protected $fillable=['user_id','kategori','jenis','satuan','volume','total','created_at'];
  public function tambahAmbarawa(Request $request){
    $pendapat_lokal_dewasa=$request->pendapatan_lokal_dewasa;
    $pendapat_lokal_anak=$request->pendapatan_lokal_anak;
    $pendapat_wisman_dewasa=$request->pendapatan_wisman_dewasa;
    $pendapat_wisman_anak=$request->pendapatan_wisman_anak;
    $pendapat_rts=$request->pendapatan_rts;
    $pendapat_sewa_ka=$request->pendapatan_sewa_ka;

    $hasil=explode(".",$pendapat_lokal_dewasa);
    $request->pendapatan_lokal_dewasa=$hasil[1];

    $hasil=explode(".",$pendapat_lokal_anak);
    $request->pendapatan_lokal_anak=$hasil[1];

    $hasil=explode(".",$pendapat_wisman_dewasa);
    $request->pendapatan_wisman_dewasa=$hasil[1];

    $hasil=explode(".",$pendapat_wisman_anak);
    $request->pendapatan_wisman_anak=$hasil[1];

    $hasil=explode(".",$pendapat_rts);
    $request->pendapatan_rts=$hasil[1];

    $hasil=explode(".",$pendapat_sewa_ka);
    $request->pendapatan_sewa_ka=$hasil[1];

    $data=array(
      array(
        'user_id'=>Auth::id(),
        'kategori'=>'Lokal',
        'jenis'=>'Dewasa',
        'satuan'=>$request->satuan_lokal_dewasa,
        'volume'=>$request->volume_lokal_dewasa,
        'total'=>$request->pendapatan_lokal_dewasa,
        'created_at'=>Carbon::parse($request->tanggal)
      ),array(
        'user_id'=>Auth::id(),
        'kategori'=>'Lokal',
        'jenis'=>'Anak',
        'satuan'=>$request->satuan_lokal_anak,
        'volume'=>$request->volume_lokal_anak,
        'total'=>$request->pendapatan_lokal_anak,
        'created_at'=>Carbon::parse($request->tanggal)
      ),array(
        'user_id'=>Auth::id(),
        'kategori'=>'Asing',
        'jenis'=>'Dewasa',
        'satuan'=>$request->satuan_wisman_dewasa,
        'volume'=>$request->volume_wisman_dewasa,
        'total'=>$request->pendapatan_wisman_dewasa,
        'created_at'=>Carbon::parse($request->tanggal)
      ), array(
          'user_id'=>Auth::id(),
          'kategori'=>'Asing',
          'jenis'=>'anak',
          'satuan'=>$request->satuan_wisman_anak,
          'volume'=>$request->volume_wisman_anak,
          'total'=>$request->pendapatan_wisman_anak,
          'created_at'=>Carbon::parse($request->tanggal)
        ),  array(
            'user_id'=>Auth::id(),
            'kategori'=>'rts',
            'jenis'=>'rts',
            'satuan'=>$request->satuan_rts,
            'volume'=>$request->volume_rts,
            'total'=>$request->pendapatan_rts,
            'created_at'=>Carbon::parse($request->tanggal)
          ),  array(
              'user_id'=>Auth::id(),
              'kategori'=>'sewa',
              'jenis'=>'sewa_ka',
              'satuan'=>$request->satuan_sewa_ka,
              'volume'=>$request->volume_sewa_ka,
              'total'=>$request->pendapatan_sewa_ka,
              'created_at'=>Carbon::parse($request->tanggal)
            )
    );
    $this->insert($data);

  }
  public function lihatData($tanggal){
    $data_ambarawa=$this->where('created_at','=',$tanggal)->get();
    return $data_ambarawa;
  }
  public function edit(Request $request,$tanggal){
    $data_sekarang=$this->getDataDetail($tanggal);
    $pendapat_lokal_dewasa=$request->pendapatan_lokal_dewasa;
    $pendapat_lokal_anak=$request->pendapatan_lokal_anak;
    $pendapat_wisman_dewasa=$request->pendapatan_wisman_dewasa;
    $pendapat_wisman_anak=$request->pendapatan_wisman_anak;
    $pendapat_rts=$request->pendapatan_rts;
    $pendapat_sewa_ka=$request->pendapatan_sewa_ka;

    $hasil=explode(".",$pendapat_lokal_dewasa);
    $request->pendapatan_lokal_dewasa=$hasil[1];

    $hasil=explode(".",$pendapat_lokal_anak);
    $request->pendapatan_lokal_anak=$hasil[1];

    $hasil=explode(".",$pendapat_wisman_dewasa);
    $request->pendapatan_wisman_dewasa=$hasil[1];

    $hasil=explode(".",$pendapat_wisman_anak);
    $request->pendapatan_wisman_anak=$hasil[1];

    $hasil=explode(".",$pendapat_rts);
    $request->pendapatan_rts=$hasil[1];

    $hasil=explode(".",$pendapat_sewa_ka);
    $request->pendapatan_sewa_ka=$hasil[1];

    $this->where('id','=',$data_sekarang[0]->id)->update([
      'volume'=>$request->volume_lokal_dewasa,
      'satuan'=>$request->satuan_lokal_dewasa,
      'total'=>$request->pendapatan_lokal_dewasa
    ]);
    $this->where('id','=',$data_sekarang[1]->id)->update([
      'volume'=>$request->volume_lokal_anak,
      'satuan'=>$request->satuan_lokal_anak,
      'total'=>$request->pendapatan_lokal_anak
    ]);
    $this->where('id','=',$data_sekarang[2]->id)->update([
      'volume'=>$request->volume_wisman_dewasa,
      'satuan'=>$request->satuan_wisman_dewasa,
      'total'=>$request->pendapatan_wisman_dewasa
    ]);
    $this->where('id','=',$data_sekarang[3]->id)->update([
      'volume'=>$request->volume_wisman_anak,
      'satuan'=>$request->satuan_wisman_anak,
      'total'=>$request->pendapatan_wisman_anak
    ]);
    $this->where('id','=',$data_sekarang[4]->id)->update([
      'volume'=>$request->volume_rts,
      'satuan'=>$request->satuan_rts,
      'total'=>$request->pendapatan_rts
    ]);
    $this->where('id','=',$data_sekarang[5]->id)->update([
      'volume'=>$request->volume_sewa_ka,
      'satuan'=>$request->satuan_sewa_ka,
      'total'=>$request->pendapatan_sewa_ka
    ]);
    //dd($data_sekarang);
  }
  public function getDataDetail($tanggal){
    return $this->where('created_at','=',$tanggal)->get();
  }
  public function delete_dataAmbarawa($tanggal){
    //dd($this->where('created_at','=',$tanggal)->where('stasiun_id','=',$stasiun_id)->get());
    $this->where('created_at','=',$tanggal)->delete();
  }
}
