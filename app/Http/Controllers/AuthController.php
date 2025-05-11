<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

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

        if (!$ticket) {
            toast()->error('Yah!', 'Kode tiket yang Anda berikan tidak valid.');
            return redirect()->back();
        }

        session([
            'ticket_id' => $ticket->id,
            'full_name' => $ticket->full_name
        ]);

        toast()->success('Login berhasil!', 'Selamat Datang!')->position('bottom-end');
        return redirect()->route('landing');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('landing');
    }
}
