<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class komulatif_barang extends Model
{
  protected $table='komulatif_barang';

  protected $fillable=['jenis','pendapatan','volume','created_at'];

  public function tambah(Request $request){
    $tahun=new Carbon($request->tanggal);
    $tahun=$tahun->year;
    $tanggal=$this->cekDataTerbaru($tahun);
    //kondisi dmn jika ada datanya maka data yg sblmnya
    //akan ditambahan dengan data yang sekarang
    if($tanggal!=NULL){
      $data_sekarang=$this->ambilDatasekarang($tanggal);
      $data=array(
        array(
            'jenis'=>'Petikemas',
            'pendapatan'=>$request->pendapatan_Petikemas+$data_sekarang[0]->pendapatan,
            'volume'=>$request->Volume_Petikemas+$data_sekarang[0]->volume,
            'created_at'=>Carbon::parse($request->tanggal)
          ),
        array(
          'jenis'=>'Semen',
          'pendapatan'=>$request->pendapatan_Semen+$data_sekarang[1]->pendapatan,
          'volume'=>$request->Volume_Semen+$data_sekarang[1]->volume,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
          'jenis'=>'BBM',
          'pendapatan'=>$request->pendapatan_BBM+$data_sekarang[2]->pendapatan,
          'volume'=>$request->Volume_BBM+$data_sekarang[2]->volume,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
        array(
            'jenis'=>'Cargo',
            'pendapatan'=>$request->pendapatan_Cargo+$data_sekarang[3]->pendapatan,
            'volume'=>$request->Volume_Cargo+$data_sekarang[3]->volume,
            'created_at'=>Carbon::parse($request->tanggal)
          ),
        array(
            'jenis'=>'Ka_lain',
            'pendapatan'=>$request->pendapatan_Ka_Lain+$data_sekarang[4]->pendapatan,
            'volume'=>$request->Volume_KA_Lain+$data_sekarang[4]->volume,
            'created_at'=>Carbon::parse($request->tanggal)
            ),
        array(
            'jenis'=>'Sharing',
            'pendapatan'=>$request->pendapatan_Sharing+$data_sekarang[5]->pendapatan,
            'volume'=>null,
            'created_at'=>Carbon::parse($request->tanggal)
            ),
      );
      dd($data);
      $this->insert($data);
    }else{
      tambahDataSekarang($request);
    }
    // dd($data);
  }
  public function tambahDataSekarang($request){
    //data yang sekarng menjadi data yg utama
    $data=array(
      array(
          'jenis'=>'Petikemas',
          'pendapatan'=>$request->pendapatan_Petikemas,
          'volume'=>$request->Volume_Petikemas,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
      array(
        'jenis'=>'Semen',
        'pendapatan'=>$request->pendapatan_Semen,
        'volume'=>$request->Volume_Semen,
        'created_at'=>Carbon::parse($request->tanggal)
      ),
      array(
        'jenis'=>'BBM',
        'pendapatan'=>$request->pendapatan_BBM,
        'volume'=>$request->Volume_BBM,
        'created_at'=>Carbon::parse($request->tanggal)
      ),
      array(
          'jenis'=>'Cargo',
          'pendapatan'=>$request->pendapatan_Cargo,
          'volume'=>$request->Volume_Cargo,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
      array(
          'jenis'=>'Ka_lain',
          'pendapatan'=>$request->pendapatan_Ka_Lain,
          'volume'=>$request->Volume_KA_Lain,
          'created_at'=>Carbon::parse($request->tanggal)
          ),
      array(
          'jenis'=>'Sharing',
          'pendapatan'=>$request->pendapatan_Sharing,
          'volume'=>null,
          'created_at'=>Carbon::parse($request->tanggal)
          ),
    );

    $this->insert($data);
  }
  public function tambahDataKemarin($request,$tanggal,$tahun){
    $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','<',$tanggal)->orderBy('created_at','desc')->orderBy('id','asc')->limit(6)->get();

    $data=array(
      array(
          'jenis'=>'Petikemas',
          'pendapatan'=>$request->pendapatan_Petikemas+$data_sekarang[0]->pendapatan,
          'volume'=>$request->Volume_Petikemas+$data_sekarang[0]->volume,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
      array(
        'jenis'=>'Semen',
        'pendapatan'=>$request->pendapatan_Semen+$data_sekarang[1]->pendapatan,
        'volume'=>$request->Volume_Semen+$data_sekarang[1]->volume,
        'created_at'=>Carbon::parse($request->tanggal)
      ),
      array(
        'jenis'=>'BBM',
        'pendapatan'=>$request->pendapatan_BBM+$data_sekarang[2]->pendapatan,
        'volume'=>$request->Volume_BBM+$data_sekarang[2]->volume,
        'created_at'=>Carbon::parse($request->tanggal)
      ),
      array(
          'jenis'=>'Cargo',
          'pendapatan'=>$request->pendapatan_Cargo+$data_sekarang[3]->pendapatan,
          'volume'=>$request->Volume_Cargo+$data_sekarang[3]->volume,
          'created_at'=>Carbon::parse($request->tanggal)
        ),
      array(
          'jenis'=>'Ka_lain',
          'pendapatan'=>$request->pendapatan_Ka_Lain+$data_sekarang[4]->pendapatan,
          'volume'=>$request->Volume_KA_Lain+$data_sekarang[4]->volume,
          'created_at'=>Carbon::parse($request->tanggal)
          ),
      array(
          'jenis'=>'Sharing',
          'pendapatan'=>$request->pendapatan_Sharing+$data_sekarang[5]->pendapatan,
          'volume'=>null,
          'created_at'=>Carbon::parse($request->tanggal)
          ),
    );
    $this->insert($data);
  }
  //untuk mengambl data yang sekarang
  public function ambilDatasekarang($tanggal){
    $data=$this->where('created_at','=',$tanggal)->get();
    return $data;
  }
  public function ambilDataNow($tanggal,$tahun){
    $data=$this->whereYear('created_at','=',$tahun)->where('created_at','<=',$tanggal)->orderBy('created_at','desc')->limit(6)->get();
    return $data;
  }
  public function ambilDataTahun($tahun){
    return $this->select('created_at')->whereYear('created_at','=',$tahun)->get();
  }
  public function ambilDataSetelah($tanggal,$tahun){
    return $this->whereYear('created_at','=',$tahun)->where('created_at','>',$tanggal)->get();
  }
  public function ambilDataKemarin($tanggal,$tahun){
    return $this->whereYear('created_at','=',$tahun)->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
  }

  //mengecek dan mencari data terbaru berdasarkan created_at
  public function cekDataTerbaru($tahun){
    $tanggal=$this->select('created_at')->whereYear('created_at','=',$tahun)->orderBy('created_at','desc')->get()->first();
    //untuk mengkonversi create_at ke string
    if($tanggal!=NULL){
      $tanggal=$tanggal->created_at->todatestring();
    }
    return $tanggal;
  }
  public function selisih($request,$data_sekarang){
    //dd($data_sekarang);
    $selisih = array(
      'Petikemas_pendapatan'=> $request->pendapatan_Petikemas-$data_sekarang[0]->pendapatan,
      'Semen_pendapatan'=>$request->pendapatan_Semen-$data_sekarang[1]->pendapatan,
      'BBM_pendapatan'=>$request->pendapatan_BBM-$data_sekarang[2]->pendapatan,
      'Cargo_pendapatan'=>$request->pendapatan_Cargo-$data_sekarang[3]->pendapatan,
      'KA_Lain_pendapatan'=>$request->pendapatan_Ka_Lain-$data_sekarang[4]->pendapatan,
      'Sharing_pendapatan'=>$request->pendapatan_Sharing-$data_sekarang[4]->pendapatan,
      'Petikemas_volume'=> $request->Volume_Petikemas-$data_sekarang[0]->volume,
      'Semen_volume'=> $request->Volume_Semen-$data_sekarang[1]->volume,
      'BBM_volume'=> $request->Volume_BBM-$data_sekarang[2]->volume,
      'Cargo_volume'=> $request->Volume_Cargo-$data_sekarang[3]->volume,
      'KA_Lain_volume'=> $request->Volume_KA_Lain-$data_sekarang[4]->volume,
      //Lanjutkan disini
    );
    //dd($selisih);
    return $selisih;
  }
  public function update_data($selisih,$tanggal,$tahun){
    $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','>=',$tanggal)->get();
    //dd($data_sekarang);
    foreach ($data_sekarang as $i) {
      $data=$this->find($i->id);
      //dd($i->pendapatan+$selisih['BBM_pendapatan']);
      if($i->jenis=='BBM'){
        $data->update([
          'pendapatan'=>$i->pendapatan+$selisih['BBM_pendapatan'],
          'volume'=>$i->volume+$selisih['BBM_volume']
        ]);
      }elseif($i->jenis=='Semen'){
        $data->update([
              'pendapatan'=>$i->pendapatan+$selisih['Semen_pendapatan'],
              'volume'=>$i->volume+$selisih['Semen_volume']
           ]);
      }elseif($i->jenis=='Petikemas'){
         $data->update([
           'pendapatan'=>$i->pendapatan+$selisih['Petikemas_pendapatan'],
           'volume'=>$i->volume+$selisih['Petikemas_volume']
         ]);
      }elseif($i->jenis=='Cargo'){
         $data->update([
           'pendapatan'=>$i->pendapatan+$selisih['Cargo_pendapatan'],
           'volume'=>$i->volume+$selisih['Cargo_volume']
         ]);
       }elseif($i->jenis=='Ka_lain'){
          $data->update([
            'pendapatan'=>$i->pendapatan+$selisih['KA_Lain_pendapatan'],
            'volume'=>$i->volume+$selisih['KA_Lain_volume']
          ]);
       }elseif($i->jenis=='Sharing'){
           $data->update([
             'pendapatan'=>$i->pendapatan+$selisih['Sharing_pendapatan'],
           ]);
         }
    //dd($data);
    }
  }
  public function update_data_tambah($request,$tanggal,$tahun){
    $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','>',$tanggal)->get();
    //dd($data_sekarang);
    // dd($request->Volume_Semen);
    foreach ($data_sekarang as $i) {
      $data=$this->find($i->id);
      //dd($i->pendapatan+$selisih['BBM_pendapatan']);
      if($i->jenis=='BBM'){
        $data->update([
          'pendapatan'=>$i->pendapatan+$request->pendapatan_BBM,
          'volume'=>$i->volume+$request->Volume_BBM
        ]);
      }elseif($i->jenis=='Semen'){
        $data->update([
              'pendapatan'=>$i->pendapatan+$request->pendapatan_Semen,
              'volume'=>$i->volume+$request->Volume_Semen
           ]);
      }elseif($i->jenis=='Petikemas'){
         $data->update([
           'pendapatan'=>$i->pendapatan+$request->pendapatan_Petikemas,
           'volume'=>$i->volume+$request->Volume_Petikemas,
         ]);
      }elseif($i->jenis=='Cargo'){
         $data->update([
           'pendapatan'=>$i->pendapatan+$request->pendapatan_Cargo,
           'volume'=>$i->volume+$request->Volume_Cargo,
         ]);
       }elseif($i->jenis=='Ka_lain'){
          $data->update([
            'pendapatan'=>$i->pendapatan+$request->pendapatan_Ka_Lain,
            'volume'=>$i->volume+$request->Volume_KA_Lain,
          ]);
        }elseif($i->jenis=='Sharing'){
           $data->update([
             'pendapatan'=>$i->pendapatan+$request->pendapatan_Sharing,
             'volume'=>null,
           ]);
         }
    }
  }
}
