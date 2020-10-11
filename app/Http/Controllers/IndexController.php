<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;

class IndexController extends BaseController
{


    public function index(){

        return view('index\index');
    }

    public function welcome(){

        return view('index\welcome');
    }


}
