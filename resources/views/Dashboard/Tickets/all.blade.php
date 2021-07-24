@extends('Dashboard.Tickets.table')
@section('title', 'همه تیکت ها | سیستم ارتباط با مشتریان آرگون')

@section('content')
    @unless( $tickets->isEmpty() )
        @foreach($tickets as $ticket)
            <tr>
                <td>
                    {{ $ticket->id }}
                </td>
                <td class="font-weight-bold">
                    {{ $ticket->title }}
                </td>
                <td>
                    {{ $ticket->department->name }}
                </td>
                <td>
                    <i class="fas fa-circle mr-3" style="color: {{ $ticket->priority->color }}"></i>
                </td>
                <td>
                    @if( $ticket->messages->count() > 0 )
                        {{ \Carbon\Carbon::parse( $ticket->messages->last()->updated_at )->diffForHumans()  }}
                    @else
                        {{ \Carbon\Carbon::parse( $ticket->updated_at )->diffForHumans()  }}
                    @endif
                </td>
                <td class="d-flex align-items-center">
                    @if(Auth::user()->UTID != 1)
                        <form action="{{ route('deleteTicket') }}" method="POST" class="mx-1 d-inline-block">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="_id" value="{{ $ticket->id }}">
                            <button class="border-0 bg-white" type="submit">
                                <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip"
                                   data-placement="left" title="Are you sure to delete this department?"></i>
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('closeTicket') }}" method="POST">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="_id" value="{{ $ticket->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-times text-green" style="font-size: 1.2em" data-toggle="tooltip"
                               data-placement="left" title="Close ticket"></i>
                        </button>
                    </form>
                    <a href="{{ url('/dashboard/tickets/'.$ticket->id) }}" class="mx-1">
                        <i class="fas fa-edit text-primary" style="font-size: 1.2em"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="5">Not Found</td>
        </tr>
    @endunless
@endsection
