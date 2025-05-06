<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanAmi extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    /**
     * Get all of the siklus for the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siklus(): HasMany
    {
        return $this->hasMany(SiklusPengajuanAmi::class, 'pengajuan_ami_id', 'id');
    }
}
