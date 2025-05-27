<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumenProdiSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'indikator_instrumen_id',
        'unit_kerja_id',
        'nilai',
        'deskripsi'
    ];

    public function indikatorInstrumen()
    {
        return $this->belongsTo(IndikatorInstrumen::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenInstrumenProdi::class, 'submission_id');
    }
}
