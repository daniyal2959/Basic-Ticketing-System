@extends('layouts.Dashboard.main')
@section('title', 'مشاهده تیکت | سیستم ارتباط با مشتریان آرگون')

@section('pageContent')
    <div class="d-flex">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Messages</h6>
                    <div class="d-flex flex-column justify-content-center align-items-start">
                        @foreach($messages as $message)
                            <div
                                class="d-flex align-items-center {{ Auth::id() != $message->user->id ? 'align-self-end flex-row-reverse' : ''  }}">
                                <p style="{{ Auth::id() != $message->user->id ? 'direction: rtl' : '' }}"
                                   class="{{ Auth::id() != $message->user->id ? 'ml-2' : 'mr-2' }}">{{ $message->user->name }}
                                    : </p>
                                <div class="card">
                                    <div
                                        class="card-body {{ Auth::id() != $message->user->id ? 'bg-green' : 'bg-indigo' }} rounded text-white d-inline-block p-2">
                                        <p class="m-0">{{ $message->message }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/dashboard/messages/'.$ticket->id) }}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Message Body</h6>
                        <div class="form-group">
                            <textarea name="message" id="ticketMessage" rows="10" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-icon btn-primary" type="submit">
                            <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                            <span class="btn-inner--text">Send Message</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card position-sticky top-4">
                <div class="card-body">
                    <form action="{{ url('/dashboard/tickets/'.$ticket->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <h6 class="heading-small text-muted mb-4">Ticket information</h6>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label"><strong>Ticket
                                    title</strong></label>
                            <input value="{{ $ticket->title }}" name="title" class="form-control" type="text"
                                   placeholder="Write here your main problem" id="example-text-input">
                        </div>

                        <div class="form-group">
                            <label for="departments"><strong>Department</strong></label>
                            <div id="departments" style="display: grid; grid-template-columns: repeat(2, 1fr)">
                                @foreach($departments as $department)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input {{ $ticket->DID == $department->id ? 'checked' : '' }} name="department"
                                               value="{{ $department->id }}" type="radio"
                                               id="customRadioInline{{ $department->id }}" class="custom-control-input">
                                        <label style="height: unset" class="custom-control-label"
                                               for="customRadioInline{{ $department->id }}">{{ $department->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="priority"><strong>Priority</strong></label>
                            <div id="priority" style="display: grid; grid-template-columns: repeat(3, 1fr)">
                                @foreach($priorities as $priority)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input {{ $ticket->PID == $priority->id ? 'checked' : '' }} name="priority"
                                               value="{{ $priority->id }}" type="radio" id="priority{{ $priority->id }}"
                                               class="custom-control-input">
                                        <label class="custom-control-label"
                                               for="priority{{ $priority->id }}">{{ ucfirst($priority->name) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if($ticketStatuses->isNotEmpty())
                            <div class="form-group">
                                <label for="ticketStatus"><strong>Status</strong></label>
                                <div id="ticketStatus" style="display: grid; grid-template-columns: repeat(3, 1fr)">
                                    @foreach($ticketStatuses as $ticketStatus)
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input {{ $ticket->TSID == $ticketStatus->id ? 'checked' : '' }} name="ticketStatus"
                                                   value="{{ $ticketStatus->id }}" type="radio" id="ticketStatus{{ $ticketStatus->id }}"
                                                   class="custom-control-input">
                                            <label class="custom-control-label"
                                                   for="ticketStatus{{ $ticketStatus->id }}">{{ ucfirst($ticketStatus->name) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <button class="btn btn-icon btn-primary" type="submit">
                            <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                            <span class="btn-inner--text">Update Ticket</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

