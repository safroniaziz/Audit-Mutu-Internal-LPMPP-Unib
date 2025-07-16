<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluasiSubmission extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class);
    }

    public function pengajuanAmi()
    {
        return $this->belongsTo(PengajuanAmi::class);
    }
}
