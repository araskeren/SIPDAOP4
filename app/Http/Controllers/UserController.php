<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function lihat(){
      $data_user= $this->getdata();
      return view('tambah_user',compact('data_user'));
  }
  public function getdata()
  {
      $user= new User;
      return $user->getall();
  }
  public function tambah(Request $request){
    $user=new User;
    $user->tambah($request);
    return redirect()->action('UserController@lihat');
  }
  public function editView($id){
    $user=new User;
    $user=$user->getDataUser($id);
    $data_user=$this->getdata();

    return view('edit_user',compact('data_user','user'));
  }
  public function edit(Request $request){
    $user=new User;
    $user=$user->update_data($request);
    return redirect()->action('UserController@lihat');
  }
  public function delete($id){
    User::where('id','=',$id)->delete();
    return redirect()->action('UserController@lihat');
  }
  public function cektombol(Request $request){
    $id=$request->id;
    //dd($id);
    if($request->edit==1){
      return $this->editView($id);
    }else if($request->delete==1){
      return $this->delete($id);
    }
  }
}
