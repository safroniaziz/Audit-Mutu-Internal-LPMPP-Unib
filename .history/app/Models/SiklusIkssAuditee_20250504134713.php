<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiklusIkssAuditee extends Model
{
    /**
     * Get the user that owns the SiklusIkssAuditee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
