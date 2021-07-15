@extends('forntend.layouts.app.main_master')
@section('main')

<div class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4 text-left">
                    <h1 class="h3 fw-600">Reset Password?</h1>

                    <p class="mb-4 opacity-60">Enter your email address to recover your password. </p>


                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <input id="email" type="text" class="form-control"  name="email" value="{{ old('email') }}" required=""
                                placeholder="Email Address">

                                @error('email')

                                <span role="alert" class="Invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>

                                @enderror

                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="password"
                                name="password" id="password">

                            @error('password')

                            <span role="alert" class="Invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>

                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password"
                                id="password_confirmation" name="password_confirmation">
                        </div>


                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-block" type="submit">
                              Reset Password
                            </button>
                        </div>
                    </form>
                    <div class="mt-3">
                        <a href="../users/login.html" class="text-reset opacity-60">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
</div>

@endsection()
