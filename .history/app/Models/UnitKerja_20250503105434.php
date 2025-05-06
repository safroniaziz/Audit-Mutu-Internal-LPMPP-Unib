<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UnitKerja extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function instrumenIkss()
    {
        return $this->belongsToMany(InstrumenIkss::class, 'rsb_prodi', 'unit_kerja_id', 'instrumen_ikss_id');
    }

}
