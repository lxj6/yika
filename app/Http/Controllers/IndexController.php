<?php

namespace App\Http\Controllers;


use App\Admin;
use Illuminate\Support\Facades\Session;

class IndexController extends BaseController
{

    public function test(){
        //config(['app.test'=>'test']);
    }


    public function index(){
        return view('\index\index');
    }

    public function welcome(){

        return view('\index\welcome');
    }


}
