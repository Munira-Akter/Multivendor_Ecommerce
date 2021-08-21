@extends('admin.layouts.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brand List</h3>

                        <div class="count_brand float-right">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="brandTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>id</th>
                                        <th>Name En</th>
                                        <th>Name Bn</th>
                                        <th>logo</th>
                                        <th>Time</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody></tbody>



                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->


            <!-------------- Add Blog Category Page -------- -->


            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Product Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <span id="msg"></span>
                            <form method="POST" id="brandAddform" enctype="multipart/form-data">
                                @csrf
                                <span id="brand_from_err"></span>
                                <div class="form-group">
                                    <h5>Brand English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_en" class="form-control">
                                        <strong class="text-danger err"></strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Brand Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="brand_bn" class="form-control">
                                        <strong class="text-danger err"></strong>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Brand logo <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="logo" class="form-control">
                                        <strong class="text-danger err"></strong>
                                        <br>
                                        <img id="brand_upload_img" src="" alt="">
                                        <span><button  class="brand_im_hide" style="position: relative;top: -23px; right: 26px; height: 20px; width: 20px; line-height: 10px; border-radius: 50%; text-align: center; background-color: #2e1228 !important; border-color: #2e1228 !important;
                                            color: rgb(248, 245, 245);"> &times; </button></span>

                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Brand</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>


        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <div class="modal center-modal fade show" id="brand_edit_model" style="padding-right: 17px; background: dark;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Brand Edit</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="brand_edit_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <h5>Brand English <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text"  name="brand_en" class="form-control">
                            <input type="hidden"  name="id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Brand Bangla <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input   type="text" name="brand_bn" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Brand logo <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" name="new_logo" class="form-control">
                            <input type="hidden"  name="old_logo" class="form-control">
                            <img id="brand_upload_img" src="" alt="">
                        </div>
                    </div>

                    <div class="text-xs-right">
                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Edit Brand</button>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </div>

</div>

@endsection
