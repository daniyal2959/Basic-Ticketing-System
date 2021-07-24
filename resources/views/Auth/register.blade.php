@extends('layouts.Auth.main')
@section('title', 'ثبت نام | سیستم ارتباط با مشتریان آرگون')

@section('PageTitle', 'Create an account')
@section('PageDescription', 'Use these awesome forms to login or create new account in your project for free.')
@section('PageSignText', 'Sign up with')

@section('error')
    @include('errors.error')
@endsection

@section('content')
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
            <small>Or sign up with credentials</small>
        </div>
        <form action="{{ route('signup') }}" role="form" method="POST">
            @csrf
            <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Name" type="text" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="text" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password">
                </div>
            </div>
            <div class="text-muted font-italic"><small>password strength: <span id="strength" class="text-success font-weight-700"></span></small></div>
            <div class="row my-4">
                <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input name="privacy" class="custom-control-input" id="customCheckRegister" type="checkbox">
                        <label class="custom-control-label" for="customCheckRegister">
                            <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Create account</button>
            </div>
        </form>
    </div>
@endsection
