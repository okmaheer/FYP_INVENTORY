@extends('layouts.auth')
@section('page_title',$page_title)
@section('innerStyleSheet')
@endsection
@section('content')
    <div class="row vh-100">
        <div class="col-lg-3  pr-0">
            <div class="card mb-0 shadow-none">
                <div class="card-body">
                    <div class="px-3">
                        <div class="row col-12 justify-content-center">
                            <a href="https://deskbook.cloud" class="logo logo-admin" target="_blank">
                                <img src="{{ asset('images/logo-sm.png') }}" height="70" width="160" alt="logo" class="my-3 ml-5">
                            </a>

                        </div>
                        <form class="form-horizontal my-4" method="POST" action="{{ route('login') }}">
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
                                <label for="password">{{ __('Password') }}</label>
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
                                {{--@if (Route::has('password.request'))
                                    <div class="col-sm-6 text-right">
                                        <a href="{{ route('password.request') }}" class="text-muted font-13">

                                        </a>
                                    </div>
                                @endif--}}
                            </div>
                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-block waves-effect waves-light btn-purple"
                                            type="submit">
                                        {{ __('Login') }}<i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-9 p-0 d-flex justify-content-center">
            <div class="accountbg d-flex align-items-center">
{{--                <div class="account-title text-white text-center">--}}
{{--                   --}}
{{--                    <h4 class="mt-3">Welcome To Account</h4>--}}
{{--                    <div class="border w-25 mx-auto border-primary"></div>--}}
{{--                    <h1 class="">Let's Get Started</h1>--}}
{{--                  --}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
