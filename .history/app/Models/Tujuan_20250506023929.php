<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tujuan extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}
