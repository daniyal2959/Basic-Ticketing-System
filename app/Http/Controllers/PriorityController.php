<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\TicketStatus;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        $priorities = Priority::paginate(7);
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.Priorities.all', compact('priorities', 'ticketStatuses'));
    }

    public function create()
    {
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.Priorities.create', compact('ticketStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $priorities = new Priority();
        $priorities->name = $request->name;
        $priorities->color = $request->color;
        $priorities->save();

        return back();
    }

    public function delete(Request $request)
    {
        $priority = Priority::find($request->_id);
        $priority->delete();

        return back();
    }

    public function edit(Priority $priority)
    {
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.Priorities.create', compact('priority', 'ticketStatuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $priority = Priority::find($request->_id);
        $priority->name = $request->name;
        $priority->color = $request->color;
        $priority->save();

        return redirect()->route('dashboard.priorities.allPriorities');

    }
}
