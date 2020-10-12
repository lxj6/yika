<?php

namespace App\Http\Controllers;


use App\Admin;
use App\Article;
use App\Message;
use Illuminate\Http\Request;

class IndexController extends BaseController
{

    public function test(){
        //config(['app.test'=>'test']);
    }


    public function index(){
        return view('\index\index');
    }

    public function welcome(){
        $res = Admin::get();
        $count = [
            'user' => count($res),
            'art' => Article::count(),
            'msg' => Message::count(),
        ];
        return view('\index\welcome',['users'=>$res,'count'=>$count]);
    }

    public function update_pass(Request $request){
        if($request->isMethod('post')){
            if(md5($request->input('old_pass')) != session('admin.password')){
                $data = [
                    'code' => 0,
                    'msg' => '原密码输入有误',
                ];
                return response()->json($data);
            }
            $res = Admin::setPwd(session('admin.username'),$request->input('new_pass'));
            if($res){
                $data = [
                    'code' => 200,
                    'msg' => '操作成功，请重新登录',
                ];
                session()->flush();
                return response()->json($data);
            }

        }
        return view('index\update_pass');
    }

}
