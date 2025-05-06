<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class InstrumenIkss extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indikatorKinerja(): BelongsTo
    {
        return $this->belongsTo(IndikatorKinerja::class, 'indikator_kinerja_id', 'id');
    }

    public function unitKerjas()
    {
        return $this->belongsToMany(UnitKerja::class, 'rsb_prodi', 'instrumen_ikss_id', 'unit_kerja_id')
                    ->using(RsbProdi::class);
    }
}
