<?php

namespace Modules\Producttag\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTag extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}