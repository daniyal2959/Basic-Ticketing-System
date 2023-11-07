@php
    $title = 'ثبت وضعیت تیکت جدید | سیستم ارتباط با مشتریان آرگون';
    $formAction = route('dashboard.status.storeTicketStatus');
    $ticketStatusName = '';
    $submitButton = 'Add Ticket Status';
    if( !empty($ticketStatus) ){
        $title = 'ویرایش وضعیت تیکت | سیستم ارتباط با مشتریان آرگون';
        $formAction = route('dashboard.status.updateTicketStatus');
        $ticketStatusName = $ticketStatus->name;
        $submitButton = 'Update Ticket Status';
    }
@endphp

@extends('layouts.Dashboard.main')
@section('title', $title)

@section('pageContent')
    <div class="card">
        <div class="card-body">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                @if( !empty($ticketStatus) )
                    @method('patch')
                    <input type="hidden" name="_id" value="{{ $ticketStatus->id }}">
                @endif
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0 10px">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label"><strong>Title</strong></label>
                        <input value="{{ $ticketStatus->title ?? '' }}" name="title"
                               class="form-control {{ $errors->has('title') ? 'border-danger' : '' }}" type="text"
                               placeholder="Write ticket status title here" id="example-text-input" required>
                        @if($errors->has('title'))
                            <small id="required" class="form-text text-danger text-capitalize">this field is require</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label"><strong>Name</strong></label>
                        <input value="{{ $ticketStatusName }}" name="name"
                               class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                               placeholder="Write ticket status name here" id="example-text-input" required>
                        @if($errors->has('name'))
                            <small id="required" class="form-text text-danger text-capitalize">this field is require</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label"><strong>Icon Name</strong></label>
                        <input value="{{ $ticketStatus->icon_name ?? '' }}" name="icon_name"
                               class="form-control {{ $errors->has('icon_name') ? 'border-danger' : '' }}" type="text"
                               placeholder="Write ticket status icon name here" id="example-text-input" required>
                        @if($errors->has('icon_name'))
                            <small id="required" class="form-text text-danger text-capitalize">this field is require</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label"><strong>Icon Name</strong></label>
                        <input value="{{ $ticketStatus->icon_color ?? '' }}" name="icon_color"
                               class="form-control {{ $errors->has('icon_color') ? 'border-danger' : '' }}" type="text"
                               placeholder="Write ticket status icon color here" id="example-text-input" required>
                        @if($errors->has('icon_color'))
                            <small id="required" class="form-text text-danger text-capitalize">this field is require</small>
                        @endif
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
