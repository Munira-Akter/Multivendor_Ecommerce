@extends('admin.layouts.admin_master')
@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product List</h3>

                        <div class="product_count float-right">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="productTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Serial No.</th>
                                        <th>Name En</th>
                                        <th>Name Bn</th>
                                        <th>Brand</th>
                                        <th>Code</th>
                                        <th>Price - Sale Price</th>
                                        <th>Stock</th>
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
        </div>
        <!-- /.row -->
    </section>
</div>

@endsection
