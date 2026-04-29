<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResetApprovalRequest extends Model
{
    protected $fillable = [
        'penugasan_auditor_id',
        'tahap',
        'alasan',
        'status',
        'approved_by',
        'approved_at',
        'catatan_admin',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function penugasanAuditor(): BelongsTo
    {
        return $this->belongsTo(PenugasanAuditor::class);
    }

    public function approvedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get human-readable tahap label
     */
    public function getTahapLabelAttribute(): string
    {
        return match($this->tahap) {
            'desk_evaluation' => 'Desk Evaluation',
            'instrumen_prodi' => 'Penilaian Instrumen Prodi',
            'visitasi' => 'Visitasi',
            default => $this->tahap,
        };
    }

    /**
     * Get the corresponding approval flag column name
     */
    public function getApprovalFlagColumn(): string
    {
        return match($this->tahap) {
            'desk_evaluation' => 'is_setuju',
            'instrumen_prodi' => 'is_setuju_indikator_prodi',
            'visitasi' => 'is_setuju_visitasi',
        };
    }

    /**
     * Scope for pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
