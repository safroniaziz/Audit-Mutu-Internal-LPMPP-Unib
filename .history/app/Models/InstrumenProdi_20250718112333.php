<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class InstrumenProdi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Get the indikatorInstrumen that owns the IndikatorInstrumenKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kriteriaInstrumen(): BelongsTo
    {
        return $this->belongsTo(IndikatorInstrumenKriteria::class, 'indikator_instrumen_kriteria_id', 'id');
    }

    /**
     * Get the submission associated with the InstrumenProdi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function submission()
    {
        return $this->hasOne(InstrumenProdiSubmission::class, 'instrumen_prodi_id');
    }

    /**
     * Get the submission for specific unit kerja
     *
     * @param int $unitKerjaId
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function submissionForUnit($unitKerjaId)
    {
        return $this->hasOne(InstrumenProdiSubmission::class, 'instrumen_prodi_id')
                    ->where('unit_kerja_id', $unitKerjaId);
    }

    /**
     * Get all nilai from auditors for this instrumen prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilaiAuditor()
    {
        return $this->hasMany(InstrumenProdiNilai::class, 'instrumen_prodi_id');
    }

    /**
     * Get nilai from specific auditor for specific pengajuan
     *
     * @param int $pengajuanId
     * @param int $auditorId
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nilaiAuditorForPengajuan($pengajuanId, $auditorId = null)
    {
        $query = $this->hasOne(InstrumenProdiNilai::class, 'instrumen_prodi_id')
                      ->where('pengajuan_ami_id', $pengajuanId);

        if ($auditorId) {
            $query->where('auditor_id', $auditorId);
        }

        return $query;
    }

    /**
     * Get nilai from current auditor for specific pengajuan
     *
     * @param int $pengajuanId
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nilaiAuditorCurrent($pengajuanId)
    {
        return $this->hasOne(InstrumenProdiNilai::class, 'instrumen_prodi_id')
                    ->where('pengajuan_ami_id', $pengajuanId)
                    ->where('auditor_id', auth()->id());
    }
}
