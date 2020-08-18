<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketConversationController extends Controller
{
    // ticket converstion view pages
    public function create($slug=null)
    {
        $active_tickets = Ticket::with('ticket_conversation')->where('status', '!=', 'complete')->orderBy('id', 'desc')->get();
        $get_ticket = Ticket::where('slug', $slug)->first();
        
        return  view('common.ticket-conversation')->with(compact('active_tickets','get_ticket'));
    }

    //ticket conversation insert
    public function store(Request $request)
    {
        $get_ticket = Ticket::where('id', $request->ticket_id)->first();
        $conversation = [
            'ticket_id' => $get_ticket->id,
            'from_user' => Auth::id(),
            'to_user' => ($get_ticket->user_id != Auth::id() ? $get_ticket->user_id : null),
            'conversation' => $request->conversation,
            'ticket_date' => now()
        ];
        TicketConversation::create($conversation);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function show(TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketConversation $ticketConversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketConversation  $ticketConversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketConversation $ticketConversation)
    {
        //
    }
}
