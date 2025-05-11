<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\Ticket;
use Usernotnull\Toast\Concerns\WireToast;

class MenuController extends Controller
{
    public function viewList()
    {
        $menus = FoodCategory::with('menus')->get();

        $ticketId = session('ticket_id');

        $carts = [];

        if ($ticketId) {
            $carts = Ticket::find($ticketId)?->carts()->with('menu')->get() ?? collect();
        }

        return view('pages.list-menu', compact('menus', 'carts'));
    }
}
