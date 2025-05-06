<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsbProdi extends Pivot
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'rsb_prodis';

    public $timestamps = true;
}
