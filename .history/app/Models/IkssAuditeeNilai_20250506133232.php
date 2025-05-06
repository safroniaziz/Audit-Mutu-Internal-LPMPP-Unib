<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class IkssAuditeeNilai extends Model
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

    /**
     * Get the a that owns the IkssAuditeeNilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function a(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
