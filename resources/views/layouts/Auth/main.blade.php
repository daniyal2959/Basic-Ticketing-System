@include('layouts.Auth.header')

<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">@yield('PageTitle')</h1>
                        <p class="text-lead text-white">@yield('PageDescription')</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>@yield('PageSignText')</small></div>
                        <div class="btn-wrapper text-center">
                            <a href="{{ route('platform.redirect', ['platform' => 'github']) }}" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="/assets/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">Github</span>
                            </a>
                            <a href="{{ route('platform.redirect', ['platform' => 'google']) }}" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="/assets/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">Google</span>
                            </a>
                        </div>
                    </div>
                    @yield('content')
                </div>
                @yield('Extras')
            </div>
        </div>
    </div>
</div>

@include('layouts.Auth.footer')
