<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanAmi extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    /**
     * Get all of the siklus for the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siklus(): HasMany
    {
        return $this->hasMany(SiklusPengajuanAmi::class, 'pengajuan_ami_id', 'id');
    }

    /**
     * Get all of the ikssAuditee for the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ikssAuditee(): HasMany
    {
        return $this->hasMany(IkssAuditee::class, 'pengajuan_ami_id', 'id');
    }

    /**
     * Get the auditee that owns the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditee(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class, 'auditee_id', 'id');
    }

    /**
     * Get all of the auditors for the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditors(): HasMany
    {
        return $this->hasMany(PenugasanAuditor::class, 'pengajuan_ami_id', 'id');
    }

    /**
     * Get the perjanjianKinerja associated with the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function perjanjianKinerja(): HasOne
    {
        return $this->hasOne(PerjanjianKinerja::class, 'pengajuan_ami_id', 'id');
    }

    /**
     * Get the periodeAktif that owns the PengajuanAmi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periodeAktif(): BelongsTo
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_id', 'id')
                    ->withTrashed();
    }

    public function evaluasiSubmissions()
    {
        return $this->hasMany(EvaluasiSubmission::class, 'pengajuan_ami_id');
    }

    public function catatanVisitasiBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'catatan_visitasi_by', 'id');
    }
}
