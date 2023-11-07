@extends('layouts.Dashboard.main')
@section('title', 'داشبورد | سیستم ارتباط با مشتریان آرگون')

@section('belowBreadcrumb')
    <div class="row">
        @foreach($parameters['data'] as $parameter)
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats" @if( !isset($parameter['url']) ) style="height: calc(100% - 1.25em)" @endisset>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ $parameter['title'] }}</h5>
                                <span class="h2 font-weight-bold mb-0">{{ isset($parameter['items']) ? $parameter['items']->count() : $parameter['count'] }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape {{ $parameters['colors'][$loop->index] }} text-white rounded-circle shadow">
                                    <i class="{{ $parameter['icon'] }}"></i>
                                </div>
                            </div>
                        </div>
                        @isset($parameter['url'])
                            <a href="{{ $parameter['url'] }}" class="btn btn-sm btn-primary mt-3">See all</a>
                        @endisset
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection



@section('pageContent')
    <div class="row">
        <div class="col-xl-8">
            <div class="card" id="allTickets">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">All tickets</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('/dashboard/tickets') }}" class="btn btn-sm btn-primary">See all</a>
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
                            <th scope="col">Last action</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($parameters['allTickets']['items'] as $ticket)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ url('/dashboard/tickets/'.$ticket->id) }}">{{ $ticket->id }}</a>--}}
{{--                                </td>--}}
{{--                                <td class="font-weight-bold">--}}
{{--                                    <a href="{{ url('/dashboard/tickets/'.$ticket->id) }}">{{ $ticket->title }}</a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $ticket->department->name }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <i class="fas fa-circle mr-3" style="color: {{ $ticket->priority->color }}"></i>--}}

{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ \Carbon\Carbon::parse( $ticket->updated_at )->diffForHumans() }}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card bg-default" id="barChartCard">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light text-muted ls-1 mb-1">Performance</h6>
                            <h5 class="h3 mb-0 text-white">Total tickets</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach( $parameters['tables'] as $tableName )
            <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{ $parameters['data'][$tableName]['title'] }}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ $parameters['data'][$tableName]['url'] }}" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Tckets table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ticket title</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parameters['data'][$tableName]['items'] as $ticket)
                            <tr>
                                <td>
                                    <a href="{{ url('/dashboard/tickets/'.$ticket->id) }}">{{ $ticket->id }}</a>
                                </td>
                                <td class="font-weight-bold">
                                    <a href="{{ url('/dashboard/tickets/'.$ticket->id) }}">{{ $ticket->title }}</a>
                                </td>
                                <td>
                                    {{ $ticket->department->name }}
                                </td>
                                <td>
                                    <i class="fas fa-circle mr-3" style="color: {{ $ticket->priority->color }}"></i>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
