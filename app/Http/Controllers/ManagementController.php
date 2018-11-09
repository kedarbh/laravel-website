<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index() {
        return redirect()->route('management.dashboard');
    }

    public function dashboard() {
        return view('management.dashboard');
    }
}
