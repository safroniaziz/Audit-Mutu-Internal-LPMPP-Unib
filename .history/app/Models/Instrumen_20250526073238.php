<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumen extends Model
{
    use HasFactory;

    protected $table = 'instrumens';
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
