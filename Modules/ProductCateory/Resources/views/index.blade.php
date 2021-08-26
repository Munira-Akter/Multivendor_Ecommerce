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
                        <h3 class="box-title">Category List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="CategoryTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Category Name</th>
                                        <th>Icon</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Serial No.</th>
                                        <th>Man
                                            <ul>
                                                <li>- Man
                                                    <ul>
                                                        <li>-- Shirt</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </th>
                                        <th>Icon</th>
                                        <th>Image</th>
                                    </tr>
                                </tbody>



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
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <span id="msg"></span>
                            <form method="POST" id="categoryForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Name English<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_en" class="form-control">
                                        <strong class="text-danger err"></strong>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Name Bangla<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_bn" class="form-control">
                                        <strong class="text-danger err"></strong>
                                    </div>
                                </div>

                            <div class="form-group">
                                <h5>Category Icon</h5>
                                <input type="text" name="icon" class="icon-picker" >
                            </div>



                                <div class="form-group">
                                    <h5>Parent Category<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="parent_id" class="form-control">
                                            <option value="">--Select--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Category image</h5>
                                    <div class="controls">
                                        <input type="file" name="image" class="form-control">
                                        <br>
                                        <img id="category_img" src="" alt="">
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Category</button>
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

    <div class="modal center-modal fade show" id="slider_edit_model" style="padding-right: 17px; background: dark;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Slider Edit</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="slider_edit_form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <h5>Link<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="link" class="form-control"><br>
                            <input type="hidden" name="id" class="form-control">
                            <strong class="text-danger err"></strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Slider Image<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" name="new_image" class="form-control">
                            <input type="hidden"  name="old_image" class="form-control"><br><br>
                            <img id="slider_up_img" src="" alt="">
                        </div>
                    </div>

                    <div class="text-xs-right">
                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Edit Slider</button>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </div>

</div>

@endsection
