<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransConfig;
use App\Mail\ReservationMail;
use App\Mail\TicketNotification;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\ReservationMenu;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Midtrans\Snap;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentController extends Controller
{
    public function viewBuyTicket()
    {
        return view('pages.beli-tiket');
    }

    public function viewCheckoutTiket()
    {
        $snapToken = session('snapToken');
        $ticket = Ticket::find(session('ticket_id'));

        if (!$snapToken || !$ticket) {
            return redirect()->route('pay.buyTicket.view')->withErrors('Transaksi tidak valid.');
        }

        return view('pages.payment-tiket', compact('snapToken', 'ticket'));
    }

    public function buyTicket(Request $request)
    {
        MidtransConfig::init();

        $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'nullable|max:15',
            'email' => 'required|string|email',
            'visit_date' => 'required|date',
            'guest_count' => 'required|integer|min:1',
        ]);

        $total = $request->guest_count * 10000;

        $ticket = Ticket::create([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'visit_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->visit_date)->format('Y-m-d'),
            'guest_count' => $request->guest_count,
            'total_price' => $total
        ]);

        $ticket->ticket_code = Ticket::generateTicketCode($ticket);

        $ticket->save();

        $transactionDetails = [
            'order_id' => MidtransConfig::makeId(),
            'gross_amount' => $total,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $ticket,
        ];

        $snapToken = Snap::getSnapToken($transaction);

        session([
            'snapToken' => $snapToken,
            'ticket_id' => $ticket->id
        ]);

        return redirect()->route('pay.ticket-checkout.view');
    }

    public function checkoutTicket(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);

        $ticket = Ticket::find($requestData['ticket_id']);

        if (!$ticket) {
            return response()->json(['error' => 'Tiket tidak ditemukan.'], 404);
        }

        $ticket->status = 'confirmed';
        $ticket->save();

        Payment::create([
            'full_name' => $ticket->full_name,
            'phone_number' => $ticket->phone_number,
            'email' => $ticket->email,
            'payable_type' => \App\Models\Ticket::class,
            'payable_id' => $ticket->id,
            'gross_amount' => $ticket->total_price,
            'status' => 'paid',
            'payment_method' => $requestData['payment_method'],
            'order_id' => $requestData['order_id'],
        ]);

        Mail::to($ticket->email)->send(new TicketNotification($ticket));

        session()->forget(['snapToken', 'ticket_id']);
        session()->regenerate();

        return response()->json(['message' => 'Pembayaran berhasil. Silahkan cek email anda untuk mendapatkan kode.']);;
    }

    public function payReservation(Request $request)
    {
        try {
            $requestData = json_decode($request->getContent(), true);

            $ticketId = $requestData['ticketId'];

            $ticket = Ticket::with('carts')->find($ticketId);

            $total = $ticket->carts->sum(function ($cart) {
                return $cart->menu->price * $cart->quantity;
            }) + $ticket->total_price;

            $reservation = Reservation::create([
                'ticket_id' => $ticketId,
                'full_name' => $ticket->full_name,
                'phone_number' => $ticket->phone_number,
                'email' => $ticket->email,
                'reservation_date' => $ticket->visit_date,
                'guest_count' => $ticket->guest_count,
                'total_price' => $total,
                // 'status' => 'confirmed'
            ]);

            foreach ($ticket->carts as $cart) {
                ReservationMenu::create([
                    'reservation_id' => $reservation->id,
                    'menu_id' => $cart->menu_id,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->menu->price * $cart->quantity,
                ]);
            }

            $payment = Payment::create([
                'full_name' => $ticket->full_name,
                'phone_number' => $ticket->phone_number,
                'email' => $ticket->email,
                'payable_type' => \App\Models\Reservation::class,
                'payable_id' => $reservation->id,
                'gross_amount' => $total,
                'status' => 'paid',
                'payment_method' => $requestData['payment_method'],
                'order_id' => $requestData['order_id'],
            ]);

            $qrCodeData = QrCode::format('png')->size(300)->generate($ticket->ticket_code);

            Mail::send('emails.reservation-mail', [
                'ticketCode' => $ticket->ticket_code,
                'qrCodeData' => $qrCodeData,
                'reservation' => [
                    'full_name' => $ticket->full_name,
                    'visit_date' => $ticket->visit_date,
                    'guest_count' => $ticket->guest_count,
                ],
                'payment' => [
                    'payment_method' => $requestData['payment_method'],
                    'amount' => $total,
                    'order_id' => $requestData['order_id'],
                ],
            ], function ($message) use ($ticket) {
                $message->to($ticket->email)->subject('Tiket Reservasi');
            });


            session()->forget(['snapToken', 'ticket_id']);
            session()->regenerate();

            return response()->json([
                'message' => 'Reservasi berhasil.',
                'reservation_id' => $reservation->id
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Reservasi gagal: " . $e->getMessage(),
            ], 500);
        }
    }
}
