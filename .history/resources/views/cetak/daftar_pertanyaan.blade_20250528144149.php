<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pertanyaan Audit</title>
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
            text-align: center;
        }
        .details-table td {
            padding: 6px;
            border: none;
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
        <h2>DAFTAR PERTANYAAN VISITASI OLEH AUDITOR</h2>
        <p>{{ $pengajuanAmis->auditee->jenis_unit_kerja == "prodi" ? 'PROGRAM STUDI' : 'FAKULTAS' }} {{ $pengajuanAmis->auditee->nama_unit_kerja }}</p>
    </div>

    <div class="content">
        <table class="details-table" style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width: 15%; vertical-align: top;">Hari/Tanggal</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 33%;">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</td>

                    <td style="width: 15%;">Auditee</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 33%;">{{ $pengajuanAmis->auditee->nama_unit_kerja }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Waktu</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($pengajuanAmis->waktu)->format('H:i') }} WIB</td>

                    <td style="background-color: #e6f2ff; font-weight: bold; text-align:center;" colspan="3">Data Auditor</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Fakultas</td>
                    <td>:</td>
                    <td>{{ $pengajuanAmis->auditee->fakultas }}</td>

                    <td>Ketua</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'ketua')
                                {{ $penugasan->auditor->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Lingkup Audit</td>
                    <td>:</td>
                    <td></td>

                    <td>Pendamping 1</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping')
                                {{ $penugasan->auditor->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>Pendamping 2</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping_kedua')
                                {{ $penugasan->auditor->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">DAFTAR PERTANYAAN VISITASI OLEH AUDITOR</div>
        <p>
            Daftar pertanyaan ini diajukan oleh auditor selama proses visitasi untuk menilai masing-masing indikator kinerja program studi sesuai dengan instrumen yang telah dipilih oleh auditee.
        </p>

        <div class="section">
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
