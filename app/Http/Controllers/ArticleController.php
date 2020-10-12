<?php


namespace App\Http\Controllers;

class ArticleController extends BaseController
{


    public function index(){
        return view('article\index');
    }


    public function catgory(){
        return view('article\catgory');
    }

    public function add_article(){
        return view('article\add_article');
    }

    public function add_catgory(){
        return view('article\add_catgory');
    }

}
