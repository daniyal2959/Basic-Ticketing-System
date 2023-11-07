@php
    $segments = Request::segments();
    $lastSegment = ucfirst(last($segments));

    $i = 0;
@endphp

<div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
        <h6 class="h2 text-white d-inline-block mb-0">{{ $lastSegment }}</h6>
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                @foreach($segments as $segment)
                    @php $segment = ucfirst($segment); @endphp
                    @if( $segment != $lastSegment)
                        <li class="breadcrumb-item"><a href="{{ $i == 1 ? '/dashboard/'.lcfirst($segment) : '/dashboard/' }}">{{ $segment }}</a></li>
                    @endif
                    @php $i+= 1; @endphp

                @endforeach
                <li class="breadcrumb-item active" aria-current="page">{{ $lastSegment }}</li>
            </ol>
        </nav>
    </div>
    @if(Route::currentRouteName() != 'newTicket')
        <div class="col-lg-6 col-5 text-right">
            <a href="{{ route('dashboard.tickets.create') }}" class="btn btn-default">New ticket</a>
        </div>
    @endif
</div>
