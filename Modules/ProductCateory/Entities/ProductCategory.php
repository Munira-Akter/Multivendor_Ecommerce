<?php

namespace Modules\ProductCateory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function childcats(){
        return $this->hasMany(ProductCategory::class , 'parent_id' , 'id');
    }

}