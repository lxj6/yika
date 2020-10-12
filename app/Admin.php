<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $fillable = ['username','password'];

    public static function login($login, $pwd)
    {
        $admin = Admin::where('username', $login)->first();

        if ($admin == null) {
            return null;
        }

        if ($admin->password !== md5($pwd)) {
            return null;
        }

        $admin->last_time = date('Y-m-d H:i:s');
        $admin->save();

        return $admin->toArray();
    }

    public static function setPwd($user,$pwd){

        $admin = Admin::where('username',$user)->update(['password'=>md5($pwd)]);

        if($admin){
            return true;
        }
        return false;
    }

}
