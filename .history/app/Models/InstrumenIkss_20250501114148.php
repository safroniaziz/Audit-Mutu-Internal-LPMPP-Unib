<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstrumenIkss extends Model
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
    public function satuanStandar(): BelongsTo
    {
        return $this->belongsTo(SatuanStandar::class, 'satuan_standar_id', 'id');
    }
}
