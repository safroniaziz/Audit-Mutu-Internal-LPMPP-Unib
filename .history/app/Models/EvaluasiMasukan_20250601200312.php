<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluasiMasukan extends Model
{
    use SoftDeletes;

    protected $table = 'evaluasi_masukans';
    protected $guarded = [];

    public function pengajuanAmi()
    {
        return $this->belongsTo(PengajuanAmi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
