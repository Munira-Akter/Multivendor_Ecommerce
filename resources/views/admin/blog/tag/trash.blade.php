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
                        <h3 class="box-title">Blog Tag List  </h3>

                        <div class="count_cat float-right">
                            <span class="badge badge-success"><a href="{{ route('tag.index') }}" class="text-light text-bold"> Published {{ $count }}</a></span>
                            <span class="badge badge-warning"><a href="{{ route('tag.trash') }}" class="text-dark text-bold"> Trash {{ $trash_count }}</a></span>
                        </div>
                    </div>
                    <!-- /.box-header -->

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Tag Trashed List </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Blog Tag En</th>
                                        <th>Blog Tag Hin </th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="tag_trash_tbody">

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tag Trash Info</h3> &nbsp;

                        <span class="badge badge-lg badge-dot badge-danger"></span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <dl>
                                <dt>Trash</dt>
                                <dd>Onece you trash a Tag Then it is took place in trash panel.You can recover Tag or If you wish you can delete permanently </dd>
                              </dl>
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
