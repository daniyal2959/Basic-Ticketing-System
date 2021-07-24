@php
    $title = 'ثبت دپارتمان جدید | سیستم ارتباط با مشتریان آرگون';
    $formAction = route('storeDepartment');
    $departmentName = '';
    $submitButton = 'Add Department';
    if( !empty($department) ){
        $title = 'ویرایش دپارتمان | سیستم ارتباط با مشتریان آرگون';
        $formAction = route('updateDepartment');
        $departmentName = $department->name;
        $submitButton = 'Update Department';
    }
@endphp

@extends('layouts.Dashboard.main')
@section('title', $title)

@section('pageContent')
    <div class="card">
        <div class="card-body">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                @if( !empty($department) )
                    @method('patch')
                    <input type="hidden" name="_id" value="{{ $department->id }}">
                @endif
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"><strong>Department name</strong></label>
                    <input value="{{ $departmentName }}" name="name"
                           class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                           placeholder="Write department name here" id="example-text-input" required>
                    @if($errors->has('name'))
                        <small id="required" class="form-text text-danger text-capitalize">this field is require</small>
                    @endif
                </div>
                <button class="btn btn-icon btn-primary" type="submit">
                    <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                    <span class="btn-inner--text">{{ $submitButton }}</span>
                </button>
            </form>
        </div>
    </div>
@endsection
