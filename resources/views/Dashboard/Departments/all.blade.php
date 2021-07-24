@extends('Dashboard.Departments.table')
@section('title', 'دپارتمان ها | سیستم ارتباط با مشتریان آرگون')

@section('content')
    @unless( $departments->isEmpty() )
        @foreach($departments as $department)
            <tr>
                <td>
                    {{ $department->id }}
                </td>
                <td class="font-weight-bold ">
                    {{ $department->name }}
                </td>
                <td class="text-center">
                    <strong>{{ $department->getTotalSupporterCount($department->id) }}</strong>
                </td>
                <td class="text-center">
                    {{-- All Tickets Count --}}
                    <strong>{{ $department->getTotalTicketCountWithStatus($department->id, 0) }}</strong>
                </td>
                <td class="text-center">
                    {{-- Opened Tickets Count --}}
                    <strong>{{ $department->getTotalTicketCountWithStatus($department->id, 1) }}</strong>
                </td>
                <td class="text-center">
                    {{-- In Progress Tickets Count --}}
                    <strong>{{ $department->getTotalTicketCountWithStatus($department->id, 2) }}</strong>
                </td>
                <td class="text-center">
                    {{-- Answered Tickets Count --}}
                    <strong>{{ $department->getTotalTicketCountWithStatus($department->id, 3) }}</strong>
                </td>
                <td>
                    <form action="{{ route('deleteDepartment') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_id" value="{{ $department->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                    <a href="{{ url('/dashboard/departments/'.$department->id.'/edit') }}" class="mx-1">
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
