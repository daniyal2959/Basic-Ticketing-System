@extends('layouts.Dashboard.main')

@section('pageContent')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"><strong>All users</strong></h3>
                </div>
                <div class="col text-right">
                    <ul class="nav nav-pills justify-content-end">
                        <li class="mx-1">
                            <a data-toggle="pill" href="#allUsers" class="btn btn-sm btn-primary">All</a>
                        </li>
                        <li class="mx-1">
                            <a data-toggle="pill" href="#customers" class="btn btn-sm btn-primary">Customers</a>
                        </li>
                        <li class="mx-1">
                            <a data-toggle="pill" href="#supporters" class="btn btn-sm btn-primary">Supporters</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div id="allUsers" class="tab-pane fade active show">
                <div class="table-responsive">
                    <!-- Tickets table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name (org OR dep)</th>
                            <th scope="col">Permission</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @yield('allUsersContent')
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="customers" class="tab-pane fade">
                <div class="table-responsive">
                    <!-- Tickets table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name (Organization)</th>
                            <th scope="col">Tickets Count</th>
                            <th scope="col">Answered Tickets</th>
                            <th scope="col">Opened Tickets</th>
                            <th scope="col">In Progress Tickets</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @yield('customersUserContent')
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="supporters" class="tab-pane fade">
                <div class="table-responsive">
                    <!-- Tickets table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @yield('supporterUserContent')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if( $users->isNotEmpty() )
                {{ $users->links() }}
            @endif
        </div>
        <div class="col text-right">
            <a href="{{ route('createUser') }}" class="btn btn-primary">Add user</a>
        </div>
    </div>
@endsection
