<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $validators = \App\Models\Validator::all();
        $verifikators = \App\Models\Verifikator::all();
        $guests       = \App\Models\Guest::all();

        return view('teams.index', compact('validators', 'verifikators', 'guests'));
    }
}
