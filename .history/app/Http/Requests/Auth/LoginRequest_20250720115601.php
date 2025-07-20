<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
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

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Validasi periode aktif setelah login berhasil (kecuali admin)
        $this->validatePeriodeAktif();

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Validate if current time is within active period login schedule
     * Admin is exempted from this restriction
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validatePeriodeAktif(): void
    {
        // Cek apakah user yang login adalah admin
        $user = \App\Models\User::where('email', $this->email)->first();

        // Jika user adalah admin, skip validasi periode
        if ($user && $user->hasRole('Administrator')) {
            return;
        }

        // Get active period (deleted_at is null)
        $periodeAktif = \App\Models\PeriodeAktif::whereNull('deleted_at')->first();

        if (!$periodeAktif) {
            throw ValidationException::withMessages([
                'email' => 'Tidak ada periode aktif yang tersedia saat ini.',
            ]);
        }

        // Get login schedule for this period
        $loginJadwal = \App\Models\PeriodeAktifJadwal::where('periode_aktif_id', $periodeAktif->id)
            ->where('jenis', 'login')
            ->first();

        if (!$loginJadwal) {
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
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }

    public function getRedirectRoute()
    {
        // Cari user berdasarkan email yang diinput
        $user = \App\Models\User::where('email', $this->email)->first();
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
