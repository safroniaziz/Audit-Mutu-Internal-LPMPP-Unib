<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndikatorInstrumenKriteria extends Model
{
    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indikatorInstrumen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
