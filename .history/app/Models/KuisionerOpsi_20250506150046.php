<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KuisionerOpsi extends Model
{
    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(Kuisioner::class);
    }
}
