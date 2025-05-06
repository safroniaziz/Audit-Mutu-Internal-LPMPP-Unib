<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeAktif extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'rsb_prodis';

    public $timestamps = true;
}
