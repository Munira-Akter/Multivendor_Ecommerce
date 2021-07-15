<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function categories(){
        return $this -> belongsToMany('App\Models\Blog\Category');
    }

    public function tags(){
        return $this -> belongsToMany('App\Models\Blog\Tag');
    }

    public function user(){
        return $this -> belongsTo('App\Models\Admin');
    }

}
