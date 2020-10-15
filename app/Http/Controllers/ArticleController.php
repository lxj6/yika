<?php


namespace App\Http\Controllers;

use App\Article;
use App\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{


    public function index(Request $request){
        $map = [];
        if($request->isMethod('get')){
            $map[] = ['title','like',"%{$request->input('title')}%"];
        }

        $arts = Article::with('articleCat')->where($map)->select(['id','title','category_id','created_at'])->paginate(20);

        $arts->withPath('/article/index');
        return view('article/index',['arts'=>$arts]);
    }


    public function category(){
        $res = ArticleCategory::get();
        return view('article/category',['cats'=>$res]);
    }

    public function add_article(Request $request){
        if($request->isMethod('post')){
            $insert = $request->all();
            $insert['content'] = htmlspecialchars($insert['content']);
            Article::create($insert);
            $return = [
                'code' => 200,
                'msg' => '添加成功',
            ];
            return response()->json($return);
        }
        $categorys = ArticleCategory::get();
        return view('article/add_article',['cats'=>$categorys]);
    }

    public function edit_article(Request $request){
        if($request->isMethod('post')){
            $get = $request->all();
            $id = $get['id'];
            unset($get['id']);
            Article::where('id',$id)->update($get);
            return response()->json(['code'=>200,'msg'=>'修改成功']);
        }
        $id = $request->input('id');
        $info = Article::find($id);
        $categorys = ArticleCategory::get();
        $info->content = htmlspecialchars_decode($info->content);

        return view('article/edit_article',['info'=>$info,'cats'=>$categorys]);
    }

    public function del_article(Request $request){
        if($request->isMethod('post')){
            $id = $request->input('id');
            Article::destroy($id);
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }
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

        return view('article/add_category');
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
        return view('article/edit_category',['info'=>$info]);
    }

    public function articleList(){
        $arts = Article::select('id','title','keywords','description')->orderBy('created_at','DESC')->paginate(10);
        if($arts){
            return response()->json(['code'=>200,'msg'=>'请求成功','data'=>$arts]);
        }
    }

    public function indexArticleList(){
        $arts = Article::select('id','title','keywords','description')->orderBy('created_at','DESC')->limit(3)->get();
        if($arts){
            return response()->json(['code'=>200,'msg'=>'请求成功','data'=>$arts]);
        }
    }

    public function articleInfo(Request $request){
        if($request->input('id')){
            $res = Article::find($request->input('id'));
            if($res){
                $res = $res->toArray();
                $res['content'] = htmlspecialchars_decode($res['content']);
                return response()->json(['code' => 200 ,'msg' => '请求成功' , 'data' => $res]);
            }
        }
    }
}
