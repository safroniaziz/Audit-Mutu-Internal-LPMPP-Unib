<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
