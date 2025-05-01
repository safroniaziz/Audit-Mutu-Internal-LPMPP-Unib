<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstrumenProdi extends Model
{
    use SoftDeletes, HasUuids;

    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

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
