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

        try {
            $user = Auth::user();
            
            // Debug: lihat user yang sedang login
            dd('User ID: ' . $user->id, 'Email: ' . $user->email, 'Request new password: ' . $request->new_password);
            
            // Update password menggunakan DB facade untuk memastikan update berhasil
            $updated = DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($request->new_password)]);
            
            if (!$updated) {
                throw new \Exception('Gagal mengupdate password');
            }
            
            // Logout user dan clear session
            Auth::logout();
            Session::flush();
            
            // Redirect ke login dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
