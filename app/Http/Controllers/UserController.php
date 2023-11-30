<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TypeError;

class UserController extends Controller
{
    public function allUsers()
    {
        $users = User::with('department')->paginate(7);
        $customers = User::where('UTID', '=', 1)->paginate(7);
        $supporters = User::where('UTID', '=', 2)->paginate(7);
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.User.all', compact('users', 'customers', 'supporters', 'ticketStatuses'));
    }

    public function index()
    {
        $user = Auth::user();
        $parameters = setParametersForView();
        $ticketStatuses = TicketStatus::all();

        return response(view('Dashboard.Profile.edit', compact('user', 'parameters', 'ticketStatuses')));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'=>'email',
            'organization'=> 'min:6|nullable',
            'address'=>'min:6|nullable',
            'city'=> 'string|nullable',
            'province'=>'string|nullable',
            'postal_code'=>'nullable|integer'
        ]);

        if($request->_id != 0){
            $user = User::find($request->_id);
        }
        else{
            $user = User::find(Auth::user()->id);
        }


        if(!Hash::check($request->password, $user->password) and !empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->organization = $request->organization;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->postal_code = $request->postal_code;
        $user->save();

        return back();
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login');
    }

    public function create()
    {
        $result = collect();
        $userTypes = UserType::all();
        $departments = Department::all();
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.User.create', compact('userTypes', 'departments', 'result', 'ticketStatuses'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $userType = UserType::find($request->userType);

        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->organization = $request->organization;
        $user->address = $request->address;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->UTID = $userType->id;
        if(!empty($request->department)){
            $department = Department::find($request->department);
            $user->DID = $department->id;
        }
        $user->save();

        return back();

    }

    public function edit(User $user)
    {
        $result = $this->getTickets();
        $userTypes = UserType::all();
        $departments = Department::all();
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.User.create', compact('user', 'userTypes', 'departments', 'result', 'ticketStatuses'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->_id);
        $user->delete();
        return redirect()->route('dashboard.users.allUsers');
    }

    public function dashboard()
    {
        $chartResult = chartValues(6);
        $parameters = setParametersForView();
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.dashboard', compact('parameters','chartResult', 'ticketStatuses'));
    }

}

