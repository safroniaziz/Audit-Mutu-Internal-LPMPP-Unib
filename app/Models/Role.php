<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\RefreshesPermissionCache;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUuids, RefreshesPermissionCache;

    protected $guarded = []; // Biar semua kolom bisa mass-assign (aman kalau sudah yakin)

    public $incrementing = false; // Karena id UUID, bukan auto-increment angka

    protected $keyType = 'string'; // UUID itu string, bukan integer
}
