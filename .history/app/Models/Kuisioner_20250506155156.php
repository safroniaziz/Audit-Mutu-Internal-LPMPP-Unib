<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kuisioner extends Model
{
    public function opsis(): HasMany
    {
        return $this->hasMany(KuisionerOpsi::class,'');
    }

    /**
     * Get the jawaban for the kuisioner.
     */
    public function jawabans(): HasMany
    {
        return $this->hasMany(KuisionerJawaban::class,'kuisioner_id','id');
    }
}
