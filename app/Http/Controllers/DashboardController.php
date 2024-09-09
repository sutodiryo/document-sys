<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $documents = 'd';
        $activities = 'a';
        return view('dashboard', compact('documents', 'activities'));

    }
}
