<?php


namespace App\Http\Controllers;

use App\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{


    public function index(){
        return view('article\index');
    }


    public function category(){
        $res = ArticleCategory::get();
        return view('article\category',['cats'=>$res]);
    }

    public function add_article(Request $request){
        if($request->isMethod('post')){

        }
        return view('article\add_article');
    }

    public function add_category(Request $request){
        if($request->isMethod('post')){
            $res = ArticleCategory::create($request->all());
            if($res){
                $data = [
                    'code' => 200,
                    'msg'  => '添加成功'
                ];
                return response()->json($data);
            }
        }

        return view('article\add_category');
    }

    public function edit_category(Request $request){
        if($request->isMethod('post')){
            $get = $request->all();
            $id = $get['id'];
            unset($get['id']);
            ArticleCategory::where('id',$id)->update($get);
            return response()->json(['code'=>200,'msg'=>'修改成功']);
        }
        $id = $request->input('id');
        $info = ArticleCategory::find($id);
        return view('article\edit_category',['info'=>$info]);
    }

}
