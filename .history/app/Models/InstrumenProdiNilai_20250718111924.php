<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumenProdiNilai extends Model
{
    use HasFactory;

    protected $table = 'instrumen_prodi_nilai';

    protected $fillable = [
        'instrumen_prodi_id',
        'pengajuan_ami_id',
        'auditor_id',
        'nilai',
        'catatan'
    ];

    public function instrumenProdi()
    {
        return $this->belongsTo(InstrumenProdi::class);
    }

    public function pengajuanAmi()
    {
        return $this->belongsTo(PengajuanAmi::class);
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }
}
