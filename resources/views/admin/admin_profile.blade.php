@extends('admin.layouts.admin_master')

@section('admin')

<div class="box box-inverse bg-img" style="background: #272E48;" data-overlay="2">
    <div class="flexbox px-20 pt-20">
      <label class="toggler toggler-danger text-white">
        <input type="checkbox">
        <i class="fa fa-heart"></i>
      </label>
      <div class="dropdown">
        <a data-toggle="dropdown" href="#" aria-expanded="false"><i class="ti-more-alt rotate-90 text-white"></i></a>
        <div class="dropdown-menu dropdown-menu-right" style="will-change: transform;">
          <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fa fa-user"></i> Edit Profile </a>
          <a class="dropdown-item" href="{{ route('admin.profile.change_password') }}"><i class="fa fa-key"></i> Change Password </a>

        </div>
      </div>
    </div>

    <div class="box-body text-center pb-50">
      <a href="#">
        <img class="avatar avatar-xxl avatar-bordered" src="{{ (!empty($admindata -> profile_photo_path )) ? url('uploads/admin/' . $admindata -> profile_photo_path):url('uploads/avatar.jpg')}}" alt="">
      </a>
      <h4 class="mt-2 mb-0"><a class="hover-primary text-white" href="#">{{ $admindata -> name }}</a></h4>
      <span><i class="fa fa-mail w-20"></i> {{ $admindata -> email }}</span>
    </div>

    <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
      <li>
        <span class="opacity-60">Followers</span><br>
        <span class="font-size-20">8.6K</span>
      </li>
      <li>
        <span class="opacity-60">Following</span><br>
        <span class="font-size-20">8457</span>
      </li>
      <li>
        <span class="opacity-60">Tweets</span><br>
        <span class="font-size-20">2154</span>
      </li>
    </ul>
  </div>




@endsection
