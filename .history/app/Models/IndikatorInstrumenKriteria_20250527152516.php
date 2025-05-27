<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IndikatorInstrumenKriteria extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indikatorInstrumen(): BelongsTo
    {
        return $this->belongsTo(IndikatorInstrumen::class, 'indikator_instrumen_id', 'id');
    }

    /**
     * Get all of the indstrumenProdi for the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instrumenProdi(): HasMany
    {
        return $this->hasMany(InstrumenProdi::class, 'indikator_instrumen_kriteria_id', 'id');
    }
}
