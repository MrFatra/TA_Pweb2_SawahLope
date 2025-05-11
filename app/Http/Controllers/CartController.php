<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticketId = session('ticket_id');

        if (!$ticketId) {
            return redirect()->route('auth.login.view')->withErrors('Silahkan login terlebih dahulu.');
        }

        $cartItem = Cart::where('ticket_id', $ticketId)
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'ticket_id' => $ticketId,
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $ticketId = session('ticket_id');

        $cartItem = Cart::where('id', $id)->where('ticket_id', $ticketId)->first();

        if (!$cartItem) return redirect()->back()->withErrors('Item tidak ditemukan.');
        
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }
}
