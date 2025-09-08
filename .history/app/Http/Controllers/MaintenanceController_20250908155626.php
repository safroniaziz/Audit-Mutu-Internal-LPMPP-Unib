<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Menampilkan halaman maintenance
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('maintenance');
    }
}
