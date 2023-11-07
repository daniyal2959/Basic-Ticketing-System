@extends('Dashboard.TicketStatuses.table')
@section('title', 'همه تیکت ها | سیستم ارتباط با مشتریان آرگون')

@section('content')
    @unless( $ticketStatuses->isEmpty() )
        @foreach($ticketStatuses as $ticketStatus)
            <tr>
                <td>
                    {{ $ticketStatus->id }}
                </td>
                <td class="font-weight-bold ">
                    {{ $ticketStatus->title }}
                </td>
                <td class="font-weight-bold ">
                    {{ $ticketStatus->name }}
                </td>
                <td>
                    <i class="{{ $ticketStatus->icon_name }} text-{{ $ticketStatus->icon_color }} fa-2x"></i>
                </td>
                <td>
                    <form action="{{ route('dashboard.status.deleteTicketStatus') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_id" value="{{ $ticketStatus->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                    <a href="{{ url('/dashboard/status/'.$ticketStatus->id.'/edit') }}" class="mx-1">
                        <i class="fas fa-edit text-primary" style="font-size: 1.2em"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="4">Not Found</td>
        </tr>
    @endunless
@endsection
