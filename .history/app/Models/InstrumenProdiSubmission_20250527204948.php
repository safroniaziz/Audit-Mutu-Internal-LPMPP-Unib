<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumenProdiSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'instrumen_prodi_id',
        'unit_kerja_id',
        'nilai',
        'deskripsi'
    ];

    public function instrumenProdi()
    {
        return $this->belongsTo(InstrumenProdi::class);
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
