<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{

    protected  $table = 'article_category';

    public $fillable = ['name','parent_id','issys','sort','title','keywords','description'];
}
