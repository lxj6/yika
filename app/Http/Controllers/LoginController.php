<?php

namespace App\Http\Controllers;

class LoginController extends BaseController
{

    public function login(){
        return view("login\login");
    }
}
