<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header navbar-inner d-flex align-items-center justify-content-between">
            @if( Str::lower(\Illuminate\Support\Facades\Auth::user()->user_type->name) != "admin" )
                <select style="padding: 0.75rem 0.25rem 0.75rem 0.25rem; cursor:pointer; outline: none" class="border-0 bg-primary rounded-lg text-white" id="tenancy">
                    @foreach($companies as $item)
                        <option title="{{ $item->name }}" value="{{ \Illuminate\Support\Str::lower($item->name) }}" @if( \Illuminate\Support\Str::lower($company->name) == \Illuminate\Support\Str::lower($item->name) ) selected @endif>{{ $item->excerpt }}</option>
                    @endforeach
                </select>
            @endif
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img src="/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'index' ? 'active' : '' }}" href="{{ url('/dashboard/tickets') }}">
                            <i class="ni ni-bullet-list-67" style="color: #b2bec3"></i>
                            <span class="nav-link-text">All Tickets</span>
                        </a>
                    </li>
                    @foreach($ticketStatuses as $status)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() === $status->name ? 'active' : '' }}" href="{{ route('statusArchive', ['status' => $status->name]) }}">
                                <i class="{{ $status->icon_name }} text-{{ $status->icon_color }}"></i>
                                <span class="nav-link-text">{{ ucfirst($status->title) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">User</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'userProfile' ? 'active' : '' }}" href="{{ route('dashboard.user.userProfile') }}">
                            <i class="ni ni-paper-diploma text-info"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    @if(Auth::user()->UTID == 3)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'allUsers' ? 'active' : '' }}" href="{{ route('dashboard.allUsers') }}">
                            <i class="ni ni-single-02 text-pink"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                    </li>
                    @endif
                </ul>

                @if(Auth::user()->UTID == 3)
                <hr class="mt-0">

                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Settings</span>
                </h6>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a href="{{ route('dashboard.modules.allModules') }}" class="nav-link {{ Route::currentRouteName() === 'allModules' ? 'active' : '' }}">
                            <i class="ni ni-settings-gear-65 text-primary"></i>
                            <span class="nav-link-text">
                                <span class="mr-2">Modules</span>
                                <span class="badge badge-circle badge-success">{{ \App\Classes\Module::count() }}</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.departments.allDepartments') }}" class="nav-link {{ Route::currentRouteName() === 'allDepartments' ? 'active' : '' }}">
                            <i class="ni ni-building text-orange"></i>
                            <span class="nav-link-text">Departments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.priorities.allPriorities') }}" class="nav-link {{ Route::currentRouteName() === 'allPriorities' ? 'active' : '' }}">
                            <i class="ni ni-chart-bar-32 text-indigo"></i>
                            <span class="nav-link-text">Priorities</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.status.allTicketStatuses') }}" class="nav-link {{ Route::currentRouteName() === 'allTicketStatuses' ? 'active' : '' }}">
                            <i class="ni ni-bell-55 text-green"></i>
                            <span class="nav-link-text">Ticket Status</span>
                        </a>
                    </li>
                </ul>
                @endif

                <i id="nightMode" style="user-select: none;min-width: 38px; min-height: 38px; cursor: pointer" class="ni ni-bulb-61 position-absolute bottom-1 left-3 circle bg-primary d-inline-block text-white d-flex justify-content-center align-items-center" ></i>
            </div>
        </div>
    </div>
</nav>
