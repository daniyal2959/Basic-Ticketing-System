@extends('layouts.Dashboard.main')

@section('pageContent')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><strong>Ticket {{ ucfirst(last(Request::segments())) }}</strong></h3>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Tickets table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Name</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @yield('content')
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if( $ticketStatuses->isNotEmpty() )
                {{ $ticketStatuses->links() }}
            @endif
        </div>
        <div class="col text-right">
            <a href="{{ route('dashboard.status.createTicketStatuses') }}" class="btn btn-primary">Add ticket status</a>
        </div>
    </div>
@endsection
