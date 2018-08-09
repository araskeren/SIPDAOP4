<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Penumpang;
use App\Barang;
use App\PendapatanAmbarawa;
use App\PendapatanLawang;
use App\PendapatanPA;
use App\PendapatanUUK;
use Carbon\Carbon;
class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function komulatif2($val){
      $sekarang=Carbon::now();
      $tanggal_max=Carbon::now();
      $tanggal_min=$sekarang->subDays(7);
      if($val!=null){
        if($val==30){
          $tanggal_min=$sekarang->subMonth(1);
        }
        if($val==365){
          if($sekarang->year==2018){
            $tanggal_min=Carbon::create($sekarang->year, 05, 24, 0);
          }
          else{
            $tanggal_min=Carbon::create($sekarang->year, 1, 1, 0);
          }
        }
      }
      $penumpang=Penumpang::select('created_at','jenis','volume','pendapatan')->whereBetween('created_at',[$tanggal_min->toDateString(),$tanggal_max->toDateString()])->get();
      $barang=Barang::select('created_at','jenis','volume','pendapatan')->whereBetween('created_at',[$tanggal_min->toDateString(),$tanggal_max->toDateString()])->get();
      $nonangkutan=$this->getNonAngkutan($tanggal_min->toDateString(),$tanggal_max->toDateString());

      return view('chart_komulatif',compact('penumpang','barang','nonangkutan'));
    }
    public function komulatif(){
      $sekarang=Carbon::now();
      $tanggal_max=Carbon::now();
      $tanggal_min=$sekarang->subDays(7);

      $penumpang=Penumpang::select('id','created_at','jenis','volume','pendapatan')->whereBetween('created_at',[$tanggal_min->toDateString(),$tanggal_max->toDateString()])->get();
      $barang=Barang::select('created_at','jenis','volume','pendapatan')->whereBetween('created_at',[$tanggal_min->toDateString(),$tanggal_max->toDateString()])->get();
      $nonangkutan=$this->getNonAngkutan($tanggal_min->toDateString(),$tanggal_max->toDateString());
      //$penumpang=$this->konversi($penumpang);

      return view('chart_komulatif',compact('penumpang','barang','nonangkutan'));
    }
    private function konversi($penumpang){
      foreach ($penumpang as $i){
        $temp_penumpang[]=[
          'created_at'=>Carbon::parse($i['created_at'])->toDateString(),
          'jenis'=>$i->jenis,
          'volume'=>$i->volume,
          'pendapatan'=>$i->pendapatan,
        ];
      }
      return $temp_penumpang;
    }
    private function getNonAngkutan($min,$max){
      $ambarawa = PendapatanAmbarawa::select('created_at','total')->whereBetween('created_at',[$min,$max])->get();
      $lawang = PendapatanLawang::select('created_at','total')->whereBetween('created_at',[$min,$max])->get();
      $pa=PendapatanPA::select('created_at','value')->whereBetween('created_at',[$min,$max])->get();
      $uuk=PendapatanUUK::select('created_at','value')->whereBetween('created_at',[$min,$max])->get();

      $sekarang=$ambarawa[0]->created_at;
      $total=0;
      $dataambarawa=null;
      foreach ($ambarawa as $i){
        if($sekarang==$i->created_at){
          $total+=$i->total;
        }else{
          $dataambarawa[]=[
            'created_at'=>$sekarang,
            'total'=>$total,
          ];
          $sekarang=$i->created_at;
          $total=$i->total;
        }
      }

      $sekarang=$lawang[0]->created_at;
      $total=0;
      $datalawang=null;
      foreach ($lawang as $i){
        if($sekarang==$i->created_at){
          $total+=$i->total;
        }else{
          $datalawang[]=[
            'created_at'=>$sekarang,
            'total'=>$total,
          ];
          $sekarang=$i->created_at;
          $total=$i->total;
        }
      }
      $total_lawang=0;
      $total_ambarawa=0;
      $total_pa=0;
      $total_uuk=0;
      $nonangkutan=null;

      foreach ($datalawang as $i){
        $total_lawang=$i['total'];
        foreach($dataambarawa as $j){
          if($j['created_at'] == $i['created_at']){
            $total_ambarawa=$j['total'];
            break;
          }
        }
        foreach($pa as $j){
          if($j->created_at == $i['created_at']){
            $total_pa=$j->value;
            break;
          }
        }
        foreach($uuk as $j){
          if($j->created_at == $i['created_at']){
            $total_uuk=$j->value;
            break;
          }
        }
        $nonangkutan[]=[
          'created_at'=>Carbon::parse($i['created_at'])->toDateString(),
          'lawang'=>$total_lawang,
          'ambarawa'=>$total_ambarawa,
          'pa'=>$total_pa,
          'uuk'=>$total_uuk,
        ];
      }
      return $nonangkutan;
    }
}
