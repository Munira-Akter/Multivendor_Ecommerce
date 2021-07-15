<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];

    public function replys(){
        return $this -> belongsToMany('App\Models\Reply');
    }

    public function user(){
        return $this -> belongsToMany('App\Models\User');
    }
}