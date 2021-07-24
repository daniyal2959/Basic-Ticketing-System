<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Message;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = $this->showTickets(0);
        return response(view('Dashboard.Tickets.all', compact('tickets')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = collect();
        $departments = Department::all();
        $priorities = Priority::all();
        return response(view('Dashboard.Tickets.new', compact('ticket','departments', 'priorities')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $tickets = new Ticket();
        $tsid     = TicketStatus::find(1); // 1:Open - 2:In Progress - 3:Answered - 4:Closed
        $did      = Department::find($request->department);
        $uid      = User::find(Auth::user()->id);
        $pid      = Priority::find($request->priority); // 1:High - 2: Medium, 3:Low

        $tickets->title       = $request->title;
        $tickets->TSID        = $tsid->id;
        $tickets->DID         = $did->id;
        $tickets->UID         = $uid->id;
        $tickets->PID         = $pid->id;
        $tickets->save();

        $message = new Message();
        $message->message = $request->message;
        $message->TID = $tickets->id;
        $message->UID = Auth::user()->id;
        $message->save();

        return redirect()->route('create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $departments = Department::all();
        $priorities = Priority::all();
        if(Auth::user()->UTID != 1) {
            $ticketStatuses = TicketStatus::all();
        }
        else{
            $ticketStatuses = collect();
        }
        $messages = Message::with('ticket')->with('user')->where('TID', '=', $ticket->id)->get();
        $ticket = Ticket::with('user')->find($ticket->id);
        return response(view('Dashboard.Tickets.show', compact('departments', 'priorities', 'messages', 'ticket', 'ticketStatuses')));
    }

    public function search(Request $request)
    {
        $ticket = $request->get('query');
        return redirect('/dashboard/tickets/'.$ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $departments = Department::all();
        $priorities = Priority::all();
        return response(view('Dashboard.Tickets.new', compact('ticket', 'departments', 'priorities')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     */
    public function update(Request $request, Ticket $ticket)
    {
        $priority = Priority::find($request->priority);
        $department = Department::find($request->department);
        if(Auth::user()->UTID != 1) {
            $ticketStatus = TicketStatus::find($request->ticketStatus);
            $ticket->TSID = $ticketStatus->id;
        }
        $ticket->title = $request->title;
        $ticket->PID = $priority->id;
        $ticket->DID = $department->id;
        $ticket->save();

        return back();
    }

    public function delete(Request $request)
    {
        $ticket = Ticket::find($request->_id);
        $ticket->delete();

        return back();
    }

    public function close(Request $request)
    {
        $ticket = Ticket::find($request->_id);
        $ticketStatus = TicketStatus::find(4);
        $ticket->TSID = $ticketStatus->id;
        $ticket->save();

        return back();
    }

    /**
     * Display Opened Tickets
     *
     * @return \Illuminate\Http\Response
     */
    public function opened()
    {
        $tickets = $this->showTickets(1);
        return response(view('Dashboard.Tickets.opened', compact('tickets')));
    }

    /**
     * Display In Progress Tickets
     *
     * @return \Illuminate\Http\Response
     */
    public function inProgress()
    {
        $tickets = $this->showTickets(2);
        return response(view('Dashboard.Tickets.inProgress', compact('tickets')));
    }

    /**
     * Display Answered Tickets
     *
     * @return \Illuminate\Http\Response
     */
    public function answered()
    {
        $tickets = $this->showTickets(3);
        return response(view('Dashboard.Tickets.answered', compact('tickets')));
    }

    /**
     * Display Closed Tickets
     *
     * @return \Illuminate\Http\Response
     */
    public function closed()
    {
        $tickets = $this->showTickets(4);
        return response(view('Dashboard.Tickets.closed', compact('tickets')));
    }
}
