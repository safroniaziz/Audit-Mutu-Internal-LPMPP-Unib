<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiklusIkssAuditee extends Model
{
    /**
     * Get the ikssAuditee that owns the SiklusIkssAuditee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ikssAuditee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ikss_auditee_id', 'id');
    }
}
