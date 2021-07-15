@extends('forntend.layouts.app.main_master')
@section('main')

<section class="gry-bg py-5">
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                    <div class="card">
                        <div class="text-center pt-4">
                            <h1 class="h4 fw-600">
                                Login to your account.
                            </h1>
                        </div>

                        <div class="px-4 py-3 py-lg-4">
                            <div class="">
                                <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" class="form-control "id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">

                                        @error('email')

                                            <span role="alert" class="Invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>

                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <input type="password" class="form-control " placeholder="password"
                                            name="password" id="password">

                                        @error('password')

                                            <span role="alert" class="Invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>

                                        @enderror
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="remember" id="remember_me" name="remember" >
                                                <span class="opacity-60">Remember Me</span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                        <div class="col-6 text-right">

                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">Forgot
                                            Password?</a>
                                        @endif

                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <button type="submit" class="btn btn-primary btn-block fw-600">Login</button>
                                    </div>
                                </form>

                                <div class="mb-5">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Seller Account</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" onclick="autoFillSeller()">Copy
                                                        credentials</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Customer Account</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm"
                                                        onclick="autoFillCustomer()">Copy credentials</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="text-center">
                                <p class="text-muted mb-0">Dont have an account?</p>
                                <a href="{{ route('register') }}">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection()
