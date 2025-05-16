<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use Illuminate\Http\Request;

class DokumenAmiController extends Controller
{
    public function index(){
        $dokumenAuditor = DokumenAmi::with(['auditor'])
                            ->first();
        $dokumenAuditee = DokumenAmi::with(['auditee'])
                            ->first();
        $dokumenUmum = DokumenAmi::with(['umum'])
                            ->first();
        return view('auditee/pengajuan_ami/unggah_siklus',[
            'dokumenAuditor'  =>  $dokumenAuditor,
            'dokumenAuditee'  =>  $dokumenAuditee,
            'dokumenUmum'  =>  $dokumenUmum,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'auditee_id' => 'required',
            'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        // Mendapatkan periode aktif
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        if (!$periodeAktif) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada periode aktif saat ini'
            ], 422);
        }

        $pengajuanAmi = PengajuanAmi::firstOrCreate(
            [
                'auditee_id' => $request->auditee_id,
                'periode_id' => $periodeAktif->id,
            ],
            [
                'is_disetujui' => 0,
                'waktu' => now(),
            ]
        );

        IkssAuditee::where('auditee_id', $pengajuanAmi->auditee_id)
                    ->where('periode_id', $pengajuanAmi->periode_id)
                    ->update(['pengajuan_ami_id' => $pengajuanAmi->id]);


        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Simpan file ke storage
                $path = $file->store('dokumen_siklus_ami', 'public');

                // Simpan informasi file ke database SiklusPengajuanAmi
                $dokumen = SiklusPengajuanAmi::create([
                    'pengajuan_ami_id' => $pengajuanAmi->id,
                    'nama_berkas' => $file->getClientOriginalName(),
                    'jenis_berkas' => 'siklus', // Set jenis berkas sebagai siklus
                    'path' => $path
                ]);

                $uploadedFiles[] = $dokumen;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen siklus AMI berhasil diunggah!',
            'pengajuan_id' => $pengajuanAmi->id,
            'files' => $uploadedFiles
        ]);
    }

    public function nonaktifkan($id)
    {
        try {
            // Ambil data file
            $file = SiklusPengajuanAmi::findOrFail($id);

            // Hapus file dari storage
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }

            // Hapus record dari database
            $file->delete();

            return response()->json([
                'success' => true,
                'message' => 'File berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus file: ' . $e->getMessage()
            ], 500);
        }
    }
}
