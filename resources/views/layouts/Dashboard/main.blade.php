@include('layouts.Dashboard.styles')

@include('layouts.Dashboard.sidebar')

<div class="main-content" id="panel">
    @include('layouts.Dashboard.nav')
    @yield('profileHeader')

    @hasSection('profileHeader')

    @else
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    @include('layouts.Dashboard.header')

                    @yield('belowBreadcrumb')
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid mt--6">
        @yield('pageContent')
    </div>


</div>

@include('layouts.Dashboard.scripts')
