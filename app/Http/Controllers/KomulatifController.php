<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\komulatif_barang;
use App\Barang;
use App\komulatif_penumpang;
use App\Penumpang;
use App\NonAngkutan;
use App\PendapatanPA;
use App\PendapatanUUK;
use App\PendapatanAmbarawa;
use App\PendapatanLawang;
use App\BHP;
use App\komulatif_bhp;
use App\Target;
use Carbon\Carbon;
class KomulatifController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function viewRekapHarian(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else{
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    //dd($kemarin);
    $data_penumpang=$this->getDataPenumpang($tanggal);
    $data_komulatif_penumpang=$this->getDataKomulatifPenumpang($tanggal,$tahun);
    $data_barang=$this->getDataBarang($tanggal);
    $data_bhp=$this->getDataBHP($tanggal);
    $data_komulatif_barang=$this->getDataKomulatifBarang($tanggal,$tahun);
    $data_nonangkutan=$this->getDataNonAngkutan($tanggal);
    $data_komulatif_nonangkutan=$this->getDataKomulatifNonAngkutan($tanggal,$tahun);
    $target_penumpang=$this->getDataTargetPenumpang($tahun);
    $target_barang=$this->getDataTargetBarang($tahun);
    $target_nonangkutan=$this->getDataTargetNonangkutan($tahun);
    if(count($target_penumpang)>0 && count($target_barang)>0 && count($target_nonangkutan)>0){
      return view('rekap_harian',compact('data_penumpang','data_komulatif_penumpang','data_komulatif_barang','data_barang','data_nonangkutan','data_komulatif_nonangkutan','target_barang','target_penumpang','target_nonangkutan','tanggal','tahun'));
    }else{
      return 'Silahkan inputkan data target tahun '.$tahun.' terlebih dahulu';
    }
  }
  public function viewRekapKomulatif(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else{
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    $data_komulatif_bhp=$this->getDataKomulatifBHP($tanggal);
    $data_komulatif_penumpang=$this->getDataKomulatifPenumpang($tanggal);
    $data_penumpang=$this->getDataPenumpang($tanggal);
    $data_komulatif_barang=$this->getDataKomulatifBarang($tanggal);
    $data_barang=$this->getDataBarang($tanggal);
    $data_komulatif_nonangkutan=$this->getDataKomulatifNonAngkutan($tanggal);
    $data_nonangkutan=$this->getDataNonAngkutan($tanggal);

    $target_penumpang=$this->getDataTargetPenumpang($tahun);
    $target_barang=$this->getDataTargetBarang($tahun);
    $target_nonangkutan=$this->getDataTargetNonangkutan($tahun);
    $hasil=0;
    if(count($data_penumpang)>0){
      foreach($data_penumpang as $i){
        $hasil+=$i->pendapatan;
      }
    }
    $data_penumpang=$hasil;
    $hasil=0;
    if(count($data_barang)>0){
      foreach($data_barang as $aa){
        if($aa->kategori=="Pendapatan"){
        $hasil+=$aa->value;
      }
      }
    }
    $data_barang=$hasil;
    $hasil=0;
    if($data_nonangkutan!=null){
      foreach ($data_nonangkutan as $key => $value){
        $hasil+=$value;
      }
    }
    $data_nonangkutan=$hasil;
    $total_pendapatan=$data_barang+$data_penumpang+$data_nonangkutan;
    return view('rekap_komulatif',compact('data_komulatif_barang','data_barang','data_penumpang','data_komulatif_penumpang','data_nonangkutan','data_komulatif_nonangkutan','total_pendapatan','data_komulatif_bhp','target_penumpang','target_barang','target_nonangkutan','tanggal','tahun'));
  }
  public function viewRekapKaDaop(Request $request){
    if($request->isMethod('post')){
      $tanggal=Carbon::parse($request->tanggal);
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }else{
      $tanggal=Carbon::now();
      $tahun=$tanggal->year;
      $tanggal=$tanggal->todatestring();
    }
    $data_penumpang=$this->getDataPenumpang($tanggal);
    $data_komulatif_penumpang=$this->getDataKomulatifPenumpang($tanggal);
    $data_barang=$this->getDataBarang($tanggal);
    $data_komulatif_barang=$this->getDataKomulatifBarang($tanggal);
    $data_nonangkutan=$this->getDataNonAngkutan($tanggal);
    $data_komulatif_nonangkutan=$this->getDataKomulatifNonAngkutan($tanggal);
    $target_penumpang=$this->getDataTargetPenumpang($tahun);
    $target_barang=$this->getDataTargetBarang($tahun);
    $target_nonangkutan=$this->getDataTargetNonangkutan($tahun);
    $hasil=0;
    if(count($data_penumpang)>0){
      foreach($data_penumpang as $i){
        $hasil+=$i->pendapatan;
      }
    }
    $data_penumpang=$hasil;
    $hasil=0;
    if(count($data_barang)>0){
      foreach($data_barang as $aa){
        $hasil+=$aa->pendapatan;
      }
    }
    $data_barang=$hasil;
    $hasil=0;
    if($data_nonangkutan!=null){
      foreach ($data_nonangkutan as $key => $value){
        $hasil+=$value;
      }
    }
    $data_nonangkutan=$hasil;
    $total_pendapatan=$data_barang+$data_penumpang+$data_nonangkutan;
    return view('Laporan_KA',compact('data_komulatif_barang','data_barang','data_penumpang','data_komulatif_penumpang','data_nonangkutan','data_komulatif_nonangkutan','total_pendapatan','data_komulatif_bhp','target_penumpang','target_barang','target_nonangkutan','tanggal','tahun'));
  }
  public function getDataBarang($tanggal){
    $barang=new Barang;
    $data_barang=$barang->ambilBarang($tanggal);
    return $data_barang;
  }
  public function getDataBHP($tanggal){
    $bhp=new BHP;
    return $bhp->ambilBHP($tanggal);
  }
  public function getTotalBHP($data){
    $hasil=0;
    if(count($data)>0){
      foreach ($data as $i) {
        $hasil+=$i->value;
      }
    }
    return $hasil;
  }
  public function getDataKomulatifBarang($tanggal,$tahun){
    $komulatif_barang=new komulatif_barang;
    $data_komulatif_barang=$komulatif_barang->ambilDataNow($tanggal,$tahun);
    return $data_komulatif_barang;
  }
  public function getDataPenumpang($tanggal){
    $penumpang=new Penumpang;
    $data_penumpang=$penumpang->getData($tanggal);
    return $data_penumpang;
  }
  public function getDataKomulatifPenumpang($tanggal,$tahun){
    $komulatif_penumpang=new komulatif_penumpang;
    $data_komulatif_penumpang=$komulatif_penumpang->ambilDataNow($tanggal,$tahun);
    return $data_komulatif_penumpang;
  }
  public function getDataNonAngkutan($tanggal){
    $pa=new PendapatanPA;
    $pa=$pa->lihatData($tanggal)->first();
    $uuk=new PendapatanUUK;
    $uuk=$uuk->lihatData($tanggal)->first();
    $ambarawa = new PendapatanAmbarawa;
    $ambarawa=$ambarawa->lihatData($tanggal);
    $lawang=new PendapatanLawang;
    $lawang=$lawang->lihatData($tanggal);

    $data_ambarawa=0;
    foreach ($ambarawa as $i) {
      $data_ambarawa+=$i->total;
    }
    $data_lawang=0;
    foreach ($lawang as $i) {
      $data_lawang+=$i->total;
    }
    if($pa==null){
      $pa=0;
    }else{
      $pa=$pa->value;
    }
    if($uuk==null){
      $uuk=0;
    }else{
      $uuk=$uuk->value;
    }
    if($data_ambarawa==null){
      $data_ambarawa=0;
    }
    if($data_lawang==null){
      $data_lawang=0;
    }
    $data=array(
      'PDDM'=>$pa,
      'Ambarawa'=>$data_ambarawa,
      'Lawang Sewu'=>$data_lawang,
      'UUK'=>$uuk,
    );

    return $data;
  }
  public function getDataKomulatifNonAngkutan($tanggal,$tahun){
    $komulatif_nonangkutan=new NonAngkutan;
    $data_komulatif_nonangkutan=$komulatif_nonangkutan->ambilSemuaDataNow($tanggal,$tahun);
    dd($data_komulatif_nonangkutan);
    return $data_komulatif_nonangkutan;
  }
  public function getDataKomulatifBHP($tanggal){
    $komulatif_bhp=new komulatif_bhp;
    $data_komulatif_bhp=$komulatif_bhp->ambilDatasekarang($tanggal);
    return $data_komulatif_bhp;
  }

  public function getDataTargetPenumpang($tahun){
    $target=new Target;
    return $target->getDataPenumpang($tahun);
  }
  public function getDataTargetBarang($tahun){
    $target=new Target;
    return $target->getDataBarang($tahun);
  }
  public function getDataTargetNonangkutan($tahun){
    $target=new Target;
    return $target->getDataNonAngkutan($tahun);
  }
}
