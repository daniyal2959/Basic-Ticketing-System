@include('layouts.styles')

@include('layouts.sidebar')

<div class="main-content" id="panel">
    @include('layouts.topnav')
    @yield('profileHeader')

    @hasSection('profileHeader')

    @else
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    @include('layouts.breadcrumb')

                    @yield('belowBreadcrumb')
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid mt--6">
        @yield('pageContent')
    </div>


</div>

@include('layouts.scripts')
