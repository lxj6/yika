<?php


namespace App\Http\Controllers;


class MessageController extends BaseController
{

    public function index(){
        return view('message\index');
    }


}

