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
                        <h3 class="box-title">Blog Category List  </h3>

                        <div class="count_cat float-right">
                            <span class="badge badge-success"><a href="{{ route('admin.blog.category.show') }}" class="text-light text-bold"> Published {{ $count }}</a></span>
                            <span class="badge badge-warning"><a href="{{ route('admin.blog.category.trash.index') }}" class="text-dark text-bold"> Trash {{ $trash_count }}</a></span>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Blog Category English</th>
                                        <th>Blog Category Bangla </th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="tbody">

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
                        <h3 class="box-title">Add Blog Category </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <span id="msg"></span>
                            <form method="POST" action="{{ route('admin.blog.category.store') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>Blog Category English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="blog_category_name_en" class="form-control">
                                        @error('blog_category_name_en')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Blog Category Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="blog_category_name_lng" class="form-control">
                                        @error('blog_category_name_lng')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary mb-5">Add New</button>
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

    <div class="modal center-modal fade show" id="cat-edit-modal-center" tabindex="-1" style="padding-right: 17px; background: dark;" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">category Edit</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="cat_edit_form">
                    @csrf
                    <div class="form-group">
                        <h5>Blog Category English <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="blog_category_name_en" class="form-control">
                            <input type="hidden" name="id" class="form-control">
                            @error('blog_category_name_en')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Blog Category Bangla <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="blog_category_name_lng" class="form-control">
                            @error('blog_category_name_lng')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Add New</button>
                    </div>
                </form>

            </div>
          </div>
        </div>
      </div>

</div>

@endsection
