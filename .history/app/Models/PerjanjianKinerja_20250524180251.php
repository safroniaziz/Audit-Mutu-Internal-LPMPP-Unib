<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerjanjianKinerja extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'periode_id',
        'auditee_id',
        'pengajuan_ami_id',
        'nama_file',
        'file_path',
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodeAktif::class, 'periode_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'auditee_id');
    }

    public function pengajuanAmi()
    {
        return $this->belongsTo(PengajuanAmi::class, 'pengajuan_ami_id');
    }
}
