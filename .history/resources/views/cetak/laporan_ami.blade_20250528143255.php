<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Audit Mutu Internal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 12pt;
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
            padding: 6px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .signature {
            margin-top: 50px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            margin: 20px 0;
            font-size: 14pt;
            text-decoration: underline;
        }
        .details-table td {
            padding: 6px;
            border: none;
        }
        .details-table tr td:first-child {
            width: 20%;
        }
        .details-table tr td:nth-child(2) {
            width: 2%;
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
        <table class="details-table">
            <tbody>
                <tr>
                    <td>Jenjang</td>
                    <td>:</td>
                    <td>{{ $pengajuan->auditee->jenjang }}</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>:</td>
                    <td>{{ $pengajuan->auditee->fakultas }}</td>
                </tr>
                @if ($pengajuan->auditee->jenis_unit_kerja == "prodi")
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{ $pengajuan->auditee->nama_unit_kerja }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Ketua Tim Auditor</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuan->auditors as $auditor)
                            @if($auditor->role == 'ketua')
                                {{ $auditor->auditor->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Anggota</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuan->auditors as $auditor)
                            @if($auditor->role == 'pendamping')
                                {{ $auditor->auditor->name }}@if(!$loop->last), @endif
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Anggota Pendamping</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuan->auditors as $auditor)
                            @if($auditor->role == 'pendamping_kedua')
                                {{ $auditor->auditor->name }}@if(!$loop->last), @endif
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><b>Lembaga Penjaminan Mutu dan Pengembangan Pembelajaran</b></td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">I. PENDAHULUAN</div>

        <div class="section">
            <div class="section-title">II. HASIL PENILAIAN</div>
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

    <div class="section">
        <table style="width: 100%; margin-top: 30px;">
            <tr>
                <td style="width: 50%; vertical-align: top; border: none;">
                    <p style="margin-bottom: 80px;">Ketua Auditor</p>
                    @foreach($pengajuan->auditors as $auditor)
                        @if($auditor->role == 'ketua')
                            <p>{{ $auditor->auditor->name }}</p>
                        @endif
                    @endforeach
                </td>
                <td style="width: 50%; vertical-align: top; border: none;">
                    <p style="margin-bottom: 80px;">Auditee</p>
                    <p>{{ $pengajuan->auditee->name }}</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
