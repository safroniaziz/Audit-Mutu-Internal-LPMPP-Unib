<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        // Debug: Cek apakah method ini terpanggil
        dd([
            'method_called' => 'updateAuditeePassword',
            'user_id' => Auth::id(),
            'request_method' => $request->method(),
            'request_data' => $request->all()
        ]);
        
        // Validasi manual current password dulu
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password saat ini tidak benar!')
                ->withInput();
        }

        $request->validate([
            'new_password' => ['required', 'confirmed', Password::min(6)],
            'new_password_confirmation' => ['required'],
        ], [
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
        ]);

        // Update password menggunakan DB facade
        $saved = DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now()
            ]);

        if ($saved) {
            // Logout user dan clear session
            Auth::logout();
            Session::flush();
            Session::regenerate();

            // Redirect ke login dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate password. Silakan coba lagi.');
        }
    }

    /**
     * Update password for auditor
     */
        public function updateAuditorPassword(Request $request)
    {
        // Validasi manual current password dulu
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password saat ini tidak benar!')
                ->withInput();
        }

        $request->validate([
            'new_password' => ['required', 'confirmed', Password::min(6)],
            'new_password_confirmation' => ['required'],
        ], [
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
        ]);

        // Update password menggunakan DB facade
        $saved = DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now()
            ]);

        if ($saved) {
            // Logout user dan clear session
            Auth::logout();
            Session::flush();
            Session::regenerate();

            // Redirect ke login dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate password. Silakan coba lagi.');
        }
    }
}
