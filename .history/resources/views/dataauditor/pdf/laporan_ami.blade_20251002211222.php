<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Audit Mutu Internal</title>
    <style>
        /* @page {
            margin: 8mm 8mm 8mm 8mm;
        } */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        * {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif;
        }

        .document-container {
            width: 100%;
            margin: 0;
            background-color: #fff;
            padding: 0;
        }

        .header-table {
            margin-bottom: 25px;
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header-table td {
            border: 1px solid #ddd;
            padding: 2px 12px;
        }

        .logo-cell {
            width: 20%;
            vertical-align: middle;
            text-align: center;
            background-color: #f8f8f8;
        }

        .title-cell {
            width: 40%;
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            color: #00447c;
            background-color: #f8f8f8;
        }

        .info-cell {
            width: 40%;
            text-align: left;
            font-weight: normal;
            background-color: #fcfcfc;
        }

        .info-cell-highlight {
            background-color: #e6f0ff;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #00447c;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #00447c;
            letter-spacing: 0.5px;
            font-family: 'Roboto', sans-serif !important;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
            font-family: 'Roboto', sans-serif !important;
        }

        .section {
            margin: 10px 0px;
            line-height: 1.5;
        }

        .details-table td {
            vertical-align: top;
            padding: 4px 6px;
        }

        .details-table td:first-child {
            width: 30%;
        }

        .details-table td:nth-child(2) {
            width: 2%;
        }

        .details-table tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        .ttd-table {
            margin-top: 40px;
            width: 100%;
            text-align: center;
        }

        .ttd-table td {
            padding-top: 60px;
            width: 50%;
        }

        .blue-box {
            background-color: #e6f0ff;
            padding: 8px;
            border-left: 3px solid #007bff;
            font-weight: bold;
        }

        .separator {
            height: 10px;
        }

        .section-title {
            font-size: 16px;
            margin-top: 10px;
            color: #00447c;
            font-weight: bold;
            border-bottom: 2px solid #00447c;
            padding-bottom: 8px;
            position: relative;
            font-family: 'Roboto', sans-serif !important;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: #ff9800;
        }



        .tujuanAudit tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        .pendahuluan tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        .lingkupAudit tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        .signature-section {
            margin-top: 50px;
            position: relative;
            min-height: 150px;
        }

        .signature-right {
            width: 250px;
            position: absolute;
            right: 0;
            text-align: center;
            font-family: 'Roboto', sans-serif !important;
        }

        .date {
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif !important;
        }

        .signature {
            text-decoration: underline;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 80px;
            font-family: 'Roboto', sans-serif !important;
        }

        .check-mark {
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
            font-family: "DejaVu Sans", Arial, sans-serif; /* Fonts with better symbol support */
        }

        .check-mark:before {
            content: "✓";
            font-family: "DejaVu Sans", Arial, sans-serif;
        }

        .page-break {
            page-break-before: always;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 11px;
            color: #777;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-family: 'Roboto', sans-serif !important;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="document-container">
        <table class="header-table" style="margin-top: 0;">
            <tr>
                <td rowspan="4" class="logo-cell">
                    <img src="{{ public_path('assets/src/images/logo_unib.png') }}" alt="Logo UNIB" style="width: 90px; height: auto;">
                </td>
                <td rowspan="2" class="title-cell">
                    UNIVERSITAS<br>BENGKULU
                </td>
                <td class="info-cell">
                    <strong>Kode/No:</strong> {{ $periodeAktif->nomor_surat }}
                </td>
            </tr>
            <tr>
                <td class="info-cell">
                    <strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="title-cell">
                    DOKUMEN MUTU<br>SISTEM PENJAMINAN<br>MUTU INTERNAL
                </td>
                <td class="info-cell">
                    <strong>Revisi:</strong> 0
                </td>
            </tr>
            <tr>
                <td class="info-cell info-cell-highlight">
                    LAPORAN AUDIT MUTU INTERNAL
                </td>
            </tr>
        </table>

        <div class="header">
            <h1>LAPORAN AUDIT MUTU INTERNAL <br> (AMI) <br> {{ $pengajuanAmis->auditee->jenis_unit_kerja == "prodi" ? 'PROGRAM STUDI' : 'FAKULTAS' }}</h1>
            <p>{{ $periodeAktif->nomor_surat }}</p>
        </div>

        <!-- Informasi Auditor -->
        <table class="details-table" style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width: 20%;">Jenjang</td>
                    <td style="width: 2%;">:</td>
                    <td>{{ $pengajuanAmis->auditee->jenjang }}</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>:</td>
                    <td>{{ $pengajuanAmis->auditee->fakultas }}</td>
                </tr>
                @if ($pengajuanAmis->auditee->jenis_unit_kerja == "prodi")
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{ $pengajuanAmis->auditee->nama_unit_kerja }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Ketua Tim Auditor</td>
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
                    <td>Anggota</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping')
                                {{ $penugasan->auditor->name }}@if(!$loop->last), @endif
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Anggota Pendamping</td>
                    <td>:</td>
                    <td>
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping_kedua')
                                {{ $penugasan->auditor->name }}@if(!$loop->last), @endif
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Siklus/Tahun</td>
                    <td>:</td>
                    <td>{{ $periodeAktif->siklus.'/'.$periodeAktif->tahun_ami }}</td>
                </tr>
                <tr>
                    <td colspan="3"><b>Lembaga Penjaminan Mutu dan Pengembangan Pembelajaran</b></td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">I. PENDAHULUAN</div>

        <table class="pendahuluan" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 12px; margin-top:10px;">
            <tbody>
                <tr>
                    <td style="width: 20%; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Fakultas</td>
                    <td style="width: 2%; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="7">{{ $pengajuanAmis->auditee->fakultas }}</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Program Studi</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="7">{{ $pengajuanAmis->auditee->nama_unit_kerja }}</td>
                </tr>
                <tr style="">
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Alamat</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="7">-</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Ketua {{ $pengajuanAmis->auditee->jenis_unit_kerja =="prodi" ? 'Program Studi' : 'Fakultas' }}</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="1">{{ $pengajuanAmis->auditee->nama_ketua }}</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Telp</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="4">{{ $pengajuanAmis->auditee->no_hp }}</td>
                </tr>
                <tr style="">
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Tanggal Audit</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="7">{{ $pengajuanAmis->waktu }}</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" rowspan="2">Ketua Auditor</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" rowspan="2">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" rowspan="2">
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'ketua')
                                {{ $penugasan->auditor->name }}
                            @endif
                        @endforeach
                    </td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Fakultas/Prodi</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; width:2%; padding: 6px;">:</td>
                    <td colspan="4" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'ketua')
                                {{ $penugasan->auditor->unitKerja ? $penugasan->auditor->unitKerja->nama_unit_kerja : '-' }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr style="">
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Telp</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td colspan="4" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'ketua')
                                {{ $penugasan->auditor->unitKerja ? $penugasan->auditor->unitKerja->no_hp : '-' }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" rowspan="2">Anggota Auditor</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" rowspan="2">:</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" rowspan="2">
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping')
                                {{ $penugasan->auditor->name }}
                            @endif
                        @endforeach
                    </td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Fakultas/Prodi</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; width:2%; padding: 6px;">:</td>
                    <td colspan="4" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping')
                                {{ $penugasan->auditor->unitKerja ? $penugasan->auditor->unitKerja->nama_unit_kerja : '-' }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr style="">
                    <td cols style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Telp</td>
                    <td cols style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
                    <td colspan="4" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">
                        @foreach($pengajuanAmis->auditors as $penugasan)
                            @if($penugasan->role == 'pendamping')
                                {{ $penugasan->auditor->unitKerja ? $penugasan->auditor->unitKerja->no_hp : '-' }}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Tanda Tangan Ketua Auditor</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; height: 80px; min-width: 120px;">
        @foreach($pengajuanAmis->auditors as $penugasan)
            @if($penugasan->role == 'ketua')
                @php
                    $pathTtdKetua = public_path('storage/' . $penugasan->auditor->ttd);
                @endphp
                @if (file_exists($pathTtdKetua) && is_file($pathTtdKetua))
                    <img src="{{ $pathTtdKetua }}" alt="TTD Ketua" style="max-height: 50px;">
                @else
                    <span>-</span>
                @endif
            @endif
        @endforeach
    </td>

    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Tanda Tangan Auditor</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; height: 80px; min-width: 120px;">
        @foreach($pengajuanAmis->auditors as $penugasan)
            @if($penugasan->role == 'pendamping')
                @php
                    $pathTtdPendamping = public_path('storage/' . $penugasan->auditor->ttd);
                @endphp
                @if (file_exists($pathTtdPendamping) && is_file($pathTtdPendamping))
                    <img src="{{ $pathTtdPendamping }}" alt="TTD pendamping" style="max-height: 50px;">
                @else
                    <span>-</span>
                @endif
            @endif
        @endforeach
    </td>

    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Tanda Tangan Kaprodi</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; height: 80px; min-width: 120px;">
        @php
            $pathTtd = public_path('storage/' . $pengajuanAmis->auditee->ttd);
        @endphp

        @if (file_exists($pathTtd) && is_file($pathTtd))
            <img src="{{ $pathTtd }}" alt="TTD Auditee" style="max-height: 50px;">
        @else
            <span>-</span>
        @endif
    </td>
</tr>

            </tbody>
        </table>

        <div class="page-break"></div> <!-- Halaman baru -->

        <div class="section-title">II. TUJUAN AUDIT</div>
        <p>Beri tanda <a class="check-mark"></a> pada butir yang telah dilaksanakan</p>

        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px;font-family: 'Roboto', sans-serif !important;color:white; font-weight: bold;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px;font-family: 'Roboto', sans-serif !important;color:white; font-weight: bold;">Tujuan Audit</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px;font-family: 'Roboto', sans-serif !important;color:white; font-weight: bold;">Telah Dilaksanakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tujuans as $index => $tujuan)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $tujuan->tujuan }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-title" style="margin-top:25px !important;">III. LINGKUP AUDIT</div>
        <p>Lingkup audit dalam evaluasi dokumen pelaksanaan standar (EDPS) mencakup sejumlah butir yang dirancang untuk memastikan mutu dan kesesuaian pelaksanaan program terhadap standar yang telah ditetapkan. Adapun butir-butir lingkup audit yang menjadi fokus evaluasi adalah sebagai berikut:</p>

        <table class="lingkupAudit" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px;font-family: 'Roboto', sans-serif !important;color:white; font-weight: bold;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px;font-family: 'Roboto', sans-serif !important;color:white; font-weight: bold;">Tujuan Audit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lingkupAudits as $index => $lingkupAudit)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $lingkupAudit->lingkup_audit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div> <!-- Halaman baru -->

        <div class="section-title">IV. JADWAL AUDIT</div>
        <p>Hari/Tanggal Audit : {{ \Carbon\Carbon::parse($pengajuanAmis->waktu)->translatedFormat('l, d F Y') }}</p>

        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Jam</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Kegiatan Audit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">1</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;"></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">Pembukaan & Pertemuan dengan Kaprodi</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">2</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;"></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">Pertemuan dengan Staf Dosen</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">3</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;"></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">Pertemuan dengan Karyawan</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">4</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;"></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">Pertemuan dengan Mahasiswa</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">5</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;"></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">Pertemuan dengan alumni/pengguna lulusan (jika ada)</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">6</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;"></td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">Penyampaian Temuan & Penutupan</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title" style="margin-top: 20px !important;">V. PRESENSI</div>

        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;" width="5%">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Nama</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Peran</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;" width="25%">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 10; $i++)
                    <tr>
                        <td style="padding: 18px; border: 1px solid #ddd;">{{ $i }}</td>
                        <td style="padding: 18px; border: 1px solid #ddd;"></td>
                        <td style="padding: 18px; border: 1px solid #ddd;"></td>
                        <td style="padding: 18px; border: 1px solid #ddd;"></td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="section-title" style="margin-top: 20px !important;">VI. TEMUAN AUDIT</div>

        <p style="font-weight: bold; font-size:14px; color:#00447c;">1. Ketidaksesuaian</p>
        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">KTS/OB (Initial Auditor)</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Referensi (butir mutu)	</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Pernyataan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuanAmis->ikssAuditee as $index => $ikssAuditee)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $index+1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ optional($ikssAuditee->visitasi->first())->ketidak_sesuaian }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $ikssAuditee->instrumen->indikator }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ optional($ikssAuditee->visitasi->first())->pernyataan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-weight: bold; font-size:14px; color:#00447c;">2. Saran Perbaikan</p>
        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Bidang</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Kelebihan</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Peluang Peningkatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuanAmis->ikssAuditee as $index => $ikssAuditee)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $index+1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $ikssAuditee->instrumen->satuan }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ optional($ikssAuditee->visitasi->first())->kelebihan }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ optional($ikssAuditee->visitasi->first())->peluang_peningkatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-weight: bold; font-size:14px; color:#00447c;">3. Hasil Penilaian RSB</p>
        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead>
                <tr>
                    <th rowspan="2" style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">No</th>
                    <th rowspan="2" style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">IKSS</th>
                    <th rowspan="2" style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Indikator</th>
                    <th colspan="4" style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Penilaian Auditor</th>
                </tr>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Ketua</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Anggota</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Total</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Rata-Rata</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuanAmis->ikssAuditee as $index => $ikssAuditee)
                    @php
                        $nilaiKetua = $ikssAuditee->nilai->firstWhere('auditor.penugasan.0.role', 'ketua');
                        $nilaiAnggota = $ikssAuditee->nilai->firstWhere('auditor.penugasan.0.role', 'pendamping');

                        $nilaiTotal = collect([$nilaiKetua?->nilai, $nilaiAnggota?->nilai])
                            ->filter()
                            ->sum();

                        $nilaiRataRata = collect([$nilaiKetua?->nilai, $nilaiAnggota?->nilai])
                            ->filter()
                            ->avg();
                    @endphp
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $ikssAuditee->instrumen->indikatorKinerja->kode_ikss }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $ikssAuditee->instrumen->indikator }}</td>

                        {{-- Kolom Ketua --}}
                        <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">
                            @if($nilaiKetua)
                                {{ $nilaiKetua->nilai }}
                            @else
                                <a style="color:red;">-</a>
                            @endif
                        </td>

                        {{-- Kolom Anggota --}}
                        <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">
                            @if($nilaiAnggota)
                                {{ $nilaiAnggota->nilai }}
                            @endif
                        </td>

                        {{-- Total --}}
                        <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">
                            {{ $nilaiTotal }}
                        </td>

                        {{-- Rata-rata --}}
                        <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">
                            {{ number_format($nilaiRataRata, 2) }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="section-title" style="margin-top: 30px !important;">VI. KESIMPULAN AUDIT</div>
        <p>Hasil evaluasi yang dilakukan oleh tim audit menghasilkan kesimpulan sebagai berikut:</p>

        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead >
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;" width="5%" class="text-center">No.</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Pertanyaan</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;" width="15%" class="text-center">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jawabanKuisioner as $index => $item)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;" class="text-center align-middle">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->kuisioner->pertanyaan }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;" class="text-center"><strong>{{ $item->opsi->opsi }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-title" style="margin-top: 30px !important;">VII. LAMPIRAN AUDIT</div>

        <table class="pendahuluan" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 12px; margin-top:10px;">
            <tbody>
                <tr>
                    <td style="width: 2%; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px; ">1. </td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="4">PTK ({{ $periodeAktif ? $periodeAktif->nomor_surat : '-' }})</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">2</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="4">Pemantauan PTK ({{ $periodeAktif ? $periodeAktif->nomor_surat : '-' }})</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">3</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="4">Rekap Data EDPS ({{ $periodeAktif ? $periodeAktif->nomor_surat : '-' }})</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">4</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="4">Daftar Hadir ({{ $periodeAktif ? $periodeAktif->nomor_surat : '-' }})</td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">5</td>
                    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;" colspan="4">Penilaian Instrumen Prodi ({{ $periodeAktif ? $periodeAktif->nomor_surat : '-' }})</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title" style="margin-top: 30px !important;">VIII. KETERCAPAIAN SASARAN STRATEGIS</div>

        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">No</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Kode Satuan</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Sasaran</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Total Nilai Ketua</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Total Nilai Anggota</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Total Nilai</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Jumlah Penilaian</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold; text-align:center;">Rata-Rata</th>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach ($sortedGrouped as $group)
                    @if($group['has_data'])
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $counter++ }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $group['kode_satuan'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $group['sasaran'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">{{ number_format($group['total_nilai_ketua'], 2) }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">{{ number_format($group['total_nilai_anggota'], 2) }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">{{ number_format($group['total_nilai'], 2) }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">{{ $group['jumlah_penilaian'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">{{ number_format($group['rata_rata'], 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

                <div class="section-title" style="margin-top: 30px !important;">IX. HASIL PENILAIAN INSTRUMEN PRODI</div>

        <table class="tujuanAudit" style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <thead>
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Kode Kriteria</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Nama Kriteria</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Total Nilai Ketua</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Total Nilai Anggota</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Total Nilai</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Jumlah Penilaian</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #00447c; font-size:12px; font-family: 'Roboto', sans-serif !important; color:white; font-weight: bold;">Rata-Rata</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteriaScores as $index => $kriteria)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $kriteria['kode_kriteria'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $kriteria['nama_kriteria'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            @if($kriteria['total_nilai_ketua'] > 0)
                                {{ number_format($kriteria['total_nilai_ketua'], 2) }}
                            @else
                                <span style="color: red;">-</span>
                            @endif
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            @if($kriteria['total_nilai_anggota'] > 0)
                                {{ number_format($kriteria['total_nilai_anggota'], 2) }}
                            @else
                                <span style="color: red;">-</span>
                            @endif
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            @if($kriteria['total_nilai'] > 0)
                                {{ number_format($kriteria['total_nilai'], 2) }}
                            @else
                                <span style="color: red;">-</span>
                            @endif
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            @if($kriteria['jumlah_penilaian'] > 0)
                                {{ $kriteria['jumlah_penilaian'] }}
                            @else
                                <span style="color: red;">-</span>
                            @endif
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            @if($kriteria['rata_rata'] > 0)
                                {{ number_format($kriteria['rata_rata'], 2) }}
                            @else
                                <span style="color: red;">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature-right">
                <p class="date">Bengkulu, 05 Mei 2025</p>
            </div>
        </div>

        <div class="footer">
            <p>Dibuat pada Senin, 05 Mei 2025 14:00 WIB</p>
            <p>Sistem Integrasi Mutu UNIB Universitas Bengkulu</p>
        </div>
    </div>

</body>
</html>
