<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusUpdated;
use App\Helpers\MidtransConfig;
use App\Mail\TicketNotification;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Snap;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);

        $ticket = Ticket::where('ticket_code', $request->ticket_code)->first();

        if (!$ticket) return back()->withErrors(['ticket_code' => 'Kode tiket tidak valid.']);

        session(['ticket_id' => $ticket->id]);

        return redirect()->route('landing')->with('success', 'Login berhasil.');
    }

    
}
