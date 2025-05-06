<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KuisionerOpsi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(Kuisioner::class);
    }
}
