<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class Role extends Model
{
    use HasUuids, RefreshesPermissionCache;
}
