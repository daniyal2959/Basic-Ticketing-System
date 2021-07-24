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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $tsOpen = 1;
    private $tsInProgress = 2;
    private $tsAnswered = 3;
    private $tsClosed = 4;

    private function chartValues($monthCount, $barChart = true){
        $nowMonth = Carbon::now()->month;
        $nowYear = Carbon::now()->year;
        $month = [];
        $year = [];
        $ticketCount = [];
        $result = [];

        for ($i = 0; $i<$monthCount; $i++){
            $month[] = $nowMonth;
            $year[] = $nowYear;

            if( $barChart ) {
                $ticketCount[] = Ticket::where([
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', $nowYear],
                    [DB::raw("DATE_FORMAT(created_at, '%c')"), '=', $nowMonth],
                    ['UID', '=', Auth::user()->id],
                ])->count();
            }
            else{
                $ticketCount[] = Ticket::where([
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), '=', $nowYear],
                    [DB::raw("DATE_FORMAT(created_at, '%c')"), '=', $nowMonth],
                    ['UID', '=', Auth::user()->id],
                    ['TSID', '<>', $this->tsAnswered],
                ])->count();
            }

            $nowMonth -= 1;
            if( $nowMonth <= 0 ){
                $nowMonth = 12;
                $nowYear -= 1;
            }
        }

        array_push($result, $month,$ticketCount);
        return $result;

    }

    private function showTickets($ticketStatusID){

        if(Auth::user()->UTID == 1) {

            if ($ticketStatusID == 0) {
                $tickets = Ticket::where('UID', '=', Auth::user()->id)->paginate(7);
            }
            else {
                $tickets = Ticket::where([
                    ['UID', '=', Auth::user()->id],
                    ['TSID', '=', $ticketStatusID]
                ])->paginate(7);
            }

            $tickets->isEmpty() ? $result = collect() : $result = $tickets;

            return $tickets;

        }

        elseif(Auth::user()->UTID == 2) {
            if ($ticketStatusID == 0) {
                $tickets = Ticket::where('DID', '=', Auth::user()->department->id)->paginate(7);
            }
            else {
                $tickets = Ticket::where([
                    ['DID', '=', Auth::user()->department->id],
                    ['TSID', '=', $ticketStatusID]
                ])->paginate(7);
            }

            $tickets->isEmpty() ? $result = collect() : $result = $tickets;

            return $tickets;
        }

        elseif(Auth::user()->UTID == 3) {
            if ($ticketStatusID == 0) {
                $tickets = Ticket::paginate(7);
            }
            else {
                $tickets = Ticket::where('TSID', '=', $ticketStatusID)->paginate(7);
            }

            $tickets->isEmpty() ? $result = collect() : $result = $tickets;

            return $tickets;
        }

        else{
            return collect();
        }
    }

    private function getTickets()
    {
        $allTickets = $this->showTickets(0);
        $openedTickets = $this->showTickets(1);
        $inProgressTickets = $this->showTickets(2);
        $answeredTickets = $this->showTickets(3);
        $closedTickets = $this->showTickets(4);

        $rateCount = $answeredTickets->count() + $closedTickets->count();
        $rateCount == 0 ? $allTicketCount = 1 : $allTicketCount = $rateCount;
        $rate = number_format(($rateCount / $allTicketCount) * 100,1);

        $result['allTickets'] = $allTickets;
        $result['open'] = $openedTickets;
        $result['inProgress'] = $inProgressTickets;
        $result['rate'] = $rate;

        return $result;
    }

    public function allUsers()
    {
        $users = User::with('department')->paginate(7);
        $customers = User::where('UTID', '=', 1)->paginate(7);
        $supporters = User::where('UTID', '=', 2)->paginate(7);
        return view('Dashboard.User.all', compact('users', 'customers', 'supporters'));
    }

    public function index()
    {
        $user = Auth::user();
        $result = $this->getTickets();
        return response(view('Dashboard.Profile.edit', compact('user', 'result')));
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
        return view('Dashboard.User.create', compact('userTypes', 'departments', 'result'));
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
        return view('Dashboard.User.create', compact('user', 'userTypes', 'departments', 'result'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->_id);
        $user->delete();
        return redirect()->route('allUsers');
    }

    public function dashboard()
    {
        $chartResult = $this->chartValues(6);
        $result = $this->getTickets();

        return view('Dashboard.dashboard', compact('result','chartResult'));
    }

}
