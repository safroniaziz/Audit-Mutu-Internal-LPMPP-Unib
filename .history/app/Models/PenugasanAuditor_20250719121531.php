<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenugasanAuditor extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the pengajuanAmi that owns the PenugasanAuditor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengajuanAmi(): BelongsTo

    {
        return $this->belongsTo(PengajuanAmi::class, 'pengajuan_ami_id', 'id');
    }

    /**
     * Get the auditor that owns the PenugasanAuditor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Check if auditor has completed all stages
     */
    public function isCompleted(): bool
    {
        return $this->is_setuju && $this->is_setuju_visitasi && $this->is_setuju_indikator_prodi;
    }

    /**
     * Check if auditor has started any stage
     */
    public function hasStarted(): bool
    {
        return $this->is_setuju || $this->is_setuju_visitasi || $this->is_setuju_indikator_prodi;
    }
}
