<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class IkssAuditee extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_id');
    }

    // Relasi ke User (Auditee)
    public function auditee()
    {
        return $this->belongsTo(User::class, 'auditee_id');
    }

    // Relasi ke PengajuanAmi
    public function pengajuanAmi()
    {
        return $this->belongsTo(PengajuanAmi::class, 'pengajuan_ami_id');
    }

    // Relasi ke InstrumenIks
    public function instrumen()
    {
        return $this->belongsTo(InstrumenIkss::class, 'instrumen_id');
    }

    /**
     * Get all of the nilai for the IkssAuditee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(IkssAuditeeNilai::class, 'ikss_auditee_id', 'id');
    }

    public function visitasi(): HasMany
    {
        return $this->hasOne(IkssAuditeeVisitasi::class, 'ikss_auditee_id', 'id');
    }
}
