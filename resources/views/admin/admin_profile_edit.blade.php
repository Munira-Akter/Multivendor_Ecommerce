@extends('admin.layouts.admin_master')

@section('admin')

<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Admin Profile Edit</h4>
        </div>
        <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <h5>User Name <span class="text-danger">*</span></h5>
                                            <input value="{{ $admindata -> name }}" type="text" name="name" class="form-control">

                                            @error('name')
                                                <span style="color: red; font-size:12px;">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Email Field <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input value=" {{ $admindata -> email }}" type="email" name="email" class="form-control">
                                            @error('email')
                                            <span style="color: red; font-size:12px;">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>File Input Field <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input name="profile_photo_path" id="admin_Image_Url" type="file" value="{{ $admindata -> profile_photo_path }}" name="file" class="form-control">
                                    @error('profile_photo_path')
                                    <span style="color: red; font-size:12px;">{{ $message }}</span>
                                @enderror

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img id="admin_Image_Show" src="{{ (!empty($admindata -> profile_photo_path)) ? url('uploads/admin/' . $admindata -> profile_photo_path) : url('uploads/avatar.jpg') }}" height="100px" >
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
