<?php

namespace Modules\Product\Entities;

use Modules\Brand\Entities\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductCateory\Entities\ProductCategory;
use Modules\Producttag\Entities\ProductTag;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relationship with Brand table
    public function brand(){
        return $this->belongsTo(Brand::class , 'brand_id' ,'id');
    }

    // Relationship with Category table
    public function categories(){
        return $this->belongsToMany(ProductCategory::class , 'category_id' ,'id');
    }

     // Relationship with Tag table
     public function tags(){
        return $this->belongsToMany(ProductTag::class , 'tag_id' ,'id');
    }

     // Relationship with Gallery table
     public function galleries(){
        return $this->hasMany(Gallery::class);
    }


}
