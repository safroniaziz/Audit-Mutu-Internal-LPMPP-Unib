<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenInstrumenProdi extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'nama_file',
        'path'
    ];

    public function submission()
    {
        return $this->belongsTo(InstrumenProdiSubmission::class, 'submission_id');
    }
}
