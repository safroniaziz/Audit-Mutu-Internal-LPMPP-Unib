<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeAktif extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $timestamps = true;

    /**
     * Get all of the jadwal for the PeriodeAktif
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(PeriodeAktifJadwal::class, 'periode_aktif_id', 'id');
    }

    // Relasi dengan PengajuanAmi
    public function pengajuanAmi(): HasMany
    {
        return $this->hasMany(PengajuanAmi::class, 'periode_id', 'id');
    }

    // Relasi dengan Evaluasi
    public function evaluasi(): HasMany
    {
        return $this->hasMany(Evaluasi::class, 'periode_aktif_id', 'id');
    }
}
