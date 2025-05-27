<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SatuanStandar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'satuan_standars';
    protected $guarded = [];

    public function indikatorKinerjas()
    {
        return $this->hasMany(IndikatorKinerja::class);
    }
}
