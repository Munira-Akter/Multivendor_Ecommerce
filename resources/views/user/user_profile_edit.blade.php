@extends('forntend.layouts.app.main_master')
@section('main')

<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-start">
            @include('user.user_master')
            <div class="aiz-user-panel">
                <div class="aiz-titlebar mt-2 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="h3">Manage Your Profile - <strong>{{ $userdata -> name }}</strong></h1>
                        </div>
                    </div>
                </div>

                <!-- Basic Info-->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Basic Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Your name</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Your name" name="name"
                                        value="{{ $userdata -> name }}">

                                    <input type="hidden" name="id" value="{{ $userdata -> id }}">

                                    @error('name')
                                    <strong style="color: red;">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Your Phone</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Your Phone" name="phone"
                                        value="{{  $userdata -> phone  }}">
                                    @error('phone')
                                    <strong style="color: red;">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Photo</label>
                                <div class="col-md-10">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <label for="user_profile_update"
                                                class="input-group-text bg-soft-secondary font-weight-medium">Browse
                                            </label>
                                        </div>
                                        <div class="form-control file-amount">1 File selected</div>

                                        <input type="file" class="d-none" id="user_profile_update"
                                            name="profile_photo_path" value="" class="selected-files">

                                        <input type="file" class="d-none" name="old_photo"
                                            value="{{  $userdata -> profile_photo_path  }}" class="selected-files">

                                        @error('profile_photo_path')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="file-preview box sm">
                                        <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item"
                                            data-id="994" title="hamid-tajik-UX1cUuWSzBw-unsplash.jpg">
                                            <div
                                                class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                                                <img id="user_profile_update_show"
                                                    src="{{ (!empty($userdata -> profile_photo_path)) ? url('uploads/user/' . $userdata -> profile_photo_path) : url('uploads/avatar.jpg')}}"
                                                    class="img-fit"></div>
                                            <div class="col body">
                                                <h6 class="d-flex"><span
                                                        class="text-truncate title">{{ $userdata -> profile_photo_path }}</span>
                                                </h6>
                                                <p>{{ $userdata -> profile_photo_path  }}</p>
                                            </div>
                                            <div class="remove"><button class="btn btn-sm btn-link remove-attachment"
                                                    type="button"><i class="la la-close"></i></button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Change Password</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('user.password.update') }}" method="POST">
                            @csrf

                            <div class="form-group row">

                                <input type="hidden" name="id" value="{{ $userdata -> id }}">

                                <label class="col-md-2 col-form-label">Old Password</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control" placeholder="Old Password"
                                        name="old_password">
                                    @error('old_password')
                                    <strong style="color: red;">{{ $message }}</strong>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Your Password</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control" placeholder="New Password"
                                        name="password">
                                    @error('password')
                                    <strong style="color: red;">{{ $message }}</strong>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Confirm Password</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>


                        </form>

                    </div>
                </div>





                <!-- Address -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Address</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gutters-10">
                            @forelse ($address as $address )
                            <div class="col-lg-6">
                                <div class="border p-3  rounded mb-3 position-relative">
                                    <div>
                                        <span class="w-50 fw-600">Address:</span>
                                        <span class="ml-2">{{ $address -> address }}</span>
                                    </div>
                                    <div>
                                        <span class="w-50 fw-600">Postal Code:</span>
                                        <span class="ml-2">{{ $address -> zip }}</span>
                                    </div>
                                    <div>
                                        <span class="w-50 fw-600">City:</span>
                                        <span class="ml-2">{{ $address -> city }}</span>
                                    </div>
                                    <div>
                                        <span class="w-50 fw-600">Country:</span>
                                        <span class="ml-2">{{ $address -> country }}</span>
                                    </div>
                                    <div>
                                        <span class="w-50 fw-600">Phone:</span>
                                        <span class="ml-2">{{ $address -> add_phone }}</span>
                                        @if($address -> default_val == 1)
                                        <span class="badge badge-inline badge-danger float-right">Default Address</span>
                                    @endif

                                    </div>
                                    <div class="dropdown position-absolute right-0 top-0">
                                        <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                            <i class="la la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" id="address_add_btn_two">
                                                Edit
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('address.default' , $address -> id) }}" >Make
                                                This Default</a>
                                            <a class="dropdown-item" href="#"
                                            id="delete_address_btn" delete_id="{{ $address -> id }}" >Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty

                            You have no Address to delivery

                            @endforelse


                            <div class="col-lg-6 mx-auto" id="address_add_btn">
                                <div class="border p-3 rounded mb-3 c-pointer text-center bg-light">
                                    <i class="la la-plus la-2x"></i>
                                    <div class="alpha-7">Add New Address</div>
                                </div>
                            </div>



                        </div>
                        <div class="card justify-content-center" id="address_add" >
                            <div class="card-header">
                                <h5 class="mb-0 h6">Add Delivery Address</h5>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('user.address.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group row">

                                        <input type="hidden" name="id" value="{{ $userdata -> id }}">

                                        <label class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Enter Address"
                                                name="address">
                                            @error('address')
                                            <strong style="color: red;">{{ $message }}</strong>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Post Code</label>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" placeholder="Enter Zip Code"
                                            name="zip">
                                        @error('zip')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror
                                        </div>
                                        <label class="col-md-2 col-form-label">City</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter City"
                                            name="city">
                                        @error('city')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Phone Number</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter Phone Number"
                                            name="add_phone">
                                        @error('add_phone')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror
                                        </div>
                                        <label class="col-md-2 col-form-label">Country</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter Country"
                                            name="country">
                                        @error('country')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror

                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-primary">Add Address</button>
                                    </div>


                                </form>

                            </div>
                        </div>
{{--
                        <div class="card justify-content-center" id="address_edit" >
                            <div class="card-header">
                                <h5 class="mb-0 h6">Edit Delivery Address</h5>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('user.address.update' , ) }}" method="POST">
                                    @csrf

                                    <div class="form-group row">

                                        <input type="hidden" name="id" value="{{ $userdata -> id }}">

                                        <label class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Enter Address"
                                                name="address" value={{  $userdata -> id  }}>
                                            @error('address')
                                            <strong style="color: red;">{{ $message }}</strong>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Post Code</label>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" placeholder="Enter Zip Code"
                                            name="zip">
                                        @error('zip')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror
                                        </div>
                                        <label class="col-md-2 col-form-label">City</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter City"
                                            name="city">
                                        @error('city')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Phone Number</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter Phone Number"
                                            name="add_phone">
                                        @error('add_phone')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror
                                        </div>
                                        <label class="col-md-2 col-form-label">Country</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter Country"
                                            name="country">
                                        @error('country')
                                        <strong style="color: red;">{{ $message }}</strong>
                                        @enderror

                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-primary">Add Address</button>
                                    </div>


                                </form>

                            </div>
                        </div> --}}

                    </div>
                </div>

                <!-- Email Change -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Change your email</h5>
                    </div>
                    <div class="card-body">
                        <form action="https://demo.activeitzone.com/ecommerce/new-user-email" method="POST">
                            <input type="hidden" name="_token" value="vNfP40erre0IJ1SKtmyDuo572USnoY187DVKYPiP">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Your Email</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="Your Email" name="email"
                                            value="customer@example.com">
                                        <div class="input-group-append">
                                            <button type="button"
                                                class="btn btn-outline-secondary new-email-verification">
                                                <span class="d-none loading">
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    Sending Email...
                                                </span>
                                                <span class="default">Verify</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-primary">Update Email</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Logout</h5>
                        <a class="btn btn-primary" href="{{ route('user.logout') }}">Logout</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection()
