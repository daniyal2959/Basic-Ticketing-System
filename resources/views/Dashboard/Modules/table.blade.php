@extends('layouts.Dashboard.main')

@section('pageContent')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col d-flex align-items-center justify-content-between">
                    <h3 class="mb-0" style="flex: 1 0 0">
                        <strong>{{ ucfirst(last(Request::segments())) }}</strong>
                    </h3>
                    <h4 style="display: grid; grid-template-columns: repeat(3, 1fr); flex: 2 0 0" class="text-right m-0">
                            <span>
                                <strong>All: </strong>{{ \App\Classes\Module::count() }}
                            </span>
                        <span>
                                <strong>Enabled: </strong>{{ \App\Classes\Module::enabledCount() }}
                            </span>
                        <span>
                                <strong>Disabled: </strong>{{ \App\Classes\Module::disabledCount() }}
                            </span>
                    </h4>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Plugins table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
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
        <div class="col text-right">
            <a href="{{ route('dashboard.modules.createModule') }}" class="btn btn-primary">Create Module</a>
            <a href="{{ route('dashboard.modules.createModule', ['type' => 'install']) }}" class="btn btn-secondary">Install Module</a>
        </div>
    </div>

@endsection
