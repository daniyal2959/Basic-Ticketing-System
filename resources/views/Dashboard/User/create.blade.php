@php
    $title = 'ثبت کاربر جدید | سیستم ارتباط با مشتریان آرگون';
    $userName = '';
    $userEmail = '';
    $userOrganization = '';
    $userAddress = '';
    $userCity = '';
    $userProvince = '';
    $userPostalCode = '';
    $userTypeID = 0;
    $userDepartmentID = 0;
    $formAction = route('dashboard.user.storeUser');
    $submitButton = 'Create User';

    if(!empty($user)){
        $title = 'ویرایش کاربر | سیستم ارتباط با مشتریان آرگون';
        $userName = $user->name;
        $userEmail = $user->email;
        $userOrganization = $user->organization;
        $userAddress = $user->address;
        $userCity = $user->city;
        $userProvince = $user->province;
        $userPostalCode = $user->postal_code;
        $userTypeID = $user->UTID;
        $userDepartmentID = $user->DID;
        $formAction = route('dashboard.user.updateUser');
        $submitButton = 'Update User';

    }
@endphp

@extends('layouts.Dashboard.main')
@section('title', $title)

@section('pageContent')
    @include('errors.error')
    <div class="row">
        @if(count($result) > 0)
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile position-sticky" style="top: 30px">
                <img src="/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="/assets/img/theme/team-4.jpg" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/dashboard/tickets') }}" class="btn btn-sm btn-default float-right">See
                            tickets</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading">{{ $result['allTickets']->count() }}</span>
                                    <span class="description">Total</span>
                                </div>
                                <div>
                                    <span class="heading">{{ $result['open']->count() }}</span>
                                    <span class="description">Open</span>
                                </div>
                                <div>
                                    <span class="heading">{{ $result['inProgress']->count() }}</span>
                                    <span class="description">Progress</span>
                                </div>
                                <div>
                                    <span class="heading">{{ $result['rate'] }}%</span>
                                    <span class="description">Rate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="h3">{{ $user->name }}</h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{ ucfirst($user->city) }}
                            , {{ ucwords($user->province) }}
                        </div>
                        <div class="h5 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>{{ ucwords($user->organization) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-xl-{{ count($result) > 0  ? '8' : '12'  }} order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Submit user</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $formAction }}">
                        @csrf
                        @if(Route::currentRouteName() == 'editUser')
                            @method('patch')
                            <input type="hidden" name="_id" value="{{ $user->id }}">
                        @endif
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Full name</label>
                                        <input name="fullname" type="text" id="input-username" class="form-control"
                                               placeholder="Full name" value="{{ $userName }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input name="email" type="email" id="input-email" class="form-control"
                                               placeholder="jesse@example.com" value="{{ $userEmail }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Organization</label>
                                        <input name="organization" type="text" id="input-first-name"
                                               class="form-control" placeholder="Organization"
                                               value="{{ $userOrganization }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-end" id="passwordField">
                                <div class="col-lg-5 d-none">
                                    <div class="form-group">
                                        <label class="form-control-label" for="password">Password</label>
                                        <input name="password" type="password" id="password"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <a id="makePassword" class="btn btn-primary text-white">Generate Password</a>
                                    </div>
                                </div>
                            </div>
                            <div id="userTypes" class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-usertype-name">User type</label>
                                        <div id="input-usertype-name">
                                            @foreach($userTypes as $userType)
                                                @if($userType->id != 3)
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input
                                                            {{ $userType->id == 2 ? 'data-department=show' : '' }} type="radio"
                                                            id="customRadio{{ $userType->id }}"
                                                            name="userType" class="custom-control-input"
                                                            value="{{ $userType->id }}" {{ $userTypeID == $userType->id ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                               for="customRadio{{ $userType->id }}">{{ $userType->name }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="departmentWasHidden" class="row {{ $userTypeID != 2 ? 'd-none' : '' }}">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="department" class="form-control-label">Department</label>
                                        <div id="department">
                                            @foreach($departments as $department)
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="departmentRadio{{ $department->id }}"
                                                           name="department" class="custom-control-input"
                                                           value="{{ $department->id }}" {{ $userDepartmentID == $department->id ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="departmentRadio{{ $department->id }}">{{ $department->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4"/>
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input name="address" id="input-address" class="form-control"
                                               placeholder="Address"
                                               type="text" value="{{ $userAddress }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">City</label>
                                        <input name="city" type="text" id="input-city" class="form-control"
                                               placeholder="City" value="{{ $userCity }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Province</label>
                                        <input name="province" type="text" id="input-country" class="form-control"
                                               placeholder="Province" value="{{ $userProvince }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Postal code</label>
                                        <input name="postal_code" type="number" id="input-postal-code"
                                               class="form-control" value="{{ $userPostalCode }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4"/>
                        <!-- Description -->
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">{{ $submitButton }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
