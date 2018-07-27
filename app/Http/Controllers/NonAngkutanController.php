<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Target;
use Illuminate\Http\Request;
use App\PendapatanAmbarawa;
use App\PendapatanLawang;
use App\PendapatanPA;
use App\PendapatanUUK;
use App\NonAngkutan;
use Illuminate\Support\MessageBag;
class NonAngkutanController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

  public function indexlihatTabelTarget(){
    $tanggal=Carbon::now()->todatestring();
    return view('tambah_target_pendapatan',compact('tanggal'));
  }
  //BAGIAN AMBARAWA
  public function indexAmbarawa(){
    $tanggal=Carbon::now()->todatestring();
    return view('tambah_pendapatan_ambarawa',compact('tanggal'));
  }
  public function tambahAmbarawa(Request $request){
    $pendapatan = new PendapatanAmbarawa ;
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
    if($this->cekDuplikasiAmbarawa($tanggal,$pendapatan)){
      $pendapatan->tambahAmbarawa($request);
      $komulatif=new NonAngkutan;
      $setelah=false;
      $kemarin=false;
      $sekarang=false;
      $total_pedapatan=$komulatif->totalPendapatanAmbarawa($request);

      if($komulatif->ambilDataTahunAmbarawa($tahun)->first()!=null){
        if($komulatif->ambilDataSekarang($tanggal,$tahun,'Ambarawa')->first()!=null){
          $sekarang=true;
        }
        if($komulatif->ambilDataSetelahAmbarawa($tanggal,$tahun)->first()!=null){
          $setelah=true;
        }
        if($komulatif->ambilDataKemarinAmbarawa($tanggal,$tahun)->first()!=null){
          $kemarin=true;
        }
        if($setelah==true){
            //setelah+=sekarang
          if($sekarang==true){
              $komulatif->updateDataKomulatifSekarang($total_pedapatan,$tanggal,$tahun,'Ambarawa');
          }elseif($kemarin==true&&$sekarang==false){
            $komulatif->tambahDataKemarinAmbarawa($total_pedapatan,$tanggal,$tahun);
          }else{
            $komulatif->tambahDataSekarangAmbarawa($tanggal,$total_pedapatan);
          }
          $komulatif->updateDataTambahAmbarawa($total_pedapatan,$tanggal,$tahun);
        }else if($setelah==false && $kemarin==true){
            //kemarin + data request
            $komulatif->tambahDataKemarinAmbarawa($total_pedapatan,$tanggal,$tahun);
        }
      }else{
        //tambah data sekarang
        $komulatif->tambahDataSekarangAmbarawa($tanggal,$total_pedapatan);
      }
      return redirect()->action('NonAngkutanController@lihatDataKomulatif');
    }else{
      $errors = new MessageBag;
      $errors->add('duplikasi_data', 'Duplikasi Data Pada Tanggal '.tanggal_indo($tanggal));
      return view('tambah_pendapatan_ambarawa',compact('tanggal'))->withErrors($errors);
    }
  }
  public function lihatambarawa(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $ambarawa=new PendapatanAmbarawa;
    $data_ambarawa=$ambarawa->lihatData($tanggal);
    return view('lihat_data_ambarawa',compact('data_ambarawa','tanggal'));
  }
  public function cekDuplikasiAmbarawa($tanggal,$ambarawa){
    return $ambarawa->getDataDetail($tanggal)->first()==null;
  }
  public function editambarawa(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else {
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    //Untuk Mendapatkan Data lawang
    //dd($request);
    $ambarawa=new PendapatanAmbarawa;
    $data_sekarang=$ambarawa->getDataDetail($tanggal);
    $ambarawa->edit($request,$tanggal);
    $komulatif_nonangkutan= new NonAngkutan;
    //$request=$komulatif_nonangkutan->pecahAmbarawa($request);
    $selisih=$komulatif_nonangkutan->selisihAmbarawa($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'Ambarawa');
    //$data_ambarawa=$ambarawa->lihatData($tanggal);

    // dd($request);
    return redirect()->action('NonAngkutanController@lihatDataKomulatif');
  }
  public function vieweditambarawa(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal)->todatestring();
    }else {
      $tanggal=Carbon::now()->todatestring();
    }
    //Untuk Mendapatkan Data lawang
    $ambarawa=new PendapatanAmbarawa;
    $data_ambarawa=$ambarawa->lihatData($tanggal);
    return view('edit_ambarawa',compact('tanggal','data_ambarawa'));
  }
  public function delete_dataAmbarawa(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
    $ambarawa=new PendapatanAmbarawa;
    $data_sekarang=$ambarawa->getDataDetail($tanggal);
    $ambarawa->delete_dataAmbarawa($request->tanggal);
    $request->pendapatan_lokal_dewasa=0;
    $request->pendapatan_lokal_anak=0;
    $request->pendapatan_wisman_dewasa=0;
    $request->pendapatan_wisman_anak=0;
    $request->pendapatan_rts=0;
    $request->pendapatan_sewa_ka=0;

    $komulatif_nonangkutan= new NonAngkutan;
    $selisih=$komulatif_nonangkutan->selisihAmbarawa($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'Ambarawa');
    return redirect()->action('NonAngkutanController@lihatData');
  }
  public function cekTombolAmbarawa(Request $request){
      if($request->lihat!=null){
        return $this->lihatambarawa($request);
      }elseif ($request->edit!=null) {
          return $this->vieweditambarawa($request);
      }elseif ($request->delete!=null) {
            return $this->delete_dataAmbarawa($request);
      }
  }
//SELESAI BAGIAN AMBARAWA

//BAGIAN LAWANG SEWU
  public function indexLawangSewu(){
    $tanggal=Carbon::now()->todatestring();
    return view('tambah_pendapatan_lawang_sewu',compact('tanggal'));
  }
  public function tambahLawangSewu(Request $request){
    $pendapatan = new PendapatanLawang;
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
    if($this->cekDuplikasiLawang($tanggal,$pendapatan)){
      $pendapatan->tambahLawang($request);
      $komulatif=new NonAngkutan;
      $setelah=false;
      $kemarin=false;
      $sekarang=false;
      $total_pedapatan=$komulatif->totalPendapatanLawang($request);
      if($komulatif->ambilDataTahunLawang($tahun)->first()!=null){
        if($komulatif->ambilDataSekarang($tanggal,$tahun,'Lawang')->first()!=null){
          $sekarang=true;
        }
        if($komulatif->ambilDataSetelahLawang($tanggal,$tahun)->first()!=null){
          $setelah=true;
        }
        if($komulatif->ambilDataKemarinLawang($tanggal,$tahun)->first()!=null){
          $kemarin=true;
        }
        if($setelah==true){
            //setelah+=sekarang
          if($sekarang==true){
            $komulatif->updateDataKomulatifSekarang($total_pedapatan,$tanggal,$tahun,'Lawang');
          }elseif($kemarin==true&&$sekarang==false){
            $komulatif->tambahDataKemarinLawang($total_pedapatan,$tanggal,$tahun);
          }else{
            $komulatif->tambahDataSekarangLawang($tanggal,$total_pedapatan);
          }
          $komulatif->updateDataTambahLawang($total_pedapatan,$tanggal,$tahun);
        }else if($setelah==false && $kemarin==true){
            //kemarin + data request
            $komulatif->tambahDataKemarinLawang($total_pedapatan,$tanggal,$tahun);
        }
      }else{
        //tambah data sekarang
        $komulatif->tambahDataSekarangLawang($tanggal,$total_pedapatan);
      }
      return redirect()->action('NonAngkutanController@lihatDataKomulatif');
    }else{
      $errors = new MessageBag;
      $errors->add('duplikasi_data', 'Duplikasi Data Pada Tanggal '.tanggal_indo($tanggal));
      return view('tambah_pendapatan_lawang_sewu',compact('tanggal'))->withErrors($errors);
    }
  }
  public function lihatlawangsewu(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $lawang=new PendapatanLawang;
    $data_lawang=$lawang->lihatData($tanggal);

    return view('lihat_data_lawang',compact('data_lawang','tanggal'));
  }
  public function cekDuplikasiLawang($tanggal,$lawang){
    return $lawang->getDataDetail($tanggal)->first()==null;
  }
  public function editLawang(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else {
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    //Untuk Mendapatkan Data lawang
    //dd($request);
    $lawang=new PendapatanLawang;
    $data_sekarang=$lawang->getDataDetail($tanggal);
    $lawang->edit($request,$tanggal);
    $komulatif_nonangkutan= new NonAngkutan;

    $request=$komulatif_nonangkutan->pecahLawang($request);
    $selisih=$komulatif_nonangkutan->selisihLawang($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'Lawang');
    //dd($request);
    return redirect()->action('NonAngkutanController@lihatDataKomulatif');
  }
  public function vieweditLawang(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $lawang=new PendapatanLawang;
    $data_lawang=$lawang->lihatData($tanggal);
    //dd($data_lawang);
    return view('edit_lawang', compact('tanggal','data_lawang'));
  }
  public function delete_dataLawang(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
      $lawang=new PendapatanLawang;
    $data_sekarang=$lawang->getDataDetail($tanggal);
    $lawang->delete_dataLawang($request->tanggal);
    $request->pendapatan_lokal_dewasa=0;
    $request->pendapatan_lokal_anak=0;
    $request->pendapatan_wisman_dewasa=0;
    $request->pendapatan_wisman_anak=0;
    $komulatif_nonangkutan= new NonAngkutan;
    $selisih=$komulatif_nonangkutan->selisihLawang($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'Lawang');
    return redirect()->action('NonAngkutanController@lihatData');
  }
  public function cekTombolLawang(Request $request){
      if($request->lihat!=null){
        return $this->lihatlawangsewu($request);
      }elseif ($request->edit!=null) {
          return $this->vieweditLawang($request);
      }elseif ($request->delete!=null) {
            return $this->delete_dataLawang($request);
      }
  }
//SELESAI BAGIAN LAWANG SEWU

  //BAGIAN PA
  public function indexpa(){
    $tanggal=Carbon::now()->todatestring();
    return view('tambah_pendapatan_PA',compact('tanggal'));
  }
  public function tambahpa(Request $request){
     $pendapatan = new PendapatanPA;
     $tanggal=Carbon::parse($request->tanggal);
     $tahun=$tanggal->year;
     $tanggal=$tanggal->todatestring();
     if($this->cekDuplikasiPA($tanggal,$pendapatan)){
       $request=$this->konversiPa($request);
       $pendapatan->tambahpa($request);
       $komulatif=new NonAngkutan;
       $setelah=false;
       $kemarin=false;
       $sekarang=false;
       if($komulatif->ambilDataTahunPA($tahun)->first()!=null){
         if($komulatif->ambilDataSetelahPA($tanggal,$tahun)->first()!=null){
           $setelah=true;
         }

         if($komulatif->ambilDataSekarang($tanggal,$tahun,'PDDM')->first()!=null){
           $sekarang=true;
         }
         if($komulatif->ambilDataKemarinPA($tanggal,$tahun)->first()!=null){
           $kemarin=true;
         }
         if($setelah==true){
             //setelah+=sekarang
           if($sekarang==true){
             $komulatif->updateDataKomulatifSekarang($request->Pendapatan_PA,$tanggal,$tahun,'PDDM');
           }elseif($kemarin==true&&$sekarang==false){
             $komulatif->tambahDataKemarinPA($request,$tanggal,$tahun);
           }else{
             $komulatif->tambahDataSekarangPA($request);
           }
           $komulatif->updateDataTambahPA($request,$tanggal,$tahun);
         }else if($setelah==false && $kemarin==true){
             //kemarin + data request
             $komulatif->tambahDataKemarinPA($request,$tanggal,$tahun);
         }
       }else{
         //tambah data sekarang
         $komulatif->tambahDataSekarangPA($request);
       }
       return redirect()->action('NonAngkutanController@lihatDataKomulatif');
     }else{
       $errors = new MessageBag;
       $errors->add('duplikasi_data', 'Duplikasi Data Pada Tanggal '.tanggal_indo($tanggal));
       return view('tambah_pendapatan_PA',compact('tanggal'))->withErrors($errors);
     }
  }
  public function lihatPa(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $pa=new PendapatanPA;
    $data_pa=$pa->lihatData($tanggal);
    //dd($data_pa);
    return view('lihat_data_pa',compact('data_pa','tanggal'));
  }
  public function cekDuplikasiPA($tanggal,$pa){
    return $pa->getDataDetail($tanggal)->first()==null;
  }
  public function editPa(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else {
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    $request=$this->konversiPa($request);
    //Untuk Mendapatkan Data lawang
    //dd($request);
    $pa=new PendapatanPA;
    $data_sekarang=$pa->getDataDetail($tanggal);
    // dd($request->Pendapatan_PA);
    $pa->edit($request->Pendapatan_PA,$tanggal);
    //dd($request);
    $komulatif_nonangkutan= new NonAngkutan;
    $selisih=$komulatif_nonangkutan->selisihPa($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'PDDM');
    return redirect()->action('NonAngkutanController@lihatDataKomulatif');
  }
  public function vieweditPa(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $tanggal=$tanggal->todatestring();
    $pa=new PendapatanPA;
    $data_pa=$pa->lihatData($tanggal);
    //dd($data_pa);
    return view('edit_PA',compact('tanggal','data_pa'));
  }
  public function delete_dataPA(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
    $pa=new PendapatanPA;
    $data_sekarang=$pa->getDataDetail($tanggal);
    $pa->delete_dataPA($request->tanggal);
    $request->Pendapatan_PA=0;
    $komulatif_nonangkutan= new NonAngkutan;
    $selisih=$komulatif_nonangkutan->selisihPa($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'PDDM');
    //dd($selisih);
    return redirect()->action('NonAngkutanController@lihatData');
  }
  public function cekTombolPA(Request $request){
    if($request->edit!=null){
      return $this->vieweditPa($request);
    }elseif ($request->delete!=null) {
        return $this->delete_dataPA($request);
    }
  }
  public function konversiPa(Request $request){
      $request->Pendapatan_PA=rupiahtointeger($request->Pendapatan_PA);
        //dd($request);
        return $request;
  }
//SELESAI BAGIAN PA

  //BAGIAN UUK
  public function indexuuk(){
    $tanggal=Carbon::now()->todatestring();
    return view('tambah_pendapatan_uuk',compact('tanggal'));
  }
  public function tambahuuk(Request $request){
    $pendapatan = new PendapatanUUK;
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
     if($this->cekDuplikasiuuk($tanggal,$pendapatan)){
       $request=$this->konversiuuk($request);
       $pendapatan->tambahuuk($request);
       $komulatif=new NonAngkutan;
       $setelah=false;
       $kemarin=false;
       $sekarang=false;
       if($komulatif->ambilDataTahunUUK($tahun)->first()!=null){
         if($komulatif->ambilDataSekarang($tanggal,$tahun,'UUK')->first()!=null){
           $sekarang=true;
         }
         if($komulatif->ambilDataSetelahUUK($tanggal,$tahun)->first()!=null){
           $setelah=true;
         }
         if($komulatif->ambilDataKemarinUUK($tanggal,$tahun)->first()!=null){
           $kemarin=true;
         }
         if($setelah==true){
           if($sekarang==true){
             $komulatif->updateDataKomulatifSekarang($request->Pendapatan_UUK,$tanggal,$tahun,'UUK');
           }elseif($kemarin==true&&$sekarang==false){
             $komulatif->tambahDataKemarinUUK($request,$tanggal,$tahun);
           }else {
             $komulatif->tambahDataSekarangUUK($request);
           }
           $komulatif->updateDataTambahUUK($request,$tanggal,$tahun);
         }else if($setelah==false && $kemarin==true){
             //kemarin + data request
             $komulatif->tambahDataKemarinUUK($request,$tanggal,$tahun);
         }
       }else{
         //tambah data sekarang
         $komulatif->tambahDataSekarangUUK($request);
       }
       return redirect()->action('NonAngkutanController@lihatDataKomulatif');
     }else{
       $errors = new MessageBag;
       $errors->add('duplikasi_data', 'Duplikasi Data Pada Tanggal '.tanggal_indo($tanggal));
       return view('tambah_pendapatan_uuk',compact('tanggal'))->withErrors($errors);
     }
  }
  public function lihatuuk(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $uuk=new PendapatanUUK;
    $data_uuk=$uuk->lihatData($tanggal);
    //dd($data_pa);
    return view('lihat_data_uuk',compact('data_uuk','tanggal'));
  }
  public function cekDuplikasiuuk($tanggal,$uuk){
    return $uuk->getDataDetail($tanggal)->first()==null;
  }
  public function editUuk(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else {
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    $request=$this->konversiuuk($request);
    //Untuk Mendapatkan Data uuk
    //dd($request);
    $uuk=new PendapatanUUK;
    $data_sekarang=$uuk->getDataDetail($tanggal);
    // dd($request->Pendapatan_PA);
    $uuk->edit($request->Pendapatan_UUK,$tanggal);
    //dd($request);
    $komulatif_nonangkutan= new NonAngkutan;
    $selisih=$komulatif_nonangkutan->selisihuuk($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'UUK');
    return redirect()->action('NonAngkutanController@lihatDataKomulatif');
  }
  public function vieweditUuk(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    //Untuk Mendapatkan Data lawang
    $tanggal=$tanggal->todatestring();
    $uuk=new PendapatanUUK;
    $data_uuk=$uuk->lihatData($tanggal)->first();
    return view('edit_UUK',compact('tanggal','data_uuk'));
  }
  public function delete_dataUUK(Request $request){
    $tanggal=Carbon::parse($request->tanggal);
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();
    $uuk=new PendapatanUUK;
    $data_sekarang=$uuk->getDataDetail($tanggal);
    $uuk->delete_dataUUK($request->tanggal);
    $request->Pendapatan_UUK=0;
    $komulatif_nonangkutan= new NonAngkutan;
    $selisih=$komulatif_nonangkutan->selisihPa($request,$data_sekarang);
    //dd($selisih);
    $komulatif_nonangkutan->update_data($selisih,$tanggal,$tahun,'UUK');
    //dd($selisih);
    return redirect()->action('NonAngkutanController@lihatData');
  }
  public function cekTombolUUK(Request $request){
    if($request->edit!=null){
      return $this->vieweditUuk($request);
    }elseif ($request->delete!=null) {
        return $this->delete_dataUUK($request);
    }
  }
  public function konversiuuk(Request $request){
      $request->Pendapatan_UUK=rupiahtointeger($request->Pendapatan_UUK);
      return $request;
  }
// SELESAI BAGIAN UUK

//BAGIAM LIHAT DATA
  public function lihatData(Request $request){
    //dd($request);
    if($request->isMethod('post')){
      $tanggal=$request->tanggal;
      $tanggal=Carbon::parse($tanggal);
    }else{
      $tanggal=Carbon::now();
    }
    //dd($tanggal);
    //Untuk Mendapatkan Data lawang
    $tanggal=$tanggal->todatestring();
    $Lawang=new PendapatanLawang;
    $data_lawang=$Lawang->lihatData($tanggal);

    //Untuk Menjumlahkan data
    $total_pendapatan_lawang=0;
    foreach ($data_lawang as $i) {
      $total_pendapatan_lawang+=$i->total;
    }
    //Untuk Mendapatkan Data ambarawa
    $ambarawa=new PendapatanAmbarawa;
    $data_ambarawa=$ambarawa->lihatData($tanggal);
    //Untuk Menjumlahkan data Ambarawa
    $total_pendapatan_ambarawa=0;
    foreach ($data_ambarawa as $i) {
      $total_pendapatan_ambarawa+=$i->total;
    }
    //Untuk Mendapatkan Data PA
    $pendapat=new PendapatanPA;
    $pa=$pendapat->lihatData($tanggal);
    $total_pendapatan_pa=0;
    foreach ($pa as $a) {
      $total_pendapatan_pa=$a->value;
    }
    //Untuk Mendapatkan Data UUK
    $pendapat=new PendapatanUUK;
    $uuk=$pendapat->lihatData($tanggal);
    $total_pendapatan_uuk=0;
    foreach ($uuk as $a) {
      $total_pendapatan_uuk=$a->value;
    }
    //untuk Total
    $total=($total_pendapatan_pa+$total_pendapatan_ambarawa+$total_pendapatan_lawang+$total_pendapatan_uuk);
    //tanggal
    return view('lihat_all_data_non_angkutan',compact('tanggal','total_pendapatan_lawang','total_pendapatan_ambarawa','total_pendapatan_pa','total_pendapatan_uuk','total'));
  }
  public function lihatDataByDate(Request $request){
    //dd($request);
    return $this->lihatData($request);
  }
  public function lihatDataKomulatif(Request $request){

    if($request->isMethod('post')){
      $tanggal=$request->tanggal;
      $tanggal=Carbon::parse($request->tanggal);
    }else{
      $tanggal=Carbon::now();
    }
    $tahun=$tanggal->year;
    $tanggal=$tanggal->todatestring();

    $komulatif_non=new NonAngkutan;
    $data_komulatif_non=$komulatif_non->ambilSemuaDataKomulatif($tanggal);
    $target_non=new Target;
    $target_non=$target_non->getDataNonAngkutan($tahun);

    //Untuk Mendapatkan Data lawang
    $Lawang=new PendapatanLawang;
    $data_lawang=$Lawang->lihatData($tanggal);
    //Untuk Menjumlahkan data
    $total_pendapatan_lawang=0;
    foreach ($data_lawang as $i) {
      $total_pendapatan_lawang+=$i->total;
    }
    //Untuk Mendapatkan Data ambarawa
    $ambarawa=new PendapatanAmbarawa;
    $data_ambarawa=$ambarawa->lihatData($tanggal);
    //Untuk Menjumlahkan data Ambarawa
    $total_pendapatan_ambarawa=0;
    foreach ($data_ambarawa as $i) {
      $total_pendapatan_ambarawa+=$i->total;
    }
    //Untuk Mendapatkan Data PA
    $pendapat=new PendapatanPA;
    $pa=$pendapat->lihatData($tanggal);
    $total_pendapatan_pa=0;
    foreach ($pa as $a) {
      $total_pendapatan_pa=$a->value;
    }
    //Untuk Mendapatkan Data UUK
    $pendapat=new PendapatanUUK;
    $uuk=$pendapat->lihatData($tanggal);
    $total_pendapatan_uuk=0;
    foreach ($uuk as $a) {
      $total_pendapatan_uuk=$a->value;
    }
    //untuk Total
    $total_pendapatan=($total_pendapatan_pa+$total_pendapatan_ambarawa+$total_pendapatan_lawang+$total_pendapatan_uuk);

    return view('lihat_data_rekap_non_penumpang',compact('data_komulatif_non','tanggal','target_non','total_pendapatan_lawang','total_pendapatan_ambarawa','total_pendapatan_pa','total_pendapatan_uuk','total_pendapatan'));
  }

}
