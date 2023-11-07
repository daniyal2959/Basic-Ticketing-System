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
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.TicketStatuses.create', compact('ticketStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $ticketStatus = new TicketStatus();
        $ticketStatus->title = $request->title;
        $ticketStatus->name = $request->name;
        $ticketStatus->icon_name = $request->icon_name;
        $ticketStatus->icon_color = $request->icon_color;
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
        $ticketStatuses = TicketStatus::all();

        return view('Dashboard.TicketStatuses.create', compact('ticketStatus', 'ticketStatuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ticketStatus = TicketStatus::find($request->_id);
        $ticketStatus->title = $request->title;
        $ticketStatus->name = $request->name;
        $ticketStatus->icon_name = $request->icon_name;
        $ticketStatus->icon_color = $request->icon_color;
        $ticketStatus->save();

        return redirect()->route('dashboard.status.allTicketStatuses');
    }
}
