<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisionerJawaban extends Model
{
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /**
     * Get the kuisioner that owns the jawaban.
     */
    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(Kuisioner::class);
    }

    /**
     * Get the opsi that was chosen.
     */
    public function opsi(): BelongsTo
    {
        return $this->belongsTo(KuisionerOpsi::class, 'kuisioner_opsi_id');
    }
}
