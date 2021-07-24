@extends('layouts.Dashboard.main')
@section('title', 'ویرایش پروفایل | سیستم ارتباط با مشتریان آرگون')

@section('profileHeader')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center position-relative"
         style="min-height: 500px; background-image: url(/assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
    @include('errors.error')
    <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row w-100">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Howdy {{ ucfirst(explode(' ',$user->name)[0]) }}</h1>
                    <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with
                        your business</p>
                </div>
                <div class="col-lg-5 col-md-2 d-flex justify-content-end align-items-center">
                    <a class="btn btn-neutral" href="{{ route('create') }}">New Ticket</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageContent')
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
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
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit profile </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('updateUser') }}">
                        @csrf
                        @method('patch')
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Full name</label>
                                        <input name="fullname" type="text" id="input-username" class="form-control"
                                               placeholder="Full name" value="{{ empty($user->name) == true ? old('fullname') : $user->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input name="email" type="email" id="input-email" class="form-control"
                                               placeholder="jesse@example.com" value="{{ empty($user->email) == true ? old('email') : $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Organization</label>
                                        <input name="organization" type="text" id="input-first-name"
                                               class="form-control" placeholder="Organization"
                                               value="{{ empty($user->organization) == true ? old('organization') : $user->organization }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 d-flex justify-content-start align-items-center">
                                    <div class="form-group m-0">
                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                                data-target="#changePasswordModal">Change Password
                                        </button>
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
                                               placeholder="Address" value="{{ empty($user->address) == true ? old('address') : $user->address }}" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">City</label>
                                        <input name="city" type="text" id="input-city" class="form-control"
                                               placeholder="City" value="{{ empty($user->city) == true ? old('city') : $user->city }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Province</label>
                                        <input name="province" type="text" id="input-country" class="form-control"
                                               placeholder="Province" value="{{ empty($user->province) == true ? old('province') : $user->province }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Postal code</label>
                                        <input name="postal_code" type="number" id="input-postal-code"
                                               class="form-control" placeholder="{{ empty($user->postal_code) == true ? old('postal_code') : $user->postal_code }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4"/>
                        <!-- Description -->
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('updateUserPassword') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="form-control-label" for="passwordField">Password</label>
                                            <input type="password" class="form-control" id="passwordField" name="password">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
