@extends('layouts.auth')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row vh-100">
        <div class="col-lg-3  pr-0">
            <div class="card mb-0 shadow-none">
                <div class="card-body">
                    <div class="px-3">
                        <div class="media">
                            <a href="" class="logo logo-admin">
                                <img src="{{ asset('images/logo-sm.png') }}" height="55" alt="logo" class="my-3">
                            </a>
                            <div class="media-body ml-3 align-self-center">
                                <h4 class="mt-0 mb-1">
                                    {{ trans('auth.login') }}
                                </h4>
                                <p class="text-muted mb-0">
                                    {{ trans('auth.login_to_continue') }}
                                </p>
                            </div>
                        </div>
                        <form class="form-horizontal my-2" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="mdi mdi-account-outline font-16"></i>
                                        </span>
                                    </div>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="userpassword">{{ __('Password') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="mdi mdi-key font-16"></i></span>
                                    </div>
                                    <input id="password" type="password" value="{{ old('password') }}"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                         </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Remember
                                            me</label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="col-sm-6 text-right">
                                        {{-- <a href="{{ route('password.request') }}" class="text-muted font-13"> --}}
                                            {{-- <i class="mdi mdi-lock"></i> {{ __('Forgot Your Password?') }} --}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-block waves-effect waves-light"
                                            type="submit">
                                        {{ __('Login') }}<i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
{{--                     
                    <div class="m-2 text-center bg-light p-2 text-primary">
                        <h5 class="">Don't have an account ? </h5>
                        <p class="font-13">Join <span>Account</span> Now</p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-round waves-effect waves-light">Free Resister</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-9 p-0 d-flex justify-content-center">
            <div class="accountbg d-flex align-items-center">
                <div class="account-title text-white text-center">
                    <img src="{{ asset('images/logo-sm.png') }}" alt="" class="thumb" height="70px">
                    <h3 class="mt-3">Inventory Management System</h3>
                    <div class="border w-25 mx-auto border-primary"></div>
                    {{-- <h1 class="">Let's Get Started</h1> --}}
                    {{-- <p class="font-14 mt-3">Don't have an account ? <a href="{{ route('register') }}" class="text-primary">Sign up</a></p> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
