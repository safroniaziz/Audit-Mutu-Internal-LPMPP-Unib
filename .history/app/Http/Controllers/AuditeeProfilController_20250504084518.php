<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditeeProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $completionPercentage = $user->getProfileCompletionPercentage();

        return view('auditee.dashboard', compact('user', 'completionPercentage'));
    }

}
