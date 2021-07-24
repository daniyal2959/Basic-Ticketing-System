@php
    $title = 'ثبت وضعیت تیکت جدید | سیستم ارتباط با مشتریان آرگون';
    $formAction = route('storeTicketStatus');
    $ticketStatusName = '';
    $submitButton = 'Add Ticket Status';
    if( !empty($ticketStatus) ){
        $title = 'ویرایش وضعیت تیکت | سیستم ارتباط با مشتریان آرگون';
        $formAction = route('updateTicketStatus');
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
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"><strong>Ticket status
                            name</strong></label>
                    <input value="{{ $ticketStatusName }}" name="name"
                           class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" type="text"
                           placeholder="Write ticket status name here" id="example-text-input" required>
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
