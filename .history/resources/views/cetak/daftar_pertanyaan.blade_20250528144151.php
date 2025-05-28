<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pertanyaan Audit</title>
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
        .question-group {
            margin-bottom: 20px;
        }
        .question {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/src/images/logo_unib.png') }}" alt="Logo UNIB">
        <h2>DAFTAR PERTANYAAN AUDIT MUTU INTERNAL</h2>
        <p>{{ $pengajuanAmis->auditee->jenis_unit_kerja == "prodi" ? 'PROGRAM STUDI' : 'FAKULTAS' }} {{ $pengajuanAmis->auditee->nama_unit_kerja }}</p>
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
                    <td>: {{ $pengajuanAmis->auditee->nama_unit_kerja }}</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>: {{ $pengajuanAmis->auditee->fakultas }}</td>
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
                @foreach($pengajuanAmis->auditors as $auditor)
                    <tr>
                        <td>{{ ucfirst($auditor->role) }}</td>
                        <td>{{ $auditor->auditor->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="section">
            <div class="section-title">Daftar Pertanyaan:</div>
            @foreach($pengajuanAmis->ikssAuditee as $ikss)
                <div class="question-group">
                    <h4>{{ $ikss->instrumen->indikatorKinerja->satuanStandar->kode_satuan }} - {{ $ikss->instrumen->indikatorKinerja->satuanStandar->sasaran }}</h4>
                    <table>
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="65%">Pertanyaan</th>
                                <th width="30%">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($ikss->visitasi)
                                @foreach($ikss->visitasi as $index => $visitasi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $visitasi->pertanyaan }}</td>
                                        <td>{{ $visitasi->jawaban }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>

    <div class="signature">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 50%; text-align: center;">
                    Ketua Auditor<br><br><br><br>
                    @foreach($pengajuanAmis->auditors as $auditor)
                        @if($auditor->role == 'ketua')
                            {{ $auditor->auditor->name }}
                        @endif
                    @endforeach
                </td>
                <td style="border: none; width: 50%; text-align: center;">
                    Auditee<br><br><br><br>
                    {{ $pengajuanAmis->auditee->name }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
