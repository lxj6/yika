<?php

namespace App\Http\Controllers;


use App\Admin;
use App\AdminConf;
use App\Article;
use App\ArticleCategory;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{

    public function test(){
        //config(['app.test'=>'test']);
    }


    public function index(){
        return view('index/index');
    }

    public function welcome(){
        $res = Admin::get();
        $count = [
            'user' => count($res),
            'art' => Article::count(),
            'msg' => Message::count(),
            'cat' => ArticleCategory::count(),
        ];
        return view('index/welcome',['users'=>$res,'count'=>$count]);
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
        return view('index/update_pass');
    }


    public function upload(Request $request){

        $file = $request->file('image');
        // 文件是否上传成功
        if ($file->isValid()) {

            $ext = $file->getClientOriginalExtension();     // 扩展名
            // 拼接文件名称
            $imgPath = public_path('upload/');
            $filename =  date('YmdHis').mt_rand(1000,9999).'.'.$ext;

            $path = $file->move($imgPath,$filename);
            if($path){
                $img_path = asset('upload').'/'.$filename;
                DB::table('upload_log')->insert(['img_path'=>$img_path,'insert_time'=>date('Y-m-d H:i:s')]);
                $return = [
                    'code' => 200,
                    'msg' => '上传成功',
                    'data' => [
                        'url' => $img_path,
                    ],
                ];
                return response()->json($return);
            }else{
                $return = [
                    'code' => 0,
                    'msg' => '上传失败',
                ];
                return response()->json($return);
            }
        }else{
            $return = [
                'code' => 0,
                'msg' => '上传失败,文件不合法',
            ];
            return response()->json($return);
        }
    }

    public function getConfig(Request $request){
        $config = AdminConf::first()->toArray();
        return response()->json(['code' => 200 , 'msg' => '请求成功' , 'data' => $config]);
    }

}
