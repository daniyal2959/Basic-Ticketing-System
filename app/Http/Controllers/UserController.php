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

    /**
     * Get all tickets with specific status
     *
     * @param TicketStatus|int|null $ticketStatus
     *
     */
    private function getTickets($ticketStatus = null){
        if ( !($ticketStatus instanceof TicketStatus) and !is_int($ticketStatus) and !is_null($ticketStatus) )
            throw new TypeError('The parameter must be instance of TicketStatus or integer number');

        /**
         * Get all tickets that refers to current user
         */
        if ( is_null($ticketStatus) )
            return Auth::user()->tickets()->paginate(7);

        /**
         * Get all tickets that refers to current user with chosen status
         */
        return Auth::user()->tickets()->where('TSID', is_int($ticketStatus) ? $ticketStatus : $ticketStatus->id)->paginate(7);
    }

    /**
     * Set all parameters that will be passed to view
     *
     * @return array
     */
    private function setParametersForView()
    {
        $parameter = [];
        $settings = Config::get('settings');

        $parameter['data'][] = [
            'title' => 'All Tickets',
            'icon' => 'ni ni-tag',
            'url' => route('dashboard.tickets.index'),
            'items' => $this->getTickets(),
        ];

        foreach ($settings['dashboard']['cards'] as $ticketStatusName){
            $ticketStatus = TicketStatus::where('name', $ticketStatusName)->first();

            $parameter['data'][$ticketStatusName] = [
                'title' => $ticketStatus->title,
                'icon' => $ticketStatus->icon_name,
                'background' => $ticketStatus->icon_background_color,
                'url' => route('statusArchive', ['status' => $ticketStatus->name]),
                'items' => $this->getTickets($ticketStatus->id),
                'asTable' => true
            ];
        }

        $parameter['data'][] = [
            'title' => 'Answered Rate',
            'icon' => 'ni ni-chart-bar-32',
            'count' => Ticket::rate($settings['tickets']['rate']) . '%'
        ];

        $parameter['colors'] = $settings['colors']['cards'];

        $parameter['tables'] = $settings['dashboard']['cards'];

        return $parameter;
    }

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
        $parameters = $this->setParametersForView();
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
        $chartResult = $this->chartValues(6);
        $parameters = $this->setParametersForView();
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.dashboard', compact('parameters','chartResult', 'ticketStatuses'));
    }

}

