<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\komulatif_barang;
use App\Barang;
use App\komulatif_penumpang;
use App\Penumpang;
use App\NonAngkutan;
use App\PendapatanPA;
use App\PendapatanAmbarawa;
use App\PendapatanLawang;
use App\BHP;
use App\komulatif_bhp;
use App\Target;
use Carbon\Carbon;
use App\Http\Controllers\KomulatifController;
class ExcelController extends Controller{
    //
    public function exportLaporanHarian(Request $request){
      if($request->isMethod('post')){
        $tanggal=Carbon::parse($request->tanggal);
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }else{
        $tanggal=Carbon::now();
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }
      $hariini=Carbon::now()->todatestring();
      $komulatif_controller= new KomulatifController;
      $data_penumpang=$komulatif_controller->getDataPenumpang($tanggal);
      $data_barang=$komulatif_controller->getDataBarang($tanggal);
      $data_bhp=$komulatif_controller->getDataBHP($tanggal);
      //dd($data_bhp);
      // $data_bhp=$komulatif_controller->getTotalBHP($data_bhp);
      $data_nonangkutan=$komulatif_controller->getDataNonAngkutan($tanggal);

      $data_komulatif_penumpang=$komulatif_controller->getDataKomulatifPenumpang($tanggal);
      $data_komulatif_barang=$komulatif_controller->getDataKomulatifBarang($tanggal);
      $data_komulatif_nonangkutan=$komulatif_controller->getDataKomulatifNonAngkutan($tanggal);

      $target_penumpang=$komulatif_controller->getDataTargetPenumpang($tahun);
      $target_barang=$komulatif_controller->getDataTargetBarang($tahun);
      $target_nonangkutan=$komulatif_controller->getDataTargetNonangkutan($tahun);
      //dd($data_bhp);
      return view('download_harian',compact('data_penumpang','data_komulatif_penumpang','data_komulatif_barang','data_barang','data_nonangkutan','data_komulatif_nonangkutan','target_barang','target_penumpang','target_nonangkutan','tanggal','tahun','hariini'));
    }
    public function exportLaporanKomulatif(Request $request){
      if($request->isMethod('post')){
        $tanggal=Carbon::parse($request->tanggal);
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }else{
        $tanggal=Carbon::now();
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }
      $komulatif_controller= new KomulatifController;
      $data_komulatif_bhp=$komulatif_controller->getDataKomulatifBHP($tanggal);
      $data_komulatif_penumpang=$komulatif_controller->getDataKomulatifPenumpang($tanggal);
      $data_penumpang=$komulatif_controller->getDataPenumpang($tanggal);
      $data_komulatif_barang=$komulatif_controller->getDataKomulatifBarang($tanggal);
      $data_barang=$komulatif_controller->getDataBarang($tanggal);
      $data_komulatif_nonangkutan=$komulatif_controller->getDataKomulatifNonAngkutan($tanggal);
      $data_nonangkutan=$komulatif_controller->getDataNonAngkutan($tanggal);

      $target_penumpang=$komulatif_controller->getDataTargetPenumpang($tahun);
      $target_barang=$komulatif_controller->getDataTargetBarang($tahun);
      $target_nonangkutan=$komulatif_controller->getDataTargetNonangkutan($tahun);
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

      return view('download_komulatif',compact('data_komulatif_barang','data_barang','data_penumpang','data_komulatif_penumpang','data_nonangkutan','data_komulatif_nonangkutan','total_pendapatan','data_komulatif_bhp','target_penumpang','target_barang','target_nonangkutan','tanggal','tahun'));
    }
    public function exportLaporanKaDaop(Request $request){
      if($request->isMethod('post')){
        $tanggal=Carbon::parse($request->tanggal);
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();

      }else{
        $tanggal=Carbon::now();
        $tahun=$tanggal->year;
        $tanggal=$tanggal->todatestring();
      }
      $hariini=Carbon::now()->todatestring();
      $komulatif_controller= new KomulatifController;
      $data_komulatif_bhp=$komulatif_controller->getDataKomulatifBHP($tanggal);
      $data_komulatif_penumpang=$komulatif_controller->getDataKomulatifPenumpang($tanggal);
      $data_penumpang=$komulatif_controller->getDataPenumpang($tanggal);
      $data_komulatif_barang=$komulatif_controller->getDataKomulatifBarang($tanggal);
      $data_barang=$komulatif_controller->getDataBarang($tanggal);
      $data_komulatif_nonangkutan=$komulatif_controller->getDataKomulatifNonAngkutan($tanggal);
      $data_nonangkutan=$komulatif_controller->getDataNonAngkutan($tanggal);

      $target_penumpang=$komulatif_controller->getDataTargetPenumpang($tahun);
      $target_barang=$komulatif_controller->getDataTargetBarang($tahun);
      $target_nonangkutan=$komulatif_controller->getDataTargetNonangkutan($tahun);
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

      return view('download_ka_daop',compact('data_komulatif_barang','data_barang','data_penumpang','data_komulatif_penumpang','data_nonangkutan','data_komulatif_nonangkutan','total_pendapatan','data_komulatif_bhp','target_penumpang','target_barang','target_nonangkutan','tanggal','tahun','hariini'));
    }
    public function test(){
      $penumpang = new komulatif_penumpang;
      $data_penumpang = $penumpang->whereYear('created_at','=',2018)->where('created_at','>=','2018-03-29')->get();
      dd($data_penumpang);
      foreach ($data_penumpang as $i) {
        $data=$penumpang->find($i->id)->get()->first();
        $data->update([
          $data->pendapatan+=5000
        ]);
        dd($data);
      }
    }
}
