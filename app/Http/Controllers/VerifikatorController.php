<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verifikator;

class VerifikatorController extends Controller
{
    public function index()
    {
        return view('dashboard.verifikator');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'email' => 'required|email|unique:verifikators,email',
        ]);

        Verifikator::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan, selamat datang!');
    }
}
