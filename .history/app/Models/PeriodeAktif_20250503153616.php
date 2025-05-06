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
        return $this->hasMany(PeriodeAktifJadwal::class, 'periode_aktif_id', 'local_key');
    }
}
