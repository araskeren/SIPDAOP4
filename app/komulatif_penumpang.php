<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
class komulatif_penumpang extends Model
{
  protected $table='komulatif_penumpang';

  protected $fillable=['jenis','volume','pendapatan','created_at'];

    public function tambah(Request $request){
      $tahun=new Carbon($request->tanggal);
      $tahun=$tahun->year;
      $tanggal=$this->cekDataTerbaru($tahun);
      //kondisi dmn jika ada datanya maka data yg sblmnya
      //akan ditambahan dengan data yang sekarang
      if($tanggal!=NULL){
        $data_sekarang=$this->ambilDatasekarang($tanggal);

        //dd(Carbon::parse($request->tanggal));
        if(Carbon::parse($request->tanggal)->todatestring()==$tanggal){
          //Eksekutif
          $data=$this->find($data_sekarang[0]->id);
            $data->pendapatan+=$request->Pendapatan_Eksekutif;
            $data->volume+=$request->Volume_Eksekutif;
          $data->save();
          //bisnis
          $data=$this->find($data_sekarang[1]->id);
            $data->pendapatan+=$request->Pendapatan_Bisnis;
            $data->volume+=$request->Volume_Bisnis;
          $data->save();
          //ekonomi
          $data=$this->find($data_sekarang[2]->id);
            $data->pendapatan+=$request->Pendapatan_Ekonomi;
            $data->volume+=$request->Volume_Ekonomi;
          $data->save();
          //lokal
          $data=$this->find($data_sekarang[3]->id);
            $data->pendapatan+=$request->Pendapatan_Lokal;
            $data->volume+=$request->Volume_Lokal;
          $data->save();
        }else{
          $data=array(
            array(
              'jenis'=>'Eksekutif',
              'pendapatan'=>$request->Pendapatan_Eksekutif+$data_sekarang[0]->pendapatan,
              'volume'=>$request->Volume_Eksekutif+$data_sekarang[0]->volume,
              'created_at'=>Carbon::parse($request->tanggal)
            ),
            array(
              'jenis'=>'Bisnis',
              'pendapatan'=>$request->Pendapatan_Bisnis+$data_sekarang[1]->pendapatan,
              'volume'=>$request->Volume_Bisnis+$data_sekarang[1]->volume,
              'created_at'=>Carbon::parse($request->tanggal)
            ),
            array(
              'jenis'=>'Ekonomi',
              'pendapatan'=>$request->Pendapatan_Ekonomi+$data_sekarang[2]->pendapatan,
              'volume'=>$request->Volume_Ekonomi+$data_sekarang[2]->volume,
              'created_at'=>Carbon::parse($request->tanggal)
            ),
            array(
              'jenis'=>'Lokal',
              'pendapatan'=>$request->Pendapatan_Lokal+$data_sekarang[3]->pendapatan,
              'volume'=>$request->Volume_Lokal+$data_sekarang[3]->volume,
              'created_at'=>Carbon::parse($request->tanggal)
            )
          );
          $this->insert($data);
        }
      }else {
        $data=array(
                    array(
                      'jenis'=>'Eksekutif',
                      'pendapatan'=>$request->Pendapatan_Eksekutif,
                      'volume'=>$request->Volume_Eksekutif,
                      'created_at'=>Carbon::parse($request->tanggal)
                    ),
                    array(
                      'jenis'=>'Bisnis',
                      'pendapatan'=>$request->Pendapatan_Bisnis,
                      'volume'=>$request->Volume_Bisnis,
                      'created_at'=>Carbon::parse($request->tanggal)
                    ),
                    array(
                      'jenis'=>'Ekonomi',
                      'pendapatan'=>$request->Pendapatan_Ekonomi,
                      'volume'=>$request->Volume_Ekonomi,
                      'created_at'=>Carbon::parse($request->tanggal)
                    ),
                    array(
                      'jenis'=>'Lokal',
                      'pendapatan'=>$request->Pendapatan_Lokal,
                      'volume'=>$request->Volume_Lokal,
                      'created_at'=>Carbon::parse($request->tanggal)
                    )
              );
        $this->insert($data);
        }
    }
    public function tambahData($request,$tanggal){
      $data_sekarang=$this->ambilDatasekarang($tanggal);
      //dd(Carbon::parse($request->tanggal));
      if(Carbon::parse($request->tanggal)->todatestring()==$tanggal){
        //Eksekutif
        $data=$this->find($data_sekarang[0]->id);
          $data->pendapatan+=$request->Pendapatan_Eksekutif;
          $data->volume+=$request->Volume_Eksekutif;
        $data->save();
        //bisnis
        $data=$this->find($data_sekarang[1]->id);
          $data->pendapatan+=$request->Pendapatan_Bisnis;
          $data->volume+=$request->Volume_Bisnis;
        $data->save();
        //ekonomi
        $data=$this->find($data_sekarang[2]->id);
          $data->pendapatan+=$request->Pendapatan_Ekonomi;
          $data->volume+=$request->Volume_Ekonomi;
        $data->save();
        //lokal
        $data=$this->find($data_sekarang[3]->id);
          $data->pendapatan+=$request->Pendapatan_Lokal;
          $data->volume+=$request->Volume_Lokal;
        $data->save();
      }
    }
    public function tambahDataKemarin($request,$tanggal,$tahun){
      $data_kemarin=$this->whereYear('created_at','=',$tahun)->where('created_at','<',$tanggal)->orderBy('created_at','desc')->orderBy('id','asc')->limit(4)->get();
      $data=array(
              array(
                    'jenis'=>'Eksekutif',
                    'pendapatan'=>$request->Pendapatan_Eksekutif+$data_kemarin[0]->pendapatan,
                    'volume'=>$request->Volume_Eksekutif+$data_kemarin[0]->volume,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'jenis'=>'Bisnis',
                    'pendapatan'=>$request->Pendapatan_Bisnis+$data_kemarin[1]->pendapatan,
                    'volume'=>$request->Volume_Bisnis+$data_kemarin[1]->volume,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'jenis'=>'Ekonomi',
                    'pendapatan'=>$request->Pendapatan_Ekonomi+$data_kemarin[2]->pendapatan,
                    'volume'=>$request->Volume_Ekonomi+$data_kemarin[2]->volume,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'jenis'=>'Lokal',
                    'pendapatan'=>$request->Pendapatan_Lokal+$data_kemarin[3]->pendapatan,
                    'volume'=>$request->Volume_Lokal+$data_kemarin[3]->volume,
                    'created_at'=>Carbon::parse($request->tanggal)
            )
      );
      $this->insert($data);
    }
    public function tambahDataSekarang($request){
      $data=array(
              array(
                    'jenis'=>'Eksekutif',
                    'pendapatan'=>$request->Pendapatan_Eksekutif,
                    'volume'=>$request->Volume_Eksekutif,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'jenis'=>'Bisnis',
                    'pendapatan'=>$request->Pendapatan_Bisnis,
                    'volume'=>$request->Volume_Bisnis,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'jenis'=>'Ekonomi',
                    'pendapatan'=>$request->Pendapatan_Ekonomi,
                    'volume'=>$request->Volume_Ekonomi,
                    'created_at'=>Carbon::parse($request->tanggal)
                  ),
              array(
                    'jenis'=>'Lokal',
                    'pendapatan'=>$request->Pendapatan_Lokal,
                    'volume'=>$request->Volume_Lokal,
                    'created_at'=>Carbon::parse($request->tanggal)
            )
      );
      $this->insert($data);
    }

    public function ambilDataTahun($tahun){
      return $this->select('created_at')->whereYear('created_at','=',$tahun)->get();
    }
    //untuk mengambl data yang sekarang
    public function ambilDatasekarang($tanggal){
      $data=$this->where('created_at','=',$tanggal)->orderBy('created_at','desc')->get();
      return $data;
    }
    public function ambilDataNow($tanggal,$tahun){
      $data=$this->whereYear('created_at','=',$tahun)->where('created_at','<=',$tanggal)->orderBy('created_at','desc')->limit(4)->get();
      return $data;
    }
    public function ambilDatakemarin($tanggal,$tahun){
      $data=$this->whereYear('created_at','=',$tahun)->where('created_at','<',$tanggal)->orderBy('created_at','desc')->get();
      return $data;
    }
    //Update data sekarang
    public function updateDataSekarang($request,$tanggal){
      $data_sekarang=$this->where('created_at','=',$tanggal)->get();
      //$data_sekarang=$this->ambilDatasekarang($tanggal);
      //dd(Carbon::parse($request->tanggal));
      //Eksekutif
        $data=$this->find($data_sekarang[0]->id);
          $data->pendapatan+=$request->Pendapatan_Eksekutif;
          $data->volume+=$request->Volume_Eksekutif;
        $data->save();
        //bisnis
        $data=$this->find($data_sekarang[1]->id);
          $data->pendapatan+=$request->Pendapatan_Bisnis;
          $data->volume+=$request->Volume_Bisnis;
        $data->save();
        //ekonomi
        $data=$this->find($data_sekarang[2]->id);
          $data->pendapatan+=$request->Pendapatan_Ekonomi;
          $data->volume+=$request->Volume_Ekonomi;
        $data->save();
        //lokal
        $data=$this->find($data_sekarang[3]->id);
          $data->pendapatan+=$request->Pendapatan_Lokal;
          $data->volume+=$request->Volume_Lokal;
        $data->save();
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
        'Eksekutif_volume'=> $request->Volume_Eksekutif-$data_sekarang[0]->volume,
        'Eksekutif_pendapatan'=>$request->Pendapatan_Eksekutif-$data_sekarang[0]->pendapatan,
        'Bisnis_volume'=> $request->Volume_Bisnis-$data_sekarang[1]->volume,
        'Bisnis_pendapatan'=>$request->Pendapatan_Bisnis-$data_sekarang[1]->pendapatan,
        'Ekonomi_volume'=> $request->Volume_Ekonomi-$data_sekarang[2]->volume,
        'Ekonomi_pendapatan'=>$request->Pendapatan_Ekonomi-$data_sekarang[2]->pendapatan,
        'Lokal_volume'=> $request->Volume_Lokal-$data_sekarang[3]->volume,
        'Lokal_pendapatan'=>$request->Pendapatan_Lokal-$data_sekarang[3]->pendapatan,
        //Lanjutkan disini
      );
      return $selisih;
    }
    public function ambilDataSetelah($tanggal,$tahun){
      return $this->whereYear('created_at','=',$tahun)->where('created_at','>',$tanggal)->get();
    }
    public function update_data($selisih,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','>=',$tanggal)->get();
      foreach ($data_sekarang as $i) {
        $data=$this->find($i->id);
        if($i->jenis=='Eksekutif'){
          $data->update([
            'pendapatan'=>$i->pendapatan+$selisih['Eksekutif_pendapatan'],
            'volume'=>$i->volume+$selisih['Eksekutif_volume']
          ]);
        }elseif($i->jenis=='Bisnis'){
            $data->update([
              'pendapatan'=>$i->pendapatan+$selisih['Bisnis_pendapatan'],
              'volume'=>$i->volume+$selisih['Bisnis_volume']
            ]);
        }elseif($i->jenis=='Ekonomi'){
            $data->update([
              'pendapatan'=>$i->pendapatan+$selisih['Ekonomi_pendapatan'],
              'volume'=>$i->volume+$selisih['Ekonomi_volume']
            ]);
        }elseif($i->jenis=='Lokal'){
        $data->update([
          'pendapatan'=>$i->pendapatan+$selisih['Lokal_pendapatan'],
          'volume'=>$i->volume+$selisih['Lokal_volume']
        ]);

      }
      //dd($data);
    }
    }
    public function update_data_tambah($request,$tanggal,$tahun){
      $data_sekarang=$this->whereYear('created_at','=',$tahun)->where('created_at','>',$tanggal)->get();
      //dd($request);
      foreach ($data_sekarang as $i) {
        $data=$this->find($i->id);
        if($i->jenis=='Eksekutif'){
          $data->update([
            'pendapatan'=>$i->pendapatan+$request->Pendapatan_Eksekutif,
            'volume'=>$i->volume+$request->Volume_Eksekutif
          ]);
        }elseif($i->jenis=='Bisnis'){
            $data->update([
              'pendapatan'=>$i->pendapatan+$request->Pendapatan_Bisnis,
              'volume'=>$i->volume+$request->Volume_Bisnis
            ]);
        }elseif($i->jenis=='Ekonomi'){
            $data->update([
              'pendapatan'=>$i->pendapatan+$request->Pendapatan_Ekonomi,
              'volume'=>$i->volume+$request->Volume_Ekonomi
            ]);
        }elseif($i->jenis=='Lokal'){
        $data->update([
          'pendapatan'=>$i->pendapatan+$request->Pendapatan_Lokal,
          'volume'=>$i->volume+$request->Volume_Lokal
        ]);
        }
      }
    }

}
