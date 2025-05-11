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
            toast()->error('Yah!', 'Kode tiket yang Anda miliki tidak valid.');
            return redirect()->route('auth.login.view')->withErrors('Silahkan login terlebih dahulu.');
        }

        $cartItem = Cart::where('ticket_id', $ticketId)
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
            $menuName = $cartItem->menu->name;
        } else {
            $cartItem = Cart::create([
                'ticket_id' => $ticketId,
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
            ]);
            $menuName = $cartItem->menu->name;
        }

        toast()->success('Item ditambahkan!', "$menuName berhasil ditambahkan ke keranjang.");
        return redirect()->back();
    }

    public function removeFromCart($id)
    {
        $ticketId = session('ticket_id');

        $cartItem = Cart::where('id', $id)->where('ticket_id', $ticketId)->first();

        if (!$cartItem) {
            toast()->error('Yah!', 'Item tidak tersebut tidak ditemukan 😓.');
            return redirect()->back();
        }

        $menuName = $cartItem->menu->name;

        $cartItem->delete();
        
        toast()->success("Berhasil dihapus!", "$menuName berhasil dihapus dari keranjang.");

        return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }
}
