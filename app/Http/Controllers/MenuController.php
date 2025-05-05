<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function viewList() {
        $menus = Menu::all();

        return view('pages.list-menu');
    }
}
