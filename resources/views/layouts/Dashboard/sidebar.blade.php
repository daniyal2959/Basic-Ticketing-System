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
                @foreach($groups as $group)
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">{{ ucwords($group->name) }}</span>
                    </h6>
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        @foreach($group->menus as $menu)
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() === getRouteNameByURL($menu->link) ? 'active' : '' }}" href="{{ $menu->link }}">
                                <i class="{{ $menu->icon }} {{ $menu->color }}"></i>
                                <span class="nav-link-text">{{ ucwords($menu->title) }}</span>
                                @isset( $menu->extra )
                                    {!! $menu->extra !!}
                                @endisset
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                @endforeach

                <i id="nightMode" style="user-select: none;min-width: 38px; min-height: 38px; cursor: pointer" class="ni ni-bulb-61 position-absolute bottom-1 left-3 circle bg-primary d-inline-block text-white d-flex justify-content-center align-items-center" ></i>
            </div>
        </div>
    </div>
</nav>
