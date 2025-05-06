<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenugasanAuditor extends Model
{
    /**
     * Get the user that owns the PenugasanAuditor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
