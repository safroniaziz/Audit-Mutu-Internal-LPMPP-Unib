<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkssAuditeeVisitasi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the ikssAuditee that owns the IkssAuditeeNilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ikssAuditee(): BelongsTo
    {
        return $this->belongsTo(IkssAuditee::class, 'ikss_auditee_id', 'id');
    }
}
