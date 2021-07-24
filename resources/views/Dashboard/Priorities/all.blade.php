@extends('Dashboard.Priorities.table')
@section('title', 'اولویت ها | سیستم ارتباط با مشتریان آرگون')

@section('content')
    @unless( $priorities->isEmpty() )
        @foreach($priorities as $priority)
            <tr>
                <td>
                    {{ $priority->id }}
                </td>
                <td class="font-weight-bold ">
                    {{ $priority->name }}
                </td>
                <td>
                    <i class="fas fa-circle mr-3" style="color: {{ $priority->color }}"></i>
                </td>
                <td>
                    <form action="{{ route('deletePriority') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_id" value="{{ $priority->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                    <a href="{{ url('/dashboard/priorities/'.$priority->id.'/edit') }}" class="mx-1">
                        <i class="fas fa-edit text-primary" style="font-size: 1.2em"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="4">Not Found</td>
        </tr>
    @endunless
@endsection
