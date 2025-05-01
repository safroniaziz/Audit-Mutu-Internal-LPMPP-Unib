<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndikatorInstrumen extends Model
{
    use SoftDeletes, HasUuids;

    protected $guarded = [];
    public $incrementing = false; // Matikan auto-increment karena UUID
    protected $keyType = 'string'; // Pastikan tipe key adalah string
}
