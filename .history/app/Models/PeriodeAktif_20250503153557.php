<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeAktif extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $timestamps = true;

    /**
     * Get all of the comments for the PeriodeAktif
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }
}
