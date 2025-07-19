<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UnitKerja extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function indikatorKinerjas()
    {
        return $this->belongsToMany(IndikatorKinerja::class, 'rsb_prodis', 'unit_kerja_id', 'indikator_kinerja_id')
                    ->using(RsbProdi::class);
    }

    // Tambahkan relasi many-to-many dengan IndikatorInstrumen
    public function indikatorInstrumens()
    {
        return $this->belongsToMany(IndikatorInstrumen::class, 'indikator_instrumen_prodi', 'unit_kerja_id', 'indikator_instrumen_id')
                    ->withTimestamps()
                    ->withPivot('deleted_at')
                    ->wherePivot('deleted_at', null);
    }

    // Relasi dengan InstrumenProdi
    public function instrumenProdi()
    {
        return $this->hasMany(InstrumenProdi::class, 'unit_kerja_id');
    }

    // Relasi dengan PengajuanAmi
    public function pengajuanAmi()
    {
        return $this->hasMany(PengajuanAmi::class, 'unit_kerja_id');
    }
}
