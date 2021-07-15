@extends('admin.layouts.admin_master')

@section('admin')

<div class="container-full">

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Post List  </h3>

                        <div class="count_cat float-right">
                            <span class="badge badge-success"><a href="{{ route('admin.blog.index') }}" class="text-light text-bold"> Published {{ $count }}</a></span>
                            <span class="badge badge-warning"><a href="{{ route('post.trash') }}" class="text-dark text-bold"> Trash {{ $trash_count }}</a></span>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Categories</th>
                                        <th>Tags</th>
                                        <th>Author</th>
                                        <th>Content</th>
                                        <th>Feature</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody id="tag_post_tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
