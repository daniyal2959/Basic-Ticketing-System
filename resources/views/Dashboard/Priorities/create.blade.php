@php
    $title = 'ثبت اولویت جدید | سیستم ارتباط با مشتریان آرگون';
    $formAction = route('storePriority');
    $priorityName = '';
    $submitButton = 'Add Priority';
    $priorityColor = '#5e72e4';
    if( !empty($priority) ){
        $title = 'ویرایش اولویت | سیستم ارتباط با مشتریان آرگون';
        $formAction = route('updatePriority');
        $priorityName = $priority->name;
        $submitButton = 'Update Priority';
        $priorityColor = $priority->color;
    }
@endphp

@extends('layouts.Dashboard.main')
@section('title', 'ثبت اولیت جدید | سیستم ارتباط با مشتریان آرگون')

@section('pageContent')
    <div class="card">
        <div class="card-body">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                @if( !empty($priority) )
                    @method('patch')
                    <input type="hidden" name="_id" value="{{ $priority->id }}">
                @endif
                <div class="d-flex">
                    <div class="form-group col-11 p-0">
                        <label for="example-text-input" class="form-control-label"><strong>Priority
                                name</strong></label>
                        <input value="{{ $priorityName }}" name="name"
                               class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                               type="text" placeholder="Write priority name here" id="example-text-input" required>
                        @if($errors->has('name'))
                            <small id="required" class="form-text text-danger text-capitalize">this field is
                                require</small>
                        @endif
                    </div>

                    <div class="form-group col-1">
                        <label for="example-color-input" class="form-control-label">Color</label>
                        <div class="position-relative">
                            <div
                                style="width: 40px; height: 40px; left: 0; top: 3px; z-index: 0; background-color: {{ $priorityColor }}"
                                id="colorChoosed" class="rounded-circle position-absolute"></div>
                            <input name="color" style="opacity: 0; z-index: 1;" class="form-control" type="color"
                                   value="{{ $priorityColor }}" id="example-color-input">
                        </div>
                    </div>
                </div>

                <button class="btn btn-icon btn-primary" type="submit">
                    <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                    <span class="btn-inner--text">{{ $submitButton }}</span>
                </button>
            </form>
        </div>
    </div>
@endsection
