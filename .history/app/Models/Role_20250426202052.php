<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    <?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Role extends SpatieRole
{
    use HasUuids;

    // Kalau mau tambah custom function atau relasi bisa di sini nanti
}

}
