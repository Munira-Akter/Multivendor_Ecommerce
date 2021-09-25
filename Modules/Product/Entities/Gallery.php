<?php

namespace Modules\Product\Entities;

use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = [];

     // Relationship with Product table
     public function product(){
        return $this->belongsTo(Product::class , 'product_id' ,'id');
    }
}