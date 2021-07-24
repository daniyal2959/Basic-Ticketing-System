<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request, $ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        if(Auth::user()->UTID != 1){
            $ticketStatus = TicketStatus::find(3); # 3: Answered
            $ticket->TSID = $ticketStatus->id;
            $ticket->save();
        }
        $messgae = new Message();
        $messgae->message = $request->message;
        $messgae->TID = $ticket->id;
        $messgae->UID = Auth::user()->id;
        $messgae->save();

        return redirect('/dashboard/tickets/'.$ticket_id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
