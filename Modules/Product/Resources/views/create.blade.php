@extends('admin.layouts.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Product</h4>
                    </div>
                    <!-- /.box-header -->
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row mb-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Product name English:</label> &nbsp; &nbsp;
                                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                                            class="form-control" placeholder="English Product Name">
                                        @error('name_en')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Product name Bangla:</label> &nbsp; &nbsp;
                                        <input type="taxt" name="name_bn" value="{{ old('name_bn') }}"
                                            class="form-control" placeholder="Bangla Product Name">
                                        @error('name_bn')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Product Code</label> &nbsp; &nbsp;
                                        <input type="text" name="code" value="{{ old('code') }}" class="form-control"
                                            placeholder="Product Unique Code">
                                        @error('code')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Product Stock:</label> &nbsp; &nbsp;
                                        <input type="text" name="stock" value="{{ old('stock') }}" class="form-control"
                                            placeholder="Product Stock">
                                        @error('stock')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Regular Price:</label> &nbsp; &nbsp;
                                        <input type="text" name="price" value="{{ old('price') }}" class="form-control"
                                            placeholder="Regular Price">
                                        @error('price')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Discount Price:</label> &nbsp; &nbsp;
                                        <input type="text" name="sale_price" value="{{ old('sale_price') }}"
                                            class="form-control" placeholder="Discount Price">
                                        @error('sale_price')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Product Featured Image: </label> &nbsp; &nbsp;
                                        <input value="{{ old('thumbnail') }}" class="form-control" type="file"
                                            name="thumbnail" id="thumbnail_img_input">
                                        @error('thumbnail0')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <br>
                                        <img src="" id="product_thumbnail">
                                        <br>

                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Product Gallery Image: </label> &nbsp; &nbsp;

                                        <input type="file" value="{{ old('file') }}" name="file[]" id="file"
                                            class="form-control" multiple onchange="imagePreview(this)"> <br>
                                        <div id="image-preview"></div>


                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Short Description: </label> <br>
                                        <textarea name="short_des_en" value="{{ old('short_des_en') }}" id="textarea"
                                            class="form-control" aria-invalid="false"
                                            placeholder="English Short Description"></textarea>

                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Short Description: </label><br>
                                        <textarea name="short_des_bn" value="{{ old('short_des_bn') }}" id="textarea"
                                            class="form-control" aria-invalid="false"
                                            placeholder="Bangla Short Description"></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Long Description: </label> <br>
                                        <div class="controls">
                                            <textarea id="editor1" name="long_des_en" value="{{ old('long_des_en') }}"
                                                class="form-control" placeholder="English Long Description"></textarea>
                                            <br>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Long Description: </label><br>
                                        <textarea name="long_des_bn" value="{{ old('long_des_bn') }}" id="editor2"
                                            class="form-control" placeholder="Bangla Long Description" rows="10"
                                            cols="80"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label>Extra Feature :</label>
                                <div class="c-inputs-stacked">
                                    <input type="checkbox" id="checkbox_123" value="1" name="hot">
                                    <label for="checkbox_123" class="block">Hot Deals</label> &nbsp; &nbsp;

                                    <input type="checkbox" id="checkbox_234" value="1" name="featured">
                                    <label for="checkbox_234" class="block">Featured Products</label> &nbsp; &nbsp;

                                    <input type="checkbox" id="checkbox_345" value="1" name="new">
                                    <label for="checkbox_345" class="block"> New Arrivals</label> &nbsp; &nbsp;

                                    <input type="checkbox" id="checkbox_346" value="1" name="flas_sale">
                                    <label for="checkbox_346" class="block"> Flas Sale </label> &nbsp; &nbsp;
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- /.box-body -->

                </div>


            </div>

            <style>
                .box ul li {
                    list-style-type: none;
                    font-size: 12px;
                }

            </style>

            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3>Product Category</h3>
                    </div>
                    <div class="box-body">
                        <div class="box-body" style="overflow: auto; height:200px;">

                            <ul>
                                @foreach ($category as $cat)
                                <li>
                                    <input name="cat[]" type="checkbox" name="" id="{{ $cat->id }}" value="{{ $cat->id }}">
                                    <label for="{{ $cat -> id }}">{{ $cat -> name_en }}</label>
                                    @foreach ($cat -> childcats as $cat2)
                                    <ul>
                                        <li> <input name="cat[]" type="checkbox" name="" id="{{ $cat2->id }}"
                                                value="{{ $cat2->id }}">
                                            <label for="{{ $cat2 -> id }}">{{ $cat2 -> name_en }}</label>
                                            @foreach ($cat2 -> childcats as $cat3)
                                            <ul>
                                                <li> <input name="cat[]" type="checkbox" name="" id="{{ $cat3->id }}"
                                                        value="{{ $cat3->id }}">
                                                    <label for="{{ $cat3 -> id }}">{{ $cat3 -> name_en }}</label>
                                                    @foreach ($cat3 -> childcats as $cat4)
                                                    <ul>
                                                        <li> <input name="cat[]" type="checkbox" name="" id="{{ $cat4->id }}"
                                                                value="{{ $cat4->id }}">
                                                            <label
                                                                for="{{ $cat4 -> id }}">{{ $cat4 -> name_en }}</label>
                                                        </li>
                                                    </ul>
                                                    @endforeach

                                                </li>
                                            </ul>
                                            @endforeach</li>
                                    </ul>
                                    @endforeach

                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>

                <div class="box">
                    <div class="box-header">Product Tag</div>
                    <div class="box-body">
                        <div class="form-group">
                            <select class="form-control .dark-skin select2 select2-hidden-accessible"
                                multiple="multiple" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tag[]">
                                <option selected="selected" value="">--Select Tag--</option>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{$tag->name_en}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>

                <div class="box">
                    <div class="box-header">Product Brand</div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Product Brand</label> &nbsp; &nbsp;
                            <select class="form-control" name="brand_id">
                                <option value="">--Select Brand--</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{$brand->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>

                <input type="radio" name="product" id="Genaral" checked><label for="Genaral">Genaral Product</label>
                <input type="radio" name="product" id="Variable" value="var"><label for="Variable">Variable Product</label>

                <div class="attr-box">
                    <div class="box-header">Product Arrtibute</div>
                    <div class="box-body">
                        <button class="btn btn-primary mb-3" id="size_collaps">Add Attribute</button>
                        <div class="size_collaps_box">

                        </div>
                    </div>
                    <div class="box-footer"></div>
                </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-rounded btn-success pull-right">Add Products</button>
                <br><br>
            </div>
        </form>
        </div>
    </section>

</div>



@endsection
