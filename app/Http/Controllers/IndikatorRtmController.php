<?php

namespace App\Http\Controllers;

use App\Models\IndikatorInstrumen;
use App\Models\InstrumenProdiNilai;
use App\Models\PengajuanAmi;
use App\Models\PeriodeAktif;
use Illuminate\Http\Request;

class IndikatorRtmController extends Controller
{
    const THRESHOLD = 3;

    public function index(Request $request)
    {
        // Get current active period
        $currentPeriod = PeriodeAktif::whereNull('deleted_at')->first();

        // Get all periods for filter dropdown
        $allPeriods = PeriodeAktif::withTrashed()
            ->orderByRaw('deleted_at IS NULL DESC')
            ->orderBy('tahun_ami', 'desc')
            ->get();

        // Determine which period to use
        $selectedPeriodId = $request->filled('period')
            ? $request->period
            : ($currentPeriod ? $currentPeriod->id : null);

        // Get all pengajuan ami for the selected period
        $query = PengajuanAmi::with([
            'auditee',
            'auditors.auditor',
            'periodeAktif',
        ])->orderBy('created_at', 'desc');

        if ($selectedPeriodId) {
            $query->where('periode_id', $selectedPeriodId);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('auditee', function ($q) use ($search) {
                $q->where('nama_unit_kerja', 'like', "%{$search}%")
                  ->orWhere('fakultas', 'like', "%{$search}%");
            });
        }

        $pengajuanList = $query->get();

        // Build RTM data for each pengajuan
        $rtmData = $pengajuanList->map(function ($pengajuan) {
            return $this->buildRtmCard($pengajuan);
        })->filter(function ($item) {
            return $item['total_lam'] > 0 && $item['has_scored_auditor'];
        })->values();

        // Summary statistics
        $totalEntitas   = $rtmData->count();
        $totalBawahThreshold = $rtmData->sum('total_bawah_threshold');
        $totalMinimalThreshold = $rtmData->sum('total_minimal_threshold');
        $fakultasData = $rtmData->groupBy(function ($item) {
            return $item['auditee']->fakultas ?: 'Fakultas Tidak Diketahui';
        })->map(function ($items, $fakultas) {
            $totalBawah = $items->sum('total_bawah_threshold');
            $totalMinimal = $items->sum('total_minimal_threshold');
            $totalIndikator = $totalBawah + $totalMinimal;
            $pctTercapai = $totalIndikator > 0 ? round(($totalMinimal / $totalIndikator) * 100, 1) : 0;

            return [
                'fakultas' => $fakultas,
                'total_entitas' => $items->count(),
                'total_bawah_threshold' => $totalBawah,
                'total_minimal_threshold' => $totalMinimal,
                'total_indikator' => $totalIndikator,
                'persentase_tercapai' => $pctTercapai,
            ];
        })->sortByDesc('total_indikator')->values();
        $lamData = collect();
        $lamAgg = [];
        foreach ($rtmData as $item) {
            $fakultas = $item['auditee']->fakultas ?: 'Fakultas Tidak Diketahui';
            foreach ($item['lam_list'] as $lam) {
                $key = ($lam['id'] ?? 'x') . '||' . ($lam['nama'] ?? '-');
                if (!isset($lamAgg[$key])) {
                    $lamAgg[$key] = [
                        'lam_id' => $lam['id'] ?? null,
                        'lam_nama' => $lam['nama'] ?? '-',
                        'total_entitas' => 0,
                        'total_bawah_threshold' => 0,
                        'total_minimal_threshold' => 0,
                        'fakultas_set' => [],
                    ];
                }
                $lamAgg[$key]['total_entitas']++;
                $lamAgg[$key]['total_bawah_threshold'] += (int) ($lam['bawah_threshold'] ?? 0);
                $lamAgg[$key]['total_minimal_threshold'] += (int) ($lam['minimal_threshold'] ?? 0);
                $lamAgg[$key]['fakultas_set'][$fakultas] = $fakultas;
            }
        }
        $lamData = collect($lamAgg)->map(function ($row) {
            $total = $row['total_bawah_threshold'] + $row['total_minimal_threshold'];
            $row['total_indikator'] = $total;
            $row['persentase_tercapai'] = $total > 0 ? round(($row['total_minimal_threshold'] / $total) * 100, 1) : 0;
            $row['fakultas_list'] = array_values($row['fakultas_set']);
            unset($row['fakultas_set']);
            return $row;
        })->sortByDesc('total_bawah_threshold')->values();

        $selectedPeriod = $selectedPeriodId
            ? PeriodeAktif::withTrashed()->find($selectedPeriodId)
            : $currentPeriod;

        return view('indikator_rtm.index', [
            'rtmData'               => $rtmData,
            'currentPeriod'         => $currentPeriod,
            'selectedPeriod'        => $selectedPeriod,
            'allPeriods'            => $allPeriods,
            'totalEntitas'          => $totalEntitas,
            'totalBawahThreshold'   => $totalBawahThreshold,
            'totalMinimalThreshold' => $totalMinimalThreshold,
            'fakultasData'          => $fakultasData,
            'lamData'               => $lamData,
            'threshold'             => self::THRESHOLD,
        ]);
    }

    /**
     * Build RTM card data for a single pengajuan
     */
    private function buildRtmCard($pengajuan)
    {
        $unitKerjaId  = $pengajuan->auditee_id;
        $pengajuanId  = $pengajuan->id;

        // Get all LAM (IndikatorInstrumen) that belong to this prodi
        $indikators = IndikatorInstrumen::with([
            'kriterias.instrumenProdi.nilaiAuditor' => function ($q) use ($pengajuanId) {
                $q->where('pengajuan_ami_id', $pengajuanId);
            }
        ])
        ->whereHas('prodis', function ($q) use ($unitKerjaId) {
            $q->where('unit_kerja_id', $unitKerjaId);
        })
        ->get();

        $lamList = [];

        foreach ($indikators as $indikator) {
            $indikatorThreshold = (float) ($indikator->threshold ?? self::THRESHOLD);
            $bawahThreshold    = 0;
            $minimalThreshold  = 0;
            $totalKriteria     = 0;

            foreach ($indikator->kriterias as $kriteria) {
                // Collect all nilai for this kriteria in this pengajuan
                $allNilai = collect();

                foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                    foreach ($instrumenProdi->nilaiAuditor as $nilai) {
                        if (!is_null($nilai->nilai) && $nilai->nilai > 0) {
                            $allNilai->push((float) $nilai->nilai);
                        }
                    }
                }

                if ($allNilai->isNotEmpty()) {
                    $rataRata = $allNilai->avg();
                    $totalKriteria++;

                    if ($rataRata < $indikatorThreshold) {
                        $bawahThreshold++;
                    } else {
                        $minimalThreshold++;
                    }
                }
            }

            if ($totalKriteria > 0 || $indikator->kriterias->count() > 0) {
                $lamList[] = [
                    'id'                  => $indikator->id,
                    'nama'                => $indikator->nama_indikator ?? 'LAM #' . $indikator->id,
                    'threshold'           => $indikatorThreshold,
                    'total_kriteria'      => $totalKriteria,
                    'bawah_threshold'     => $bawahThreshold,
                    'minimal_threshold'   => $minimalThreshold,
                    'all_kriterias_count' => $indikator->kriterias->count(),
                ];
            }
        }

        $totalBawah   = collect($lamList)->sum('bawah_threshold');
        $totalMinimal = collect($lamList)->sum('minimal_threshold');

        $nilaiPerAuditor = InstrumenProdiNilai::where('pengajuan_ami_id', $pengajuanId)
            ->whereNotNull('nilai')
            ->where('nilai', '>', 0)
            ->selectRaw('auditor_id, COUNT(*) as total_nilai')
            ->groupBy('auditor_id')
            ->pluck('total_nilai', 'auditor_id');

        $auditorList = collect($pengajuan->auditors)->map(function ($auditor) use ($nilaiPerAuditor) {
            $auditorCompleted = $auditor->is_setuju && $auditor->is_setuju_visitasi && $auditor->is_setuju_indikator_prodi;
            $auditorStarted = $auditor->is_setuju || $auditor->is_setuju_visitasi || $auditor->is_setuju_indikator_prodi;
            $nilaiCount = (int) ($nilaiPerAuditor[$auditor->user_id] ?? 0);

            if ($auditorCompleted) {
                $status = ['label' => 'Selesai', 'class' => 'success', 'icon' => 'fas fa-check'];
            } elseif ($auditorStarted || $nilaiCount > 0) {
                $status = ['label' => 'Proses', 'class' => 'warning', 'icon' => 'fas fa-clock'];
            } else {
                $status = ['label' => 'Belum Mulai', 'class' => 'secondary', 'icon' => 'fas fa-hourglass-start'];
            }

            return [
                'name' => optional($auditor->auditor)->name ?? 'Auditor Tidak Diketahui',
                'role' => $auditor->role,
                'nilai_count' => $nilaiCount,
                'status' => $status,
            ];
        })->values();

        $hasScoredAuditor = $auditorList->contains(function ($auditor) {
            return $auditor['nilai_count'] > 0;
        });

        return [
            'pengajuan'              => $pengajuan,
            'auditee'                => $pengajuan->auditee,
            'periode'                => $pengajuan->periodeAktif,
            'lam_list'               => $lamList,
            'total_lam'              => count($lamList),
            'total_bawah_threshold'  => $totalBawah,
            'total_minimal_threshold'=> $totalMinimal,
            'auditor_list'           => $auditorList,
            'has_scored_auditor'     => $hasScoredAuditor,
        ];
    }

    public function detail($pengajuan)
    {
        $pengajuan = PengajuanAmi::with(['auditee', 'auditors.auditor', 'periodeAktif'])->findOrFail($pengajuan);
        $lamDetails = $this->buildLamDetails($pengajuan);

        return view('indikator_rtm.detail', [
            'pengajuan' => $pengajuan,
            'lamDetails' => $lamDetails,
            'threshold' => self::THRESHOLD,
        ]);
    }

    public function detailFakultas(Request $request)
    {
        $fakultas = $request->query('fakultas');
        $periodId = $request->query('period');

        abort_if(!$fakultas, 404);

        $query = PengajuanAmi::with(['auditee', 'auditors.auditor', 'periodeAktif'])
            ->whereHas('auditee', function ($q) use ($fakultas) {
                $q->where('fakultas', $fakultas);
            })
            ->orderBy('created_at', 'desc');

        if ($periodId) {
            $query->where('periode_id', $periodId);
        }

        $pengajuanList = $query->get();
        $rtmData = $pengajuanList
            ->map(fn ($pengajuan) => $this->buildRtmCard($pengajuan))
            ->filter(fn ($item) => $item['total_lam'] > 0 && $item['has_scored_auditor'])
            ->values();

        $eligiblePengajuanIds = $rtmData->pluck('pengajuan.id')->all();
        $indikatorAgg = [];

        foreach ($pengajuanList as $pengajuan) {
            if (!in_array($pengajuan->id, $eligiblePengajuanIds)) {
                continue;
            }

            $prodiNama = trim(($pengajuan->auditee->jenjang ?? '') . ' ' . ($pengajuan->auditee->nama_unit_kerja ?? '-'));
            $lamDetails = $this->buildLamDetails($pengajuan);

            foreach ($lamDetails as $lam) {
                foreach ($lam['kriteria_rows'] as $row) {
                    $key = ($lam['nama'] ?? '-') . '||' . ($row['kode'] ?? '-') . '||' . ($row['nama'] ?? '-');
                    if (!isset($indikatorAgg[$key])) {
                        $indikatorAgg[$key] = [
                            'kriteria_id' => $row['id'],
                            'lam_nama' => $lam['nama'] ?? '-',
                            'threshold' => (float) ($row['threshold'] ?? self::THRESHOLD),
                            'indikator_kode' => $row['kode'] ?? null,
                            'indikator_nama' => $row['nama'] ?? '-',
                            'total_penilaian' => 0,
                            'total_nilai' => 0,
                            'total_bawah' => 0,
                            'total_mencapai' => 0,
                            'prodi_mendapatkan' => [],
                            'prodi_bawah' => [],
                        ];
                    }

                    $indikatorAgg[$key]['total_penilaian']++;
                    $indikatorAgg[$key]['total_nilai'] += (float) $row['rata_rata'];
                    $indikatorAgg[$key]['prodi_mendapatkan'][$prodiNama] = $prodiNama;
                    if ($row['is_below']) {
                        $indikatorAgg[$key]['total_bawah']++;
                        $indikatorAgg[$key]['prodi_bawah'][$prodiNama] = $prodiNama;
                    } else {
                        $indikatorAgg[$key]['total_mencapai']++;
                    }
                }
            }
        }

        $monitoringData = \App\Models\RtmMonitoringFakultas::where('fakultas', $fakultas)
            ->where('periode_id', $periodId)
            ->get()
            ->keyBy('kriteria_id');

        $indikatorFakultas = collect($indikatorAgg)
            ->map(function ($item) use ($monitoringData) {
                $item['prodi_mendapatkan'] = array_values($item['prodi_mendapatkan']);
                $item['prodi_bawah'] = array_values($item['prodi_bawah']);
                $item['nilai_rata_rata'] = $item['total_penilaian'] > 0
                    ? round($item['total_nilai'] / $item['total_penilaian'], 2)
                    : 0;
                $threshold = (float) ($item['threshold'] ?? self::THRESHOLD);
                $item['nilai_kurang'] = $item['nilai_rata_rata'] < $threshold
                    ? round($threshold - $item['nilai_rata_rata'], 2)
                    : 0;
                $item['persen_bawah'] = $item['total_penilaian'] > 0
                    ? round(($item['total_bawah'] / $item['total_penilaian']) * 100, 1)
                    : 0;

                // Bind monitoring data
                $kriteriaId = $item['kriteria_id'] ?? null;
                $mon = $monitoringData->get($kriteriaId);
                $item['monitoring_1'] = $mon ? $mon->monitoring_1 : null;
                $item['monitoring_2'] = $mon ? $mon->monitoring_2 : null;
                $item['monitoring_3'] = $mon ? $mon->monitoring_3 : null;
                $item['hasil_rtl'] = $mon ? $mon->hasil_rtl : null;

                return $item;
            })
            ->sortByDesc('total_bawah')
            ->values();

        $chartIndikator = $indikatorFakultas->map(function ($row) {
            $indikatorLabel = ($row['indikator_kode'] ? $row['indikator_kode'] . ' - ' : '') . $row['indikator_nama'];
            $label = $row['lam_nama'] . ' | ' . $indikatorLabel;
            return [
                'label' => $label,
                'bawah' => $row['total_bawah'],
                'mencapai' => $row['total_mencapai'],
            ];
        })->values();

        return view('indikator_rtm.fakultas_detail', [
            'fakultas' => $fakultas,
            'periodId' => $periodId,
            'rtmData' => $rtmData,
            'indikatorFakultas' => $indikatorFakultas,
            'chartIndikator' => $chartIndikator,
            'threshold' => self::THRESHOLD,
            'totalEntitas' => $rtmData->count(),
            'totalBawahThreshold' => $rtmData->sum('total_bawah_threshold'),
            'totalMinimalThreshold' => $rtmData->sum('total_minimal_threshold'),
        ]);
    }

    public function saveMonitoring(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'fakultas' => 'required|string',
            'period_id' => 'required|integer',
            'kriteria_id' => 'required|integer',
            'monitoring_1' => 'nullable|string',
            'monitoring_2' => 'nullable|string',
            'monitoring_3' => 'nullable|string',
            'hasil_rtl' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $validator->errors()->all())
            ], 422);
        }

        try {
            $monitoring = \App\Models\RtmMonitoringFakultas::updateOrCreate(
                [
                    'fakultas' => $request->fakultas,
                    'periode_id' => $request->period_id,
                    'kriteria_id' => $request->kriteria_id,
                ],
                [
                    'monitoring_1' => $request->monitoring_1,
                    'monitoring_2' => $request->monitoring_2,
                    'monitoring_3' => $request->monitoring_3,
                    'hasil_rtl' => $request->hasil_rtl,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Data monitoring berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteMonitoring(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'fakultas' => 'required|string',
            'period_id' => 'required|integer',
            'kriteria_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $validator->errors()->all())
            ], 422);
        }

        try {
            \App\Models\RtmMonitoringFakultas::where('fakultas', $request->fakultas)
                ->where('periode_id', $request->period_id)
                ->where('kriteria_id', $request->kriteria_id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data monitoring berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detailLam(Request $request)
    {
        $lamId = $request->query('lam_id');
        $lamNama = $request->query('lam_nama');
        $periodId = $request->query('period');
        abort_if(!$lamId, 404);

        $query = PengajuanAmi::with(['auditee', 'auditors.auditor', 'periodeAktif'])->orderBy('created_at', 'desc');
        if ($periodId) {
            $query->where('periode_id', $periodId);
        }
        $pengajuanList = $query->get();

        $rows = [];
        foreach ($pengajuanList as $pengajuan) {
            $lamDetails = $this->buildLamDetails($pengajuan);
            $targetLam = collect($lamDetails)->firstWhere('id', (int) $lamId);
            if (!$targetLam) {
                continue;
            }
            $prodiNama = trim(($pengajuan->auditee->jenjang ?? '') . ' ' . ($pengajuan->auditee->nama_unit_kerja ?? '-'));
            $fakultas = $pengajuan->auditee->fakultas ?: '-';

            foreach ($targetLam['kriteria_rows'] as $row) {
                $rowThreshold = (float) ($row['threshold'] ?? self::THRESHOLD);
                $rows[] = [
                    'prodi' => $prodiNama,
                    'fakultas' => $fakultas,
                    'indikator_kode' => $row['kode'],
                    'indikator_nama' => $row['nama'],
                    'nilai' => $row['rata_rata'],
                    'threshold' => $rowThreshold,
                    'lam_threshold' => (float) ($targetLam['threshold'] ?? $rowThreshold),
                    'kurang' => $row['is_below'] ? round($rowThreshold - $row['rata_rata'], 2) : 0,
                    'status' => $row['is_below'] ? 'below' : 'ok',
                ];
            }
        }

        $rows = collect($rows);
        return view('indikator_rtm.lam_detail', [
            'lamId' => $lamId,
            'lamNama' => $lamNama ?: ('LAM #' . $lamId),
            'periodId' => $periodId,
            'rows' => $rows,
            'threshold' => self::THRESHOLD,
        ]);
    }

    private function buildLamDetails($pengajuan): array
    {
        $unitKerjaId = $pengajuan->auditee_id;
        $pengajuanId = $pengajuan->id;

        $indikators = IndikatorInstrumen::with([
            'kriterias.instrumenProdi.nilaiAuditor' => function ($q) use ($pengajuanId) {
                $q->where('pengajuan_ami_id', $pengajuanId);
            },
        ])->whereHas('prodis', function ($q) use ($unitKerjaId) {
            $q->where('unit_kerja_id', $unitKerjaId);
        })->get();

        $lamDetails = [];
        foreach ($indikators as $indikator) {
            $indikatorThreshold = (float) ($indikator->threshold ?? self::THRESHOLD);
            $kriteriaRows = [];
            $bawahThreshold = 0;
            $minimalThreshold = 0;

            foreach ($indikator->kriterias as $kriteria) {
                $allNilai = collect();
                foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                    foreach ($instrumenProdi->nilaiAuditor as $nilai) {
                        if (!is_null($nilai->nilai) && $nilai->nilai > 0) {
                            $allNilai->push((float) $nilai->nilai);
                        }
                    }
                }

                if ($allNilai->isEmpty()) {
                    continue;
                }

                $rataRata = (float) $allNilai->avg();
                $isBelow = $rataRata < $indikatorThreshold;
                $isBelow ? $bawahThreshold++ : $minimalThreshold++;

                $kriteriaRows[] = [
                    'id' => $kriteria->id,
                    'nama' => $kriteria->nama_kriteria ?? $kriteria->kriteria ?? 'Kriteria tanpa nama',
                    'kode' => $kriteria->kode_kriteria,
                    'threshold' => $indikatorThreshold,
                    'rata_rata' => round($rataRata, 2),
                    'is_below' => $isBelow,
                ];
            }

            if (count($kriteriaRows) === 0) {
                continue;
            }

            $lamDetails[] = [
                'id' => $indikator->id,
                'nama' => $indikator->nama_indikator ?? 'Indikator tanpa nama',
                'threshold' => $indikatorThreshold,
                'bawah_threshold' => $bawahThreshold,
                'minimal_threshold' => $minimalThreshold,
                'kriteria_rows' => $kriteriaRows,
            ];
        }

        return $lamDetails;
    }
}
