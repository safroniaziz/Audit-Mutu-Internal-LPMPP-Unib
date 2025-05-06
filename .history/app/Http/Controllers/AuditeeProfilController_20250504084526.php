<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditeeProfilController extends Controller
{
    public function index()
    {
        $completionPercentage = $user->getProfileCompletionPercentage();

        return view('auditee.dashboard', compact('user', 'completionPercentage'));
    }

}
