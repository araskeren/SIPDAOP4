<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
class NonAngkutan extends Model
{
    protected $table='komulatif_non_angkutan';
    protected $fillable=['jenis','pendapatan','created_at'];

    //BAGIAN AMBARAWA
    public function tambahDataKemarinAmbarawa($pendapatan,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','Ambarawa')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->limit(1)->get();
      $this->jenis='Ambarawa';
      $this->pendapatan=$pendapatan+$data_sekarang[0]->pendapatan;
      $this->created_at=$tanggal;
      $this->save();
    }
    public function tambahDataSekarangAmbarawa($tanggal,$pendapatan){
      $this->jenis='Ambarawa';
      $this->pendapatan=$pendapatan;
      $this->created_at=$tanggal;
      $this->save();
    }
    public function cekDataKomulatifAmbarawaTerbaru($tahun){
      $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','Ambarawa')->orderBy('created_at','desc')->get()->first();
      //untuk mengkonversi create_at ke string
      if($tanggal!=NULL){
        $tanggal=$tanggal->created_at->todatestring();
      }
      return $tanggal;
    }
    public function pecahAmbarawa($request){
      $hasil=explode(".",$request->pendapatan_lokal_anak);
      $request->pendapatan_lokal_anak=$hasil[1];
      $hasil=explode(".",$request->pendapatan_lokal_dewasa);
      $request->pendapatan_lokal_dewasa=$hasil[1];
        $hasil=explode(".",$request->pendapatan_wisman_dewasa);
      $request->pendapatan_wisman_dewasa=$hasil[1];
        $hasil=explode(".",$request->pendapatan_wisman_anak);
      $request->pendapatan_wisman_anak=$hasil[1];
        $hasil=explode(".",$request->pendapatan_rts);
      $request->pendapatan_rts=$hasil[1];
        $hasil=explode(".",$request->pendapatan_sewa_ka);
      $request->pendapatan_sewa_ka=$hasil[1];
      return $request;
      //dd($request->pendapatan_lokal_anak);
    }
    public function selisihAmbarawa($request,$data_sekarang){
      $Lokal_dewasa_total=$request->pendapatan_lokal_dewasa-$data_sekarang[0]->total;
      $Lokal_anak_total=$request->pendapatan_lokal_anak-$data_sekarang[1]->total;
      $wisman_dewasa_total=$request->pendapatan_wisman_dewasa-$data_sekarang[2]->total;
      $wisman_anak_total=$request->pendapatan_wisman_anak-$data_sekarang[3]->total;
      $Rts_total=$request->pendapatan_rts-$data_sekarang[4]->total;
      $Sewa_ka_total=$request->pendapatan_sewa_ka-$data_sekarang[5]->total;
      $jumlah_selisih_ambarawa= $Lokal_dewasa_total + $Lokal_anak_total + $wisman_dewasa_total + $wisman_anak_total + $Rts_total + $Sewa_ka_total;
     //dd($jumlah_selisih_ambarawa);
      return $jumlah_selisih_ambarawa;
    }
    public function totalPendapatanAmbarawa($request){
      return $request->pendapatan_lokal_dewasa+$request->pendapatan_lokal_anak+$request->pendapatan_wisman_anak+$request->pendapatan_wisman_dewasa+$request->pendapatan_rts+$request->pendapatan_sewa_ka;
    }
    public function ambilDataKomulatifAmbarawaSekarang($tanggal){
      $data=$this->where('created_at','=',$tanggal)->where('jenis','=','Ambarawa')->get()->first();
      return $data;
    }
    public function ambilDataTahunAmbarawa($tahun){
      return $this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','Ambarawa')->get();
    }
    public function ambilDataSetelahAmbarawa($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','Ambarawa')->where('created_at','>',$tanggal)->get();
    }
    public function ambilDataKemarinAmbarawa($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','Ambarawa')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
    }
    public function updateDataTambahAmbarawa($pendapatan,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','Ambarawa')->where('created_at','>',$tanggal)->get();
      foreach ($data_sekarang as $i) {
        $data=$this->find($i->id);
        $data->update([
          'pendapatan'=>$data->pendapatan+$pendapatan
        ]);
      }
    }
    //SELESAI BAGIAN AMBARAWA

    public function tambahKomulatifLawang(Request $request){
      $tahun=new Carbon($request->tanggal);
      $tahun=$tahun->year;
      $tanggal=$this->cekDataKomulatifLawangTerbaru($tahun);
      if($tanggal!=NULL){
        $data_sekarang=$this->ambilDataKomulatifLawangSekarang($tanggal);
        //mendapatkan Rp.123
        $total_pendapatan_tiket=$request->total_pendapatan_tiket;
        //memecah Rp. ke [0] 123 ke [1]
        $hasil=explode(".",$total_pendapatan_tiket);
        //hasil pecahan 123 ditampung lagi di requestnya
        // $request->total_pendapatan_tiket=$hasil[1];
        // dd($hasil[1]);
        $this->jenis='Lawang';
        $this->pendapatan=$data_sekarang->pendapatan+$hasil[1];
        $this->created_at=Carbon::parse($request->tanggal);

        $this->save();

      }else{
        // dd($request);
        //mendapatkan Rp.123
        $total_pendapatan_tiket=$request->total_pendapatan_tiket;
        //memecah Rp. ke [0] 123 ke [1]
        $hasil=explode(".",$total_pendapatan_tiket);
        //hasil pecahan 123 ditampung lagi di requestnya
        $request->total_pendapatan_tiket=$hasil[1];

        $this->jenis='Lawang';
        $this->pendapatan=$request->total_pendapatan_tiket;
        $this->created_at=Carbon::parse($request->tanggal);

        $this->save();
      }

    }
    public function tambahDataKemarinLawang($pendapatan,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','Lawang')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->limit(1)->get();
      $this->jenis='Lawang';
      $this->pendapatan=$pendapatan+$data_sekarang[0]->pendapatan;
      $this->created_at=$tanggal;
      $this->save();
    }
    public function tambahDataSekarangLawang($tanggal,$pendapatan){
      $this->jenis='Lawang';
      $this->pendapatan=$pendapatan;
      $this->created_at=$tanggal;
      $this->save();
    }
    public function cekDataKomulatifLawangTerbaru($tahun){
      $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','Lawang')->orderBy('created_at','desc')->get()->first();
      //untuk mengkonversi create_at ke string
      if($tanggal!=NULL){
        $tanggal=$tanggal->created_at->todatestring();
      }
      return $tanggal;
    }
    public function pecahLawang($request){
        $hasil=explode(".",$request->pendapatan_lokal_anak);
      $request->pendapatan_lokal_anak=$hasil[0];
        $hasil=explode(".",$request->pendapatan_lokal_dewasa);
      $request->pendapatan_lokal_dewasa=$hasil[0];
        $hasil=explode(".",$request->pendapatan_wisman_dewasa);
      $request->pendapatan_wisman_dewasa=$hasil[0];
        $hasil=explode(".",$request->pendapatan_wisman_anak);
      $request->pendapatan_wisman_anak=$hasil[0];
      //dd($hasil);

      return $request;
    }
    public function selisihLawang($request,$data_sekarang){
      $Lokal_dewasa_total=$request->pendapatan_lokal_dewasa-$data_sekarang[0]->total;
      $Lokal_anak_total=$request->pendapatan_lokal_anak-$data_sekarang[1]->total;
      $wisman_dewasa_total=$request->pendapatan_wisman_dewasa-$data_sekarang[2]->total;
      $wisman_anak_total=$request->pendapatan_wisman_anak-$data_sekarang[3]->total;
      $jumlah_selisih_lawang= $Lokal_dewasa_total + $Lokal_anak_total + $wisman_dewasa_total + $wisman_anak_total;
      //  dd($jumlah_selisih_ambarawa);
      return $jumlah_selisih_lawang;
    }
    public function totalPendapatanLawang($request){
      return $request->pendapatan_lokal_dewasa+$request->pendapatan_lokal_anak+$request->pendapatan_wisman_anak+$request->pendapatan_wisman_dewasa;
    }
    public function ambilDataKomulatifLawangSekarang($tanggal){
      $data=$this->where('created_at','=',$tanggal)->where('jenis','=','Lawang')->get()->first();
      return $data;
    }
    public function ambilDataTahunLawang($tahun){
      return $this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','Lawang')->get();
    }
    public function ambilDataSetelahLawang($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','Lawang')->where('created_at','>',$tanggal)->get();
    }
    public function ambilDataKemarinLawang($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','Lawang')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
    }
    public function updateDataTambahLawang($pendapatan,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','Lawang')->where('created_at','>',$tanggal)->get();
      foreach ($data_sekarang as $i) {
        $data=$this->find($i->id);
        $data->update([
          'pendapatan'=>$data->pendapatan+$pendapatan
        ]);
      }
    }
    //SELESAI BAGIAN LAWANG

    //BAGIAN PA
    public function tambahKomulatifPA(Request $request){
      $tahun=new Carbon($request->tanggal);
      $tahun=$tahun->year;
      $tanggal=$this->cekDataKomulatifPaTerbaru($tahun);
      if($tanggal!=NULL){
        $data_sekarang=$this->ambilDataKomulatifPaSekarang($tanggal);
        //mendapatkan Rp.123

        $this->jenis='PDDM';
        $this->pendapatan=$request->Pendapatan_PA+$data_sekarang->pendapatan;
        $this->created_at=Carbon::parse($request->tanggal);
      }else{
        $this->jenis='PDDM';
        $this->pendapatan=$request->Pendapatan_PA;
        $this->created_at=Carbon::parse($request->tanggal);
      }
      $this->save();
    }
    public function tambahDataKemarinPA($request,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->limit(1)->get();
      $this->jenis='PDDM';
      $this->pendapatan=$request->Pendapatan_PA+$data_sekarang[0]->pendapatan;
      $this->created_at=$tanggal;
      $this->save();
    }
    public function tambahDataSekarangPA($request){
      $this->jenis='PDDM';
      $this->pendapatan=$request->Pendapatan_PA;
      $this->created_at=Carbon::parse($request->tanggal);
      $this->save();
    }
    public function tambahDataKemarin($request,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->limit(6)->get();
      $this->jenis='PDDM';
      $this->pendapatan=$request->pendapatan+$data_kemarin[0]->pendapatan;
      $this->created_at=Carbon::parse($request->tanggal);
      $this->save();
    }
    public function selisihPa($request,$data_sekarang){
      $Pa_pendapatan=$request->Pendapatan_PA-$data_sekarang[0]->value;
      return $Pa_pendapatan;
    }
    public function cekDataKomulatifPaTerbaru($tahun){
      $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->orderBy('created_at','desc')->get()->first();
      //untuk mengkonversi create_at ke string
      if($tanggal!=NULL){
        $tanggal=$tanggal->created_at->todatestring();
      }
      return $tanggal;
    }
    public function ambilDataKomulatifPaSekarang($tanggal){
      $data=$this->where('created_at','=',$tanggal)->where('jenis','=','PDDM')->get()->first();
      return $data;
    }
    public function ambilDataTahunPA($tahun){
      return $this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->get();
    }
    public function ambilDataSetelahPA($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->where('created_at','>',$tanggal)->get();
    }
    public function ambilDataKemarinPA($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
    }
    public function updateDataTambahPA($request,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','PDDM')->where('created_at','>',$tanggal)->get();
      //dd($data_sekarang);
      foreach ($data_sekarang as $i) {
        $data=$this->find($i->id);
        $data->update([
          'pendapatan'=>$data->pendapatan+$request->Pendapatan_PA
        ]);
      }
    }

    //SELESAI BAGIAN PA

    //BAGIAN UUK
    public function tambahKomulatifuuk(Request $request){
      $tahun=new Carbon($request->tanggal);
      $tahun=$tahun->year;
      $tanggal=$this->cekDataKomulatifuukTerbaru($tahun);
      if($tanggal!=NULL){
        $data_sekarang=$this->ambilDataKomulatifuukSekarang($tanggal);
        $this->jenis='UUK';
        $this->pendapatan=$request->Pendapatan_UUK+$data_sekarang->pendapatan;
        $this->created_at=Carbon::parse($request->tanggal);
      }else{
        $this->jenis='UUK';
        $this->pendapatan=$request->Pendapatan_UUK;
        $this->created_at=Carbon::parse($request->tanggal);
      }
      $this->save();
    }
    public function tambahDataSekarangUUK($request){
      $this->jenis='UUK';
      $this->pendapatan=$request->Pendapatan_UUK;
      $this->created_at=Carbon::parse($request->tanggal);
      $this->save();
    }
    public function tambahDataKemarinUUK($request,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','UUK')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->limit(1)->get();
      $this->jenis='UUK';
      $this->pendapatan=$request->Pendapatan_UUK+$data_sekarang[0]->pendapatan;
      $this->created_at=Carbon::parse($request->tanggal);
      $this->save();
    }
    public function ambilSemuaDataKomulatif($tanggal){
      $data = $this->where('created_at','=',$tanggal)->get();
      return $data;
    }
    public function ambilSemuaDataNow($tanggal,$tahun){
      $data = $this->whereYear('created_at','=',$tahun)->where('created_at','<=',$tanggal)->orderBy('created_at','desc')->limit(4)->get();
      return $data;
    }
    public function update_data($selisih,$tanggal,$tahun,$jenis){
      $data_sekarang=$this->where('jenis','=',$jenis)->whereYear('created_at','=',$tahun)->where('created_at','>=',$tanggal)->get();
      //dd($data_sekarang);
      foreach ($data_sekarang as $i) {
        $data=$this->where('id','=',$i->id)->get()->first();
        //dd($data);
        if($i->jenis=='Ambarawa'){
          if(($i->pendapatan+$selisih)>=0){
            $data->update([
              'pendapatan'=>$i->pendapatan+$selisih
            ]);
          }
        }elseif($i->jenis=='Lawang'){
          if(($i->pendapatan+$selisih)>=0){
            $data->update([
            'pendapatan'=>$i->pendapatan+$selisih
              ]);
            }
        }elseif($i->jenis=='PDDM'){
          if(($i->pendapatan+$selisih)>=0){
            $data->update([
              'pendapatan'=>$i->pendapatan+$selisih
            ]);
          }
        }elseif($i->jenis=='UUK'){
          if(($i->pendapatan+$selisih)>=0){
              $data->update([
                'pendapatan'=>$i->pendapatan+$selisih
              ]);
            }
        }

      }
    }
    public function ambilDataKomulatifuukSekarang($tanggal){
      $data=$this->where('created_at','=',$tanggal)->where('jenis','=','UUK')->get()->first();
      return $data;
    }
    public function cekDataKomulatifuukTerbaru($tahun){
      $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','UUK')->orderBy('created_at','desc')->get()->first();
      //untuk mengkonversi create_at ke string
      if($tanggal!=NULL){
        $tanggal=$tanggal->created_at->todatestring();
      }
      return $tanggal;
    }
    public function selisihuuk($request,$data_sekarang){
      $Uuk_pendapatan=$request->Pendapatan_UUK-$data_sekarang[0]->value;
      return $Uuk_pendapatan;
    }
    public function ambilDataTahunUUK($tahun){
      return $this->select('created_at')->whereYear('created_at','=',$tahun)->where('jenis','=','UUK')->get();
    }
    public function ambilDataSetelahUUK($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','UUK')->where('created_at','>',$tanggal)->get();
    }
    public function ambilDataKemarinUUK($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=','UUK')->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
    }
    public function updateDataTambahUUK($request,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=','UUK')->where('created_at','>',$tanggal)->get();
      //dd($data_sekarang);
      foreach ($data_sekarang as $i) {
        $data=$this->find($i->id);
        $data->update([
          'pendapatan'=>$data->pendapatan+$request->Pendapatan_UUK
        ]);
      }
    }

    //SELESAI BAGIAN UUK
    //Public function
    public function ambilDataSekarang($tanggal,$tahun,$jenis){
      return $this->whereYear('created_at','=',$tahun)->where('jenis','=',$jenis)->where('created_at','=',$tanggal)->get();
    }
    public function updateDataKomulatifSekarang($pendapatan,$tanggal,$tahun,$jenis){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('jenis','=',$jenis)->where('created_at','=',$tanggal)->get()->first();
      $data_sekarang->update([
        'pendapatan'=>$data_sekarang->pendapatan+$pendapatan
      ]);
    }

    //SELESAI BAGIAN SEMUA
}
