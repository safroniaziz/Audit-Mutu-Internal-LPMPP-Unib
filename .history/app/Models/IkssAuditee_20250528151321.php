<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class IkssAuditee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ikss_auditees';
    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_id');
    }

    // Relasi ke User (Auditee)
    public function auditee()
    {
        return $this->belongsTo(UnitKerja::class, 'auditee_id');
    }

    // Relasi ke PengajuanAmi
    public function pengajuanAmi()
    {
        return $this->belongsTo(PengajuanAmi::class, 'pengajuan_ami_id');
    }

    // Relasi ke InstrumenIks
    public function instrumen()
    {
        return $this->belongsTo(Instrumen::class);
    }

    public function indikator()
    {
        return $this->belongsTo(Instrumen::class);
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
        return $this->hasMany(IkssAuditeeVisitasi::class, 'ikss_auditee_id', 'id');
    }
}
