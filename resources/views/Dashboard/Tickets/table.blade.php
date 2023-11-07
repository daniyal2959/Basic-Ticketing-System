@extends('layouts.Dashboard.main')

@section('pageContent')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><strong>{{ ucfirst(last(Request::segments())) }}</strong></h3>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Tickets table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ticket title</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Last reply</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @yield('content')
                </tbody>
            </table>
        </div>
    </div>

    @if( $tickets->isNotEmpty() )
        {{ $tickets->links() }}
    @endif
@endsection
