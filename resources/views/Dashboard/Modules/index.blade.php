@extends('Dashboard.Modules.table')
@section('title', 'ماژول ها | سیستم ارتباط با مشتریان آرگون')

@section('content')
    @unless( $modules == [] )
        @foreach($modules as $module)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td class="font-weight-bold ">
                    {{ $module->getName() }}
                </td>
                <td class="text-left">
                    @if( $module->isEnabled() )
                        <span class="badge badge-pill badge-success">Enable</span>
                    @else
                        <span class="badge badge-pill badge-danger">Disable</span>
                    @endif
                </td>
                <td class="text-left">
                    <a href="#">
                    </a>
                    <form action="{{ $module->isEnabled() ? route('dashboard.modules.disableModule') : route('dashboard.modules.enableModule') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        <input type="hidden" name="name" value="{{ $module->getName() }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-power-off {{ $module->isEnabled() ? 'text-danger' : 'text-success' }}" data-toggle="tooltip" data-placement="top" title="{{ $module->isEnabled() ? 'Disable' : 'Enable' }}"></i>
                        </button>
                    </form>
                    <form action="{{ route('dashboard.modules.deleteModule') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="name" value="{{ $module->getName() }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="4">Not Found</td>
        </tr>
    @endunless
@endsection
