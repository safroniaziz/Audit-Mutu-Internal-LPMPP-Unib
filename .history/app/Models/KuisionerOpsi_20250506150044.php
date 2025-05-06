<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisionerOpsi extends Model
{
    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(Kuisioner::class);
    }
}
