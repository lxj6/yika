<?php


namespace App\Http\Controllers;


use App\Message;

class MessageController extends BaseController
{

    public function index(){
        $msgs = Message::get();
        return view('message/index',['msgs'=>$msgs]);
    }


}

