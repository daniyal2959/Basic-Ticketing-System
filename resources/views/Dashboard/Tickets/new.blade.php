@extends('layouts.Dashboard.main')
@php
$formAction = route('dashboard.tickets.store');
$ticketTitle = '';
$pageTitle = 'ثبت تیکت جدید | سیستم ارتباط با مشتریان آرگون';
$ticketDepartment = 0;
$ticketPriority = 0;
$submitButton = 'Send';

if(Route::currentRouteName() === 'edit'){
    $formAction = url('/dashboard/tickets/'.$ticket->id);
    $ticketTitle = $ticket->title;
    $pageTitle = 'ویرایش تیکت شماره '.$ticket->id.' | سیستم ارتباط با مشتریان آرگون';
    $ticketDepartment = $ticket->DID;
    $ticketPriority = $ticket->PID;
    $submitButton = 'Update';
}
@endphp
@section('title', $pageTitle)

@section('pageContent')
    <div class="card">
        <div class="card-body">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label"><strong>Ticket title</strong></label>
                    <input name="title" value="{{ $ticketTitle }}" class="form-control" type="text" placeholder="Write here your main problem" id="example-text-input" required>
                </div>

                <div class="form-group">
                    <label for="departments"><strong>Department</strong></label>
                    <div id="departments">
                        @foreach($departments as $department)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="department" value="{{ $department->id }}" {{ $department->id == $ticketDepartment ? 'checked' : ''  }} type="radio" id="customRadioInline{{ $department->id }}" class="custom-control-input" required>
                                <label class="custom-control-label" for="customRadioInline{{ $department->id }}">{{ $department->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if(Route::currentRouteName() !== 'edit')
                <div class="form-group">
                    <label for="ticketMessage"><strong>Message</strong></label>
                    <textarea name="message" id="ticketMessage" rows="10" class="form-control" required></textarea>
                </div>
                @endif

                <div class="form-group">
                    <label for="priority"><strong>Priority</strong></label>
                    <div id="priority">
                        @foreach($priorities as $priority)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="priority" value="{{ $priority->id }}" {{ $priority->id == $ticketPriority ? 'checked' : ''  }} type="radio" id="priority{{ $priority->id }}" class="custom-control-input" required>
                                <label class="custom-control-label" for="priority{{ $priority->id }}">{{ ucfirst($priority->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-icon btn-primary" type="submit">
                    <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                    <span class="btn-inner--text">{{ $submitButton }} Ticket</span>
                </button>
            </form>
        </div>
    </div>
@endsection
