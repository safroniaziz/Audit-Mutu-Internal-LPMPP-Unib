<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IndikatorKinerja extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuanStandar(): BelongsTo
    {
        return $this->belongsTo(SatuanStandar::class, 'satuan_standar_id', 'id');
    }
}
