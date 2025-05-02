<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IndikatorInstrumenKriteria extends Model
{
    use SoftDeletes, HasUuids;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indikatorInstrumen(): BelongsTo
    {
        return $this->belongsTo(IndikatorInstrumen::class, 'indikator_instrumen_id', 'id');
    }
}
