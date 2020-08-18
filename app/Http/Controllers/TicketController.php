<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketConversation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'desc');
        if(Auth::user()->role_id == 2){
            $tickets = $tickets->where('user_id', Auth::id());
        }
        $tickets = $tickets->get();
        if(Auth::user()->role_id == 2){
            return view('users.ticket-list')->with(compact('tickets'));
        }
        return view('admin.ticket-list')->with(compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.ticket-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $data = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $this->createSlug($request->title),
            'ticket_details' => $request->ticket_details
        ];
        $store = Ticket::create($data);
        if($store){
            if($request->ticket_details != null){
                $conversation = [
                    'ticket_id' => $store->id,
                    'from_user' => Auth::id(),
                    'conversation' => $request->ticket_details,
                    'ticket_date' => now()
                ];
                TicketConversation::create($conversation);
            }
            Toastr::success('Ticket send successfully.');
        }else{
            Toastr::error('Ticket cannot send.!');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
    public function createSlug($slug=null)
    {
        //$slug = Str::slug($slug);
        $slug = strTolower(preg_replace('/[\s-]+/', '-', trim($slug)));
        $slug = (preg_replace('/[?.]+/', '', $slug));
        $check_slug = Ticket::select('slug')->where('slug', 'like', $slug.'%')->get();

        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_slug); $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains('slug', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }
}
