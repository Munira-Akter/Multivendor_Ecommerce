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
                        <h3 class="box-title">Brand Trash List</h3>

                        <div class="count_brand float-right">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="brandTrashTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Serial No.</th>
                                        <th>Brand English</th>
                                        <th>Brand Bangla </th>
                                        <th>Logo </th>
                                        <th>Status</th>
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
