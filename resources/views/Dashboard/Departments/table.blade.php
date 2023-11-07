@extends('layouts.Dashboard.main')

@section('pageContent')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><strong>{{ ucfirst(last(Request::segments())) }} tickets</strong></h3>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Tickets table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Supporters Count</th>
                    <th scope="col">Total Tickets</th>
                    <th scope="col">Opened Tickets</th>
                    <th scope="col">In Progress Tickets</th>
                    <th scope="col">Answered Tickets</th>
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
            @if( $departments->isNotEmpty() )
                {{ $departments->links() }}
            @endif
        </div>
        <div class="col text-right">
            <a href="{{ route('dashboard.departments.createDepartment') }}" class="btn btn-primary">Add departments</a>
        </div>
    </div>

@endsection
