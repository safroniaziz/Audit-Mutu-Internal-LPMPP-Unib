@extends('dataauditor.dashboard_template')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Penilaian Instrumen Prodi</h2>
    <div class="card mb-4">
        <div class="card-body">
            <strong>Auditee:</strong> {{ $pengajuan->auditee->nama ?? '-' }}<br>
            <strong>Periode:</strong> {{ $pengajuan->periodeAktif->nama ?? '-' }}
        </div>
    </div>
    @php
        $groupedData = [];
        foreach ($indikatorInstrumens as $instrumen) {
            $indikatorId = $instrumen->id;
            if (!isset($groupedData[$indikatorId])) {
                $groupedData[$indikatorId] = [
                    'indikator' => $instrumen,
                    'kriterias' => []
                ];
            }
            if (!$instrumen->kriterias) continue;
            foreach ($instrumen->kriterias as $kriteria) {
                if (!$kriteria) continue;
                $kriteriaId = $kriteria->id;
                if (!isset($groupedData[$indikatorId]['kriterias'][$kriteriaId])) {
                    $groupedData[$indikatorId]['kriterias'][$kriteriaId] = [
                        'kriteria' => $kriteria,
                        'instrumens' => []
                    ];
                }
                if (!$kriteria->instrumenProdi) continue;
                foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                    if (!$instrumenProdi) continue;
                    $groupedData[$indikatorId]['kriterias'][$kriteriaId]['instrumens'][] = $instrumenProdi;
                }
            }
        }
    @endphp
    @foreach($groupedData as $indikatorData)
        <div class="mb-4">
            <h4>{{ $indikatorData['indikator']->nama }}</h4>
            @foreach($indikatorData['kriterias'] as $kriteriaData)
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Kriteria:</strong> {{ $kriteriaData['kriteria']->nama_kriteria }}
                    </div>
                    <div class="card-body">
                        @foreach($kriteriaData['instrumens'] as $instrumenProdi)
                            <div class="mb-4 border-bottom pb-3">
                                <strong>Elemen:</strong> {{ $instrumenProdi->elemen }}<br>
                                <strong>Indikator:</strong> {{ $instrumenProdi->indikator }}<br>
                                <strong>Uraian:</strong> {{ $instrumenProdi->uraian }}<br>
                                <strong>Realisasi:</strong> {{ $instrumenProdi->submission->realisasi ?? '-' }}<br>
                                <strong>Akar Penyebab:</strong> {{ $instrumenProdi->submission->akar_penyebab ?? '-' }}<br>
                                <strong>Rencana Perbaikan:</strong> {{ $instrumenProdi->submission->rencana_perbaikan ?? '-' }}<br>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
