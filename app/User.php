<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
    * Untuk mendapatkan data penumpang yang berelasi dengan User.
    */
    public function penumpang(){
      return $this->hasMany(Penumpang::class);
    }
    public function tambah(Request $request){
      $this->create([
        'name' => $request->nama,
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'level' => $request->level,
      ]);
    }
    public function update_data(Request $request){
      if($request->password!=null){
        $this->where('id','=',$request->id)->update([
          'name'=>$request->nama,
          'username'=>$request->username,
          'email'=>$request->email,
          'password' => bcrypt($request->password),
          'level'=>$request->level,
        ]);
      }else{
        $this->where('id','=',$request->id)->update([
          'name'=>$request->nama,
          'username'=>$request->username,
          'email'=>$request->email,
          'level'=>$request->level,
        ]);
      }
    }
    public function getall()
    {
      return $this->all();
    }
    public function getDataUser($id){
      //dd();
      return $this->where('id','=',$id)->get()->first();

    }
}
