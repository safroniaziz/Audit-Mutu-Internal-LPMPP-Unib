<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getProfileCompletionPercentage()
{
    $fields = [
        'name',
        'username',
        'email',
    ];

    // Cek apakah relasi unitKerja ada
    if ($this->unitKerja) {
        $unitKerjaFields = [
            'kode_unit_kerja',
            'nama_unit_kerja',
            'jenis_unit_kerja',
            'nama_ketua',
            'nip_ketua',
            'website',
            'no_hp',
        ];

        $fields = array_merge($fields, array_map(fn($f) => "unitKerja.$f", $unitKerjaFields));

        // Jika unit kerjanya prodi, tambahkan jenjang & nama fakultas
        if ($this->unitKerja->jenis_unit_kerja === 'prodi') {
            $prodiFields = [
                'jenjang',
                'nama_fakultas',
            ];
            $fields = array_merge($fields, array_map(fn($f) => "unitKerja.$f", $prodiFields));
        }
    }

    $filledFields = 0;

    foreach ($fields as $field) {
        // Cek apakah field bersifat relasi (mengandung ".")
        if (str_contains($field, '.')) {
            [$relation, $key] = explode('.', $field);
            if (!empty($this->$relation?->$key)) {
                $filledFields++;
            }
        } else {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }
    }

    return round(($filledFields / count($fields)) * 100);
}


    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id', 'id');
    }
}
