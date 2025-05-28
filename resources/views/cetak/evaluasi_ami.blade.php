<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Evaluasi Audit Mutu Internal</title>
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
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/src/images/logo_unib.png') }}" alt="Logo UNIB">
        <h2>EVALUASI AUDIT MUTU INTERNAL</h2>
        <p>{{ $pengajuan->auditee->jenis_unit_kerja == "prodi" ? 'PROGRAM STUDI' : 'FAKULTAS' }} {{ $pengajuan->auditee->nama_unit_kerja }}</p>
    </div>

    <div class="content">
        <table>
            <tr>
                <td width="30%">Tanggal Evaluasi</td>
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

        <h3>Hasil Evaluasi:</h3>
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
                @foreach($pengajuan->ikssAuditee as $index => $ikss)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ikss->kode }}</td>
                        <td>{{ $ikss->sasaran }}</td>
                        <td>{{ $ikss->nilai_ketua ?? 0 }}</td>
                        <td>{{ $ikss->nilai_anggota ?? 0 }}</td>
                        <td>{{ ($ikss->nilai_ketua ?? 0) + ($ikss->nilai_anggota ?? 0) }}</td>
                        <td>{{ number_format((($ikss->nilai_ketua ?? 0) + ($ikss->nilai_anggota ?? 0)) / 2, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
