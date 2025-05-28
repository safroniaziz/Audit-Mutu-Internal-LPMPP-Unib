<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Audit Mutu Internal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 100px;
            margin-bottom: 10px;
        }
        .content {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .signature {
            margin-top: 50px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/src/images/logo_unib.png') }}" alt="Logo UNIB">
        <h2>LAPORAN AUDIT MUTU INTERNAL</h2>
        <p>{{ $pengajuan->auditee->jenis_unit_kerja == "prodi" ? 'PROGRAM STUDI' : 'FAKULTAS' }} {{ $pengajuan->auditee->nama_unit_kerja }}</p>
    </div>

    <div class="content">
        <div class="section">
            <table>
                <tr>
                    <td width="30%">Tanggal Audit</td>
                    <td>: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Auditee</td>
                    <td>: {{ $pengajuan->auditee->nama_unit_kerja }}</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>: {{ $pengajuan->auditee->fakultas }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Tim Auditor:</div>
            <table>
                <tr>
                    <th>Peran</th>
                    <th>Nama</th>
                </tr>
                @foreach($pengajuan->auditors as $auditor)
                    <tr>
                        <td>{{ ucfirst($auditor->role) }}</td>
                        <td>{{ $auditor->auditor->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="section">
            <div class="section-title">Hasil Penilaian:</div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Sasaran</th>
                        <th>Nilai Ketua</th>
                        <th>Nilai Anggota</th>
                        <th>Total</th>
                        <th>Rata-Rata</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalNilaiKetua = 0;
                        $totalNilaiAnggota = 0;
                        $totalKeseluruhan = 0;
                        $jumlahPenilaian = 0;
                    @endphp
                    @foreach($pengajuan->ikssAuditee as $index => $ikss)
                        @php
                            $nilaiKetua = 0;
                            $nilaiAnggota = 0;

                            foreach($ikss->nilai as $nilai) {
                                foreach($nilai->auditor->penugasan as $penugasan) {
                                    if ($penugasan->pengajuan_ami_id == $pengajuan->id) {
                                        if ($penugasan->role == 'ketua') {
                                            $nilaiKetua = $nilai->nilai ?? 0;
                                        } elseif ($penugasan->role == 'pendamping') {
                                            $nilaiAnggota = $nilai->nilai ?? 0;
                                        }
                                    }
                                }
                            }

                            $total = $nilaiKetua + $nilaiAnggota;
                            $rataRata = $total > 0 ? $total / 2 : 0;

                            $totalNilaiKetua += $nilaiKetua;
                            $totalNilaiAnggota += $nilaiAnggota;
                            $totalKeseluruhan += $total;
                            $jumlahPenilaian++;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ikss->instrumen->indikatorKinerja->satuanStandar->kode_satuan }}</td>
                            <td>{{ $ikss->instrumen->indikatorKinerja->satuanStandar->sasaran }}</td>
                            <td>{{ number_format($nilaiKetua, 2) }}</td>
                            <td>{{ number_format($nilaiAnggota, 2) }}</td>
                            <td>{{ number_format($total, 2) }}</td>
                            <td>{{ number_format($rataRata, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: center;"><strong>Total</strong></td>
                        <td><strong>{{ number_format($totalNilaiKetua, 2) }}</strong></td>
                        <td><strong>{{ number_format($totalNilaiAnggota, 2) }}</strong></td>
                        <td><strong>{{ number_format($totalKeseluruhan, 2) }}</strong></td>
                        <td><strong>{{ number_format($totalKeseluruhan / ($jumlahPenilaian * 2), 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="signature">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 50%; text-align: center;">
                    Ketua Auditor<br><br><br><br>
                    @foreach($pengajuan->auditors as $auditor)
                        @if($auditor->role == 'ketua')
                            {{ $auditor->auditor->name }}
                        @endif
                    @endforeach
                </td>
                <td style="border: none; width: 50%; text-align: center;">
                    Auditee<br><br><br><br>
                    {{ $pengajuan->auditee->name }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
