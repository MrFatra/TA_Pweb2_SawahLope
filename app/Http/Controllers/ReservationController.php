<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransConfig;
use App\Models\Cart;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Midtrans\Snap;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function viewReservation(Request $request)
    {
        MidtransConfig::init();

        $ticketId = session('ticket_id');

        if (!$ticketId) {
            toast()->error('Peringatan', 'Anda belum memesan makanan');
            return redirect()->back();
        }

        $ticket = Ticket::find($ticketId);

        $cartItems = Cart::with('menu')->where('ticket_id', $ticketId)->get();

        $total = $cartItems->sum(function ($cart) {
            return $cart->menu->price * $cart->quantity;
        }) + $ticket->total_price;

        $transactionDetails = [
            'order_id' => MidtransConfig::makeId(),
            'gross_amount' => $total,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $ticket,
        ];

        $snapToken = Snap::getSnapToken($transaction);

        session(['snapToken' => $snapToken]);

        return view('pages.reservasi', compact('ticket', 'cartItems'));
    }
}
