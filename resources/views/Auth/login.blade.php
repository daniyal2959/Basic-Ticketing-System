@extends('layouts.Auth.main')
@section('title', 'ورود  به سیستم ارتباط با کاربران آرگون')

@section('PageTitle', 'Welcome!')
@section('PageDescription', 'Use these awesome forms to login or create new account in your project for free.')
@section('PageSignText', 'Sign in with')

@section('content')
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
            <small>Or sign in with credentials</small>
        </div>
        <form action="{{ route('check') }}" method="POST" role="form">
            @csrf
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative @error('email') border border-danger @enderror">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative @error('password') border border-danger @enderror">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password"">
                </div>
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="custom-control custom-control-alternative custom-checkbox">
                <input name="remember" class="custom-control-input" id=" customCheckLogin" type="checkbox">
                <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                </label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Sign in</button>
            </div>
        </form>
    </div>
@endsection

@section('Extras')
    <div class="row mt-3">
        <div class="col-6">
            <a href="#" class="text-light"><small>Forgot password?</small></a>
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('register') }}" class="text-light"><small>Create new account</small></a>
        </div>
    </div>
@endsection
