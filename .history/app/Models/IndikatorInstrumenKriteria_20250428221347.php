<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorInstrumenKriteria extends Model
{
    /**
     * Get the user that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
