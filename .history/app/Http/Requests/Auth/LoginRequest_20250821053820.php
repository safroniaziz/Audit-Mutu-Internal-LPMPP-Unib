<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use App\Models\User;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'], // Bisa username atau email
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Coba login dengan username atau email
        $loginField = $this->input('login');
        $password = $this->input('password');

        // Cek apakah input adalah email atau username
        $isEmail = filter_var($loginField, FILTER_VALIDATE_EMAIL);
        
        if ($isEmail) {
            // Jika email, gunakan email untuk login
            if (!Auth::attempt(['email' => $loginField, 'password' => $password], $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'login' => trans('auth.failed'),
                ]);
            }
        } else {
            // Jika bukan email, coba dengan username
            if (!Auth::attempt(['username' => $loginField, 'password' => $password], $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'login' => trans('auth.failed'),
                ]);
            }
        }

        // Validasi periode aktif setelah login berhasil (kecuali admin)
        $this->validatePeriodeAktif();

        RateLimiter::clear($this->throttleKey());
    }

                /**
     * Check if user is admin
     */
    private function isUserAdmin($user): bool
    {
        if (!$user) return false;

        return DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $user->id)
            ->where('roles.name', 'Administrator')
            ->exists();
    }

    /**
     * Validate if current time is within active period login schedule
     * Admin is exempted from this restriction
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validatePeriodeAktif(): void
    {
        // Cek apakah user yang sudah login adalah admin
        $user = Auth::user();

        // Jika user adalah admin, skip semua validasi
        if ($this->isUserAdmin($user)) {
            return;
        }

        // Get active period (deleted_at is null)
        $periodeAktif = \App\Models\PeriodeAktif::whereNull('deleted_at')->first();

        if (!$periodeAktif) {
            // Logout user non-admin karena tidak ada periode aktif
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Tidak ada periode aktif yang tersedia saat ini.',
            ]);
        }

        // Get login schedule for this period
        $loginJadwal = \App\Models\PeriodeAktifJadwal::where('periode_aktif_id', $periodeAktif->id)
            ->where('jenis', 'login')
            ->first();

        if (!$loginJadwal) {
            // Logout user non-admin karena tidak ada jadwal login
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Jadwal login untuk periode ini belum ditentukan.',
            ]);
        }

        // Get current datetime
        $now = now();

        // Check if current time is within login schedule
        if ($now < $loginJadwal->waktu_mulai || $now > $loginJadwal->waktu_selesai) {
            $mulai = $loginJadwal->waktu_mulai->format('d/m/Y H:i');
            $selesai = $loginJadwal->waktu_selesai->format('d/m/Y H:i');

            // Logout user karena di luar jadwal
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => "Login hanya tersedia pada periode: {$mulai} - {$selesai}",
            ]);
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')).'|'.$this->ip());
    }

    public function getRedirectRoute()
    {
        // Cari user berdasarkan login (username atau email) yang diinput
        $loginField = $this->input('login');
        $isEmail = filter_var($loginField, FILTER_VALIDATE_EMAIL);
        
        if ($isEmail) {
            $user = \App\Models\User::where('email', $loginField)->first();
        } else {
            $user = \App\Models\User::where('username', $loginField)->first();
        }
        
        if (!$user) {
            return 'dashboard';
        }

        // Cek role menggunakan Spatie Permission
        if ($user->hasRole('Administrator')) {
            return 'dashboard';
        } elseif ($user->hasRole('Auditee')) {
            return 'auditee.dashboard';
        } elseif ($user->hasRole('Auditor')) {
            return 'auditor.dashboard';
        }

        return 'dashboard';
    }
}
