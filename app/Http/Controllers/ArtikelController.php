<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{

    public function show()
    {
        return view('pages.artikel');
    }

    public function showDetail()
    {
        return view('pages.detail-artikel');
    }
}
