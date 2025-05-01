<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
    public function indikatorKinerja(): BelongsTo
    {
        return $this->belongsTo(IndikatorKinerja::class, 'indikator_kinerja_d', 'id');
    }
}
