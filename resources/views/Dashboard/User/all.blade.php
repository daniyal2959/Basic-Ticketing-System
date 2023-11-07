@extends('Dashboard.User.table')
@section('title', 'کاربران | سیستم ارتباط با مشتریان آرگون')

@section('allUsersContent')
    @if( $users->isNotEmpty() )
        @foreach($users as $user)
            <tr>
                <td>
                    <a href="{{ url('/dashboard/user/'.$user->id. '/edit') }}">{{ $user->id }}</a>
                </td>
                <td class="font-weight-bold ">
                    <a href="{{ url('/dashboard/user/'.$user->id. '/edit') }}">{{ $user->name }} {{ empty($user->department->name) ? '('.$user->organization.')' : '('.$user->department->name.')' }}</a>
                </td>
                <td>
                    <strong>{{ $user->user_type->name }}</strong>
                </td>
                <td>
                    @if($user->UTID != 3)
                    <form action="{{ route('dashboard.user.deleteUser') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_id" value="{{ $user->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                    @endif
                    <a href="{{ url('/dashboard/user/'.$user->id.'/edit') }}" class="mx-1">
                        <i class="fas fa-edit text-primary" style="font-size: 1.2em"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="4">Not Found</td>
        </tr>
    @endif
@endsection

@section('customersUserContent')
    @if( $customers->isNotEmpty() )
        @foreach($customers as $customer)
            <tr>
                <td>
                    <a href="{{ url('/dashboard/user/'.$customer->id. '/edit') }}">{{ $customer->id }}</a>
                </td>
                <td class="font-weight-bold ">
                    <a href="{{ url('/dashboard/user/'.$customer->id. '/edit') }}">{{ $customer->name }} {{ !empty($customer->organization) ? '('.$customer->organization.')' : '' }}</a>
                </td>
                <td>
                    <strong>{{ $customer->tickets->count() }}</strong>
                </td>
                <td>
                    <strong>{{ $customer->getTotalAnsweredTickets() }}</strong>
                </td>
                <td>
                    <strong>{{ $customer->getTotalOpenedTickets() }}</strong>
                </td>
                <td>
                    <strong>{{ $customer->getTotalInProgressTickets() }}</strong>
                </td>
                <td>
                    <form action="{{ route('dashboard.user.deleteUser') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_id" value="{{ $customer->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                    <a href="{{ url('/dashboard/user/'.$customer->id.'/edit') }}" class="mx-1">
                        <i class="fas fa-edit text-primary" style="font-size: 1.2em"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="4">Not Found</td>
        </tr>
    @endif
@endsection

@section('supporterUserContent')
    @if( $supporters->isNotEmpty() )
        @foreach($supporters as $supporter)
            <tr>
                <td>
                    <a href="{{ url('/dashboard/user/'.$supporter->id. '/edit') }}">{{ $supporter->id }}</a>
                </td>
                <td class="font-weight-bold ">
                    <a href="{{ url('/dashboard/user/'.$supporter->id. '/edit') }}">{{ $supporter->name }}</a>
                </td>
                <td>
                    <strong>{{ $supporter->department->name }}</strong>
                </td>
                <td>
                    <form action="{{ route('deleteUser') }}" method="POST" class="mx-1 d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_id" value="{{ $supporter->id }}">
                        <button class="border-0 bg-white" type="submit">
                            <i class="fas fa-trash text-danger" style="font-size: 1.2em" data-toggle="tooltip" data-placement="left" title="Are you sure to delete this department?"></i>
                        </button>
                    </form>
                    <a href="{{ url('/dashboard/user/'.$supporter->id.'/edit') }}" class="mx-1">
                        <i class="fas fa-edit text-primary" style="font-size: 1.2em"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td class="text-center font-weight-bold py-5" colspan="4">Not Found</td>
        </tr>
    @endif
@endsection
