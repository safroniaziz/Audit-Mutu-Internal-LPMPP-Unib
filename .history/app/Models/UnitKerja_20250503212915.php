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
        return $this->belongsToMany(InstrumenIkss::class, 'rsb_prodis', 'unit_kerja_id', 'indikator_kinerja_id')
                    ->using(RsbProdi::class);
    }
}
