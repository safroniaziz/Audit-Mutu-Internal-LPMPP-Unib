<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodeAktifJadwal extends Model
{
    use HasFactory;

    protected $table = 'periode_aktif_jadwals';

    protected $fillable = [
        'periode_aktif_id',
        'waktu_mulai',
        'waktu_selesai',
        'jenis'
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function periodeAktif(): BelongsTo
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_aktif_id');
    }
}
