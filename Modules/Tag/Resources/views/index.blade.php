@extends('admin.layouts.admin_master') @extends('errors.minimal') @section('title', __('Not Found'))
@section('code', '500')
@section('message', __(' Not Found'))

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tag List</h3>

                        <div class="count_brand float-right">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="producttagTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>id</th>
                                        <th>Name En</th>
                                        <th>Name Bn</th>
                                        <th>Status</th>
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
                        <h3 class="box-title">Add Product Tag</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" id="producttagAddform" enctype="multipart/form-data">
                                @csrf
                                <span id="brand_from_err"></span>
                                <div class="form-group">
                                    <h5>Tag English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="producttag_en" class="form-control">
                                        <strong class="text-danger err"></strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Tag Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="producttag_bn" class="form-control">
                                        <strong class="text-danger err"></strong>
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Tag</button>
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

    <div class="modal center-modal fade show" id="producttag_edit_model" style="padding-right: 17px; background: dark;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tag Edit</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="producttag_edit_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <h5>Tag English <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text"  name="producttag_en" class="form-control">
                            <input type="hidden"  name="id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Tag Bangla <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input   type="text" name="producttag_bn" class="form-control">
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Edit Tag</button>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </div>

</div>

@endsection
