<?php

namespace App\Http\Controllers;

use App\Models\TicketStatus;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    public function index()
    {
        $ticketStatuses = TicketStatus::paginate(7);
        return view('Dashboard.TicketStatuses.all', compact('ticketStatuses'));
    }

    public function create()
    {
        return view('Dashboard.TicketStatuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $ticketStatus = new TicketStatus();
        $ticketStatus->name = $request->name;
        $ticketStatus->save();

        return back();
    }

    public function delete(Request $request)
    {
        $ticketStatus = TicketStatus::find($request->_id);
        $ticketStatus->delete();

        return back();
    }

    public function edit(TicketStatus $ticketStatus)
    {
        return view('Dashboard.TicketStatuses.create', compact('ticketStatus'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ticketStatus = TicketStatus::find($request->_id);
        $ticketStatus->name = $request->name;
        $ticketStatus->save();

        return redirect()->route('allTicketStatuses');
    }
}
