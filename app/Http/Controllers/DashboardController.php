<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Penumpang;
class DashboardController extends Controller
{
    public function index(){
      $data=$this->getRegresiLinier('Eksekutif');
      return view('index',compact('data'));
    }
    public function cekUser(){
      if(Auth::check()){
        return $this->index();
      }else{
        return view('login_user');
      }
    }
    public function getRegresiLinier($jenis){
      $penumpang= new Penumpang;
      $data=$penumpang->where('created_at','!=','2018-05-23')->where('jenis',$jenis)->get();
      return $data;
    }
}
