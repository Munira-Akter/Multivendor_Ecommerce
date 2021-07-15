@extends('admin.layouts.admin_master')

@section('admin')

<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Admin Password Change</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('admin.password.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <h5>Current Password <span class="text-danger">*</span></h5>
                                                <input id="current_password" type="text" name="old_password"
                                                    class="form-control">

                                                @error('old_password')
                                                <span style="color: red; font-size:12px;">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <h5>New Password <span class="text-danger">*</span></h5>
                                                <input type="text" id="password" name="password" class="form-control">
                                                @error('password')
                                                <span style="color: red; font-size:12px;">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <h5>Confirm Password <span class="text-danger">*</span></h5>
                                                <input id="password_confirmation" type="text"
                                                    name="password_confirmation" class="form-control">

                                                @error('name')
                                                <span style="color: red; font-size:12px;">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                                </div>
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>


@endsection
