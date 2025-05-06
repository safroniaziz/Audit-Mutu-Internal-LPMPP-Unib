<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengajuanAmi extends Model
{
    /**
     * Get all of the siklus for the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siklus(): HasMany
    {
        return $this->hasMany(SiklusIkssAuditee::class, 'foreign_key', 'local_key');
    }
}
