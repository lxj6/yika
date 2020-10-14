<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class LoginController extends BaseController
{

    public function login(Request $request){

        if($request->isMethod('post')){

            $login = Admin::login($request->input('username'),$request->input('password'));

            if(!$login){
                $data = [
                    'code' => 0,
                    'msg' => '账号密码有误!'
                ];
                return response()->json($data);
            }

            session()->put(['admin'=>$login]);

            $data = [
                'code' => 200,
                'msg' => '登录成功!'
            ];
            return response()->json($data);

        }
        return view("login/login");
    }

    public function out(Request $request){
        if($request->isMethod('post')){

            session()->flush();
            $data = [
                'code' => 200,
                'msg' => '退出成功!'
            ];
            return response()->json($data);

        }
    }
}
