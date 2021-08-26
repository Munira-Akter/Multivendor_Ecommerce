<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id')->default(1);
            $table->integer('subcategory_id')->nullable();
            $table->integer('sub_sub_category_id')->nullable();
            $table->integer('tag_id');
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('slug_en');
            $table->string('slug_bn');
            $table->string('code');
            $table->string('price');
            $table->string('thumbnail');
            $table->string('sale_price');
            $table->string('stock');
            $table->string('color_en')->nullable();
            $table->string('color_bn')->nullable();
            $table->string('size_bn')->nullable();
            $table->string('size_en')->nullable();
            $table->string('wight_en')->nullable();
            $table->string('wight_bn')->nullable();
            $table->string('short_des_en')->nullable();
            $table->string('short_des_bn')->nullable();
            $table->string('long_des_bn')->nullable();
            $table->string('long_des_en')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('hot_deal')->default(0);
            $table->boolean('new_arrival')->default(0);
            $table->boolean('flas_sale')->default(0);
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}