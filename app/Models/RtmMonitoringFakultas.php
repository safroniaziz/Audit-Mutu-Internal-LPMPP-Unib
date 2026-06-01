<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class RtmMonitoringFakultas extends Model
{
    protected $table = 'rtm_monitoring_fakultas';
 
    protected $fillable = [
        'fakultas',
        'periode_id',
        'kriteria_id',
        'monitoring_1',
        'monitoring_2',
        'monitoring_3',
        'hasil_rtl',
    ];
 
    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(IndikatorInstrumenKriteria::class, 'kriteria_id');
    }
 
    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_id');
    }
}
