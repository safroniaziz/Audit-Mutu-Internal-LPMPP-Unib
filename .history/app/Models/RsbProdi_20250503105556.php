<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsbProdi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'rsb_prodis';
}
