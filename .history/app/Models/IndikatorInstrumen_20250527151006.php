<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IndikatorInstrumen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'indikator_instrumens';
    protected $guarded = [];

    // Relasi many-to-many dengan UnitKerja (Prodi)
    public function prodis()
    {
        return $this->belongsToMany(UnitKerja::class, 'indikator_instrumen_prodi', 'indikator_instrumen_id', 'unit_kerja_id')
                    ->withTimestamps()
                    ->withPivot('deleted_at')
                    ->wherePivot('deleted_at', null);
    }

    /**
     * Get all of the kriterias for the IndikatorInstrumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kriterias(): HasMany
    {
        return $this->hasMany(IndikatorInstrumenKriteria::class, 'indikator_instrumen_id', 'id');
    }

    public function submission()
    {
        return $this->hasOne(InstrumenProdiSubmission::class);
    }
}
