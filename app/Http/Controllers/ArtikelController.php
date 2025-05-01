<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function show()
    {
        // $artikel = Artikel::findOrFail($id);

        return view('pages.artikel');
    }
}
