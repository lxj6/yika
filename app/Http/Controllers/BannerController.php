<?php

namespace App\Http\Controllers;


use App\Banner;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    public $banner = [
                        1 => "首页",
                        2 => "关于我们",
                        3 => "系统开发",
                        4 => "招商加盟",
                        5 => "行业资讯",
                        6 => "联系我们"
    ];

    public function index(){
        $list = Banner::get();
        return view('banner/index',['list'=>$list,'position'=>$this->banner]);
    }

    public function add_banner(Request $request){
        if($request->isMethod('post')){
            Banner::create($request->all());
            return response()->json(['code'=>200,'msg'=>'上传成功']);
        }
        return view('banner/add_banner',['position'=>$this->banner]);
    }

    public function del_banner(Request $request){
        $id = $request->input('id');
        Banner::destroy($id);
        return response()->json(['code'=>200,'msg'=>'删除成功']);
    }

    public function getBanner(Request $request){

        if($request->input('position')){
            $banners = Banner::where('position',$request->input('position'))->get(['title','url','path']);
            if($banners){
                $banners = $banners->toArray();
                return response()->json(['code'=>200,'msg'=>'请求成功','data'=>['url' => $banners]]);
            }
        }

    }
}

