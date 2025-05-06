<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IndikatorKinerja extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuanStandar(): BelongsTo
    {
        return $this->belongsTo(SatuanStandar::class, 'satuan_standar_id', 'id');
    }

    public function unitKerjas()
    {
        return $this->belongsToMany(UnitKerja::class, 'rsb_prodis', 'indikator_kinerja_id', 'unit_kerja_id')
                    ->using(RsbProdi::class);
    }

    /**
     * Get all of the instrumen for the IndikatorKinerja
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instrumen(): HasMany
    {
        return $this->hasMany(InstrumenIkss::class, 'indikator_kinerja_id', 'local_key');
    }
}
