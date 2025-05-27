<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrumen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'instrumen_iksses';
    protected $guarded = [];

    public function indikatorKinerja()
    {
        return $this->belongsTo(IndikatorKinerja::class, 'indikator_kinerja_id');
    }

    public function ikssAuditee()
    {
        return $this->hasMany(IkssAuditee::class);
    }
}
