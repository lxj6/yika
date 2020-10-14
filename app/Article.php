<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model{

    protected  $table = 'article';

    public $fillable = ['title','content','category_id','keywords','description','top','sort'];

    public function articleCat(){
        return $this->hasOne('App\ArticleCategory','id','category_id')->select(['id','name']);
    }
}
