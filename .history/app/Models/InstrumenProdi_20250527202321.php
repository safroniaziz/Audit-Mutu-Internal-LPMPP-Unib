<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class InstrumenProdi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kriteriaInstrumen(): BelongsTo
    {
        return $this->belongsTo(IndikatorInstrumenKriteria::class, 'indikator_instrumen_kriteria_id', 'id');
    }

    /**
     * Get the submission associated with the InstrumenProdi through its kriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function submission()
    {
        return $this->hasOneThrough(
            InstrumenProdiSubmission::class,
            IndikatorInstrumenKriteria::class,
            'id', // Foreign key on IndikatorInstrumenKriteria table...
            'indikator_instrumen_id', // Foreign key on InstrumenProdiSubmission table...
            'indikator_instrumen_kriteria_id', // Local key on InstrumenProdi table...
            'indikator_instrumen_id' // Local key on IndikatorInstrumenKriteria table...
        );
    }
}
