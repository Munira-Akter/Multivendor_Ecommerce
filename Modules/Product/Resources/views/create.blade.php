@extends('admin.layouts.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Product</h4>
                    </div>
                    <!-- /.box-header -->
                    <form id="productForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row mb-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Product name English:</label> &nbsp; &nbsp;
                                        <input type="text" name="name_en" class="form-control"
                                            placeholder="English Product Name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Product name Bangla:</label> &nbsp; &nbsp;
                                        <input type="taxt" name="name_bn" class="form-control"
                                            placeholder="Bangla Product Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Product Code</label> &nbsp; &nbsp;
                                        <input type="text" name="code" class="form-control"
                                            placeholder="Product Unique Code">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Product Stock:</label> &nbsp; &nbsp;
                                        <input type="text" name="stock" class="form-control"
                                            placeholder="Product Stock">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Regular Price:</label> &nbsp; &nbsp;
                                        <input type="text" name="price" class="form-control"
                                            placeholder="Regular Price">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Discount Price:</label> &nbsp; &nbsp;
                                        <input type="text" name="sale_price" class="form-control"
                                            placeholder="Discount Price">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-3">
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label>English size:</label> &nbsp; &nbsp;
                                            <div class="tags-default">
                                                <input name="size_en" type="text" value="s,m,lg" data-role="tagsinput"
                                                    placeholder="add size" />
                                            </div>
                                            <label>Bangla size:</label> &nbsp; &nbsp;
                                            <div class="tags-default">
                                                <input class="form-control" type="text" name="size_bn" value="ছত,মাঝারি"
                                                    data-role="tagsinput" placeholder="add size" />
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>English Color:</label> &nbsp; &nbsp;
                                        <div class="tags-default">
                                            <input name="color_en" type="text" value="Red,Green" data-role="tagsinput"
                                                placeholder="add color" />
                                        </div>
                                        <label>Bangla Color:</label> &nbsp; &nbsp;
                                        <div class="tags-default">
                                            <input class="form-control" type="text" name="color_bn" value="লাল,নীল"
                                                data-role="tagsinput" placeholder="add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">

                                        <label>English weight:</label> &nbsp; &nbsp;
                                        <div class="tags-default">
                                            <input name="weight_en" type="text" value="100gm,500gm"
                                                data-role="tagsinput" placeholder="add weight" />
                                        </div>
                                        <label>Bangla weight:</label> &nbsp; &nbsp;
                                        <div class="tags-default">
                                            <input class="form-control" type="text" name="weight_bn" value="১০০,২০০"
                                                data-role="tagsinput" placeholder="add weight" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Product Tags:</label> &nbsp; &nbsp;
                                        <select class="form-control .dark-skin select2 select2-hidden-accessible"
                                            multiple="multiple" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option selected="selected" value="">--Select Tag--</option>
                                            @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{$tag->name_en}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>


                            <div class="row mb-5">
                                <div class="col-3">
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
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Product Category:</label> &nbsp; &nbsp;
                                        <select class="form-control" name="category_id">
                                            <option value="">--Select Category--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Subcategory:</label> &nbsp; &nbsp;
                                        <select class="form-control" name="subcategory_id">
                                            <option value="">--Select Subcategory--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Sub Subcategory:</label> &nbsp; &nbsp;
                                        <select class="form-control" name="sub_subcategory_id">
                                            <option value="">--Select Sub Subcategory--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Product Featured Image: </label> &nbsp; &nbsp;
                                        <input class="form-control" type="file" name="thumbnail">
                                        <br>
                                        <img src="" id="product_thumbnail_img">
                                        <br>

                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Product Gallery Image: </label> &nbsp; &nbsp;

                                    <input type="file" name="file[]" id="file" class="form-control" multiple
                                    onchange="imagePreview(this)"> <br>
                                    <div id="image-preview"></div>


                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Short Description: </label> <br>
                                        <textarea name="short_des_en" id="textarea" class="form-control"
                                            aria-invalid="false" placeholder="English Short Description"></textarea>

                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Short Description: </label><br>
                                        <textarea name="short_des_bn" id="textarea" class="form-control"
                                            aria-invalid="false" placeholder="Bangla Short Description"></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Long Description: </label> <br>
                                        <div class="controls">
                                            <textarea id="editor1" name="long_des_en" class="form-control"
                                                placeholder="English Long Description"></textarea> <br>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Long Description: </label><br>
                                        <textarea name="long_des_bn" id="editor2" class="form-control"
                                            placeholder="Bangla Long Description" rows="10" cols="80"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label>Extra Feature :</label>
                                <div class="c-inputs-stacked">
                                    <input type="checkbox" id="checkbox_123">
                                    <label for="checkbox_123" class="block">Hot Deals</label> &nbsp; &nbsp;

                                    <input type="checkbox" id="checkbox_234">
                                    <label for="checkbox_234" class="block">Featured Products</label> &nbsp; &nbsp;

                                    <input type="checkbox" id="checkbox_345">
                                    <label for="checkbox_345" class="block"> New Arrivals</label> &nbsp; &nbsp;

                                    <input type="checkbox" id="checkbox_345">
                                    <label for="checkbox_345" class="block"> Flas Sale </label> &nbsp; &nbsp;
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-rounded btn-success pull-right">Add Products</button>
                            <br><br>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>

</div>



@endsection
