<?php

namespace App\Http\Controllers;

class BannerController extends BaseController
{
    public function index(){
        return view('banner\index');
    }
}

