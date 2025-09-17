<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validator;

class ValidatorController extends Controller
{
    public function index()
    {
        return view('dashboard.validator');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'email' => 'required|email|unique:validators,email',
        ]);

        Validator::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data Validator berhasil disimpan, selamat datang!');
    }
}
