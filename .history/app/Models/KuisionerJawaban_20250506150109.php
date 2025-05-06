<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KuisionerJawaban extends Model
{
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanAmi::class);
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
