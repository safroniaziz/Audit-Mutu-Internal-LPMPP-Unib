<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeAktifJadwal extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $timestamps = true;

    /**
     * Get the user that owns the PeriodeAktifJadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
