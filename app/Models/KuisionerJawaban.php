<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KuisionerJawaban extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(PengajuanAmi::class,'pengajuan_ami_id','id');
    }

    /**
     * Get the kuisioner that owns the jawaban.
     */
    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(Kuisioner::class, 'kuisioner_id','id');
    }

    /**
     * Get the opsi that was chosen.
     */
    public function opsi(): BelongsTo
    {
        return $this->belongsTo(KuisionerOpsi::class, 'kuisioner_opsi_id');
    }

    /**
     * Get the penugasan that owns the KuisionerJawaban
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penugasan(): BelongsTo
    {
        return $this->belongsTo(PenugasanAuditor::class, 'penugasan_auditor_id', 'id');
    }
}
