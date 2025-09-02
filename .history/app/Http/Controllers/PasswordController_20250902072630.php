<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Show the password change form for auditee
     */
    public function showAuditeeForm()
    {
        return view('auditee.ubah-password');
    }

    /**
     * Show the password change form for auditor
     */
    public function showAuditorForm()
    {
        return view('auditor.ubah-password');
    }

    /**
     * Update password for auditee
     */
    public function updateAuditeePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(6)],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'current_password.current_password' => 'Password saat ini tidak sesuai',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
        ]);

        $user = Auth::user();
        
        // Log untuk debugging
        \Log::info('Updating password for user: ' . $user->id . ' - ' . $user->email);
        
        // Update password menggunakan DB facade
        $updated = DB::table('users')
            ->where('id', $user->id)
            ->update(['password' => Hash::make($request->new_password)]);
        
        if ($updated) {
            \Log::info('Password updated successfully for user: ' . $user->id);
            
            // Logout user dan clear session
            Auth::logout();
            Session::flush();
            
            \Log::info('User logged out and session cleared for user: ' . $user->id);
            
            // Return JSON response untuk testing
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password berhasil diubah! Silakan login dengan password baru Anda.',
                    'redirect' => route('login')
                ]);
            }
            
            // Redirect ke login dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
        } else {
            \Log::error('Failed to update password for user: ' . $user->id);
            return redirect()->back()
                ->with('error', 'Gagal mengupdate password. Silakan coba lagi.');
        }
    }

    /**
     * Update password for auditor
     */
    public function updateAuditorPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(6)],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'current_password.current_password' => 'Password saat ini tidak sesuai',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
        ]);

        $user = Auth::user();

        // Update password
        DB::table('users')
            ->where('id', $user->id)
            ->update(['password' => Hash::make($request->new_password)]);

        // Logout user dan clear session
        Auth::logout();
        Session::flush();

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
    }
}
