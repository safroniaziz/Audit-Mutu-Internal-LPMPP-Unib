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
        return $this->belongsTo(User::class, 'auditor_id', 'id');
    }
}
