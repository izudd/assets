<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    public function index()
    {
        return view('dashboard.guest');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
        ]);

        Guest::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data Guest berhasil disimpan, selamat datang!');
    }
}
