<?php

namespace App\Http\Controllers;

use App\Models\Term;

class HomeController extends Controller
{
    public function index()
    {
        $termos = Term::orderBy('name')->get(['id','name']);
        return view('home', compact('termos')); // sua blade principal
    }
}
