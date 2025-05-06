<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodeAktifJadwal extends Model
{

    protected $guarded = [];

    public $timestamps = true;

    /**
     * Get the usperiodeAktifhat owns the PeriodeAktifJadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodeAktif(): BelongsTo
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_aktif_id', 'id');
    }
}
