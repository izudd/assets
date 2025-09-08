<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

class KategoriController extends Controller
{
    // tampilkan semua kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategoris.index', compact('kategoris'));
    }

    // tampilkan detail kategori beserta asetnya
    public function show(Kategori $kategori)
{
    $assets = $kategori->assets; 
    return view('kategoris.show', compact('kategori', 'assets'));
}

}
