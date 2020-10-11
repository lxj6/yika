<?php

namespace App\Http\Controllers;

class SystemController extends BaseController
{


    public function index(){
        return view('system\index');
    }
}
