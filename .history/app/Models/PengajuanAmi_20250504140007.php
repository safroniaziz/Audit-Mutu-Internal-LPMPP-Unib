<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanAmi extends Model
{
    /**
     * Get all of the comments for the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }
}
