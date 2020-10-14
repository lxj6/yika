<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model{

    protected $table = 'banner';

    public $fillable = ['title','url','position','path'];
}
