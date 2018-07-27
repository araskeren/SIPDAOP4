<?php

namespace App\Http\Controllers;
use App\Stasiun;
use Illuminate\Http\Request;

class StasiunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexStasiun(){
      $stasiun = new Stasiun;
      $data=$stasiun->ambilSemuaData();
      return view('tambah_stasiun',compact('data'));
    }
    public function viewStasiunPenumpang(){
      $stasiun = new Stasiun;
      $data=$stasiun->ambilSemuaData()->sortByDesc('stasiun_penumpang');
      return view('tambah_stasiun_penumpang',compact('data'));
    }
    public function viewStasiunBarang(){
      $stasiun = new Stasiun;
      $data=$stasiun->ambilSemuaData()->sortByDesc('stasiun_barang');
      return view('tambah_stasiun_barang',compact('data'));
    }
    public function editStasiun($id){
      $stasiun = new Stasiun;
      $data=$stasiun->ambilSemuaData();
      $data_stasiun=$stasiun->ambilDataStasiun($id);
      return view('edit_stasiun',compact('data','data_stasiun'));
    }

    public function edit(Request $request){
      $stasiun = new Stasiun;
      $stasiun->find($request->id)->update([
        'nama_stasiun'=>$request->namaStasiun,
        'stasiun_barang'=>$request->stasiun_barang,
        'stasiun_penumpang'=>$request->stasiun_penumpang,
      ]);
      return redirect()->action('StasiunController@indexStasiun');
    }
    public function lihat($id){
      $stasiun = new Stasiun;
      $data=$stasiun->ambilSemuaData();
      $data_stasiun=$stasiun->ambilDataStasiun($id);
      return view('lihat_stasiun',compact('data','data_stasiun'));
    }
    public function delete($id){
      $stasiun = new Stasiun;
      $stasiun->find($id)->delete();
      return redirect()->action('StasiunController@indexStasiun');
    }
    public function cekTombol(Request $request){
      $id=$request->id;
      if($request->lihat==1){
        return $this->lihat($id);
      }elseif($request->edit==1){
        return $this->editStasiun($id);
      }elseif($request->delete==1){
        return $this->delete($id);
      }
    }
    public function cekTombolPenumpang(Request $request){
      $id=$request->id;
      //dd($id);
      if($request->NonAktifkan==1){
        $this->editStasiunPenumpang($id,0);
      }elseif($request->Aktifkan==1){
        $this->editStasiunPenumpang($id,1);
      }
      return redirect()->action('StasiunController@viewStasiunPenumpang');
    }
    public function cekTombolBarang(Request $request){
      $id=$request->id;
      if($request->NonAktifkan==1){
        $this->editStasiunBarang($id,0);
      }elseif($request->Aktifkan==1){
        $this->editStasiunBarang($id,1);
      }
      return redirect()->action('StasiunController@viewStasiunBarang');
    }
    public function tambah(Request $request){
      $stasiun = new Stasiun;
      $stasiun->tambah($request);
      return redirect()->action('StasiunController@indexStasiun');
    }
    public function tambahStasiunPenumpang(Request $request){
      $stasiun = new Stasiun;
      $stasiun->tambahPenumpang($request);
      return redirect()->action('StasiunController@viewStasiunPenumpang');
    }
    public function tambahStasiunBarang(Request $request){
      $stasiun = new Stasiun;
      $stasiun->tambahBarang($request);
      return redirect()->action('StasiunController@viewStasiunBarang');
    }
    public function editStasiunPenumpang($id,$value){
      $stasiun = new Stasiun;
      $stasiun->where('id','=',$id)->get()->first()->update([
        'stasiun_penumpang'=>$value,
      ]);
    }
    public function editStasiunBarang($id,$value){
      $stasiun = new Stasiun;
      $stasiun->where('id','=',$id)->get()->first()->update([
        'stasiun_barang'=>$value,
      ]);
    }

}
