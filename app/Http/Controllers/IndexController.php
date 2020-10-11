<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{


    public function test(){
        dd(Session::all());
    }


    public function test1(){
        $res = Session::get('test');
        echo $res;
    }
}
