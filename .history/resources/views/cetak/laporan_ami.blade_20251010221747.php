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

        /* Fix untuk tabel saran perbaikan */
        .saran-perbaikan-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            table-layout: fixed; /* Paksa lebar kolom tetap */
        }

        .saran-perbaikan-table th,
        .saran-perbaikan-table td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word; /* Pecah kata panjang */
            word-break: break-word; /* Pecah kata panjang */
            overflow-wrap: break-word; /* Support browser lama */
            white-space: normal; /* Allow wrapping */
            vertical-align: top; /* Align ke atas */
        }

        .saran-perbaikan-table .col-no {
            width: 5%; /* Kolom nomor sempit */
        }

        .saran-perbaikan-table .col-bidang {
            width: 15%; /* Kolom bidang sedang */
        }

        .saran-perbaikan-table .col-kelebihan {
            width: 40%; /* Kolom kelebihan lebar */
        }

        .saran-perbaikan-table .col-peluang {
            width: 40%; /* Kolom peluang peningkatan lebar */
        }

        .saran-perbaikan-table th {
            background-color: #00447c;
            color: white;
            font-weight: bold;
            font-size: 11px;
            font-family: 'Roboto', sans-serif !important;
        }

        .saran-perbaikan-table td {
            font-size: 11px;
            line-height: 1.4;
        }

        .saran-perbaikan-table tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        /* Fix untuk tabel temuan audit */
        .temuan-audit-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            table-layout: fixed;
        }

        .temuan-audit-table th,
        .temuan-audit-table td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            vertical-align: top;
        }

        .temuan-audit-table .col-no-temuan {
            width: 5%;
        }

        .temuan-audit-table .col-kts {
            width: 15%;
        }

        .temuan-audit-table .col-referensi {
            width: 25%;
        }

        .temuan-audit-table .col-pernyataan {
            width: 55%;
        }

        .temuan-audit-table th {
            background-color: #00447c;
            color: white;
            font-weight: bold;
            font-size: 11px;
            font-family: 'Roboto', sans-serif !important;
        }

        .temuan-audit-table td {
            font-size: 11px;
            line-height: 1.4;
        }

        .temuan-audit-table tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        /* Fix untuk tabel hasil penilaian RSB */
        .rsb-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            table-layout: fixed;
        }

        .rsb-table th,
        .rsb-table td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            vertical-align: top;
        }

        .rsb-table .col-no-rsb {
            width: 5%;
        }

        .rsb-table .col-ikss {
            width: 15%;
        }

        .rsb-table .col-indikator {
            width: 35%;
        }

        .rsb-table .col-ketua,
        .rsb-table .col-anggota,
        .rsb-table .col-total,
        .rsb-table .col-rata {
            width: 11.25%; /* 45% / 4 kolom = 11.25% each */
            text-align: center;
        }

        .rsb-table th {
            background-color: #00447c;
            color: white;
            font-weight: bold;
            font-size: 11px;
            font-family: 'Roboto', sans-serif !important;
        }

        .rsb-table td {
            font-size: 11px;
            line-height: 1.4;
        }

        .rsb-table tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        /* Fix untuk tabel kesimpulan audit dan tabel lainnya */
        .kesimpulan-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            table-layout: fixed;
        }

        .kesimpulan-table th,
        .kesimpulan-table td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            text-align: left;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            vertical-align: top;
        }

        .kesimpulan-table .col-no-kesimpulan {
            width: 5%;
            text-align: center;
        }

        .kesimpulan-table .col-pertanyaan {
            width: 75%;
        }

        .kesimpulan-table .col-jawaban {
            width: 20%;
            text-align: center;
        }

        .kesimpulan-table th {
            background-color: #00447c;
            color: white;
            font-weight: bold;
            font-size: 11px;
            font-family: 'Roboto', sans-serif !important;
        }

        .kesimpulan-table td {
            font-size: 11px;
            line-height: 1.4;
        }

        .kesimpulan-table tr:nth-child(even) {
            background-color: #f7f9fc;
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
                {{-- <img src="{{ public_path('storage/' . $penugasan->auditor->ttd) }}" alt="TTD pendamping" style="max-height: 50px;"> --}}
            @endif
        @endforeach
    </td>

    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">Tanda Tangan Auditor</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 6px;">:</td>
    <td style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; height: 80px; min-width: 120px;">
        @foreach($pengajuanAmis->auditors as $penugasan)
            @if($penugasan->role == 'pendamping')
                {{-- <img src="{{ public_path('storage/' . $penugasan->auditor->ttd) }}" alt="TTD pendamping" style="max-height: 50px;"> --}}
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
            {{-- <img src="{{ $pathTtd }}" alt="TTD Auditee" style="max-height: 50px;"> --}}
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
        <table class="temuan-audit-table">
            <thead>
                <tr>
                    <th class="col-no-temuan">No</th>
                    <th class="col-kts">KTS/OB (Initial Auditor)</th>
                    <th class="col-referensi">Referensi (butir mutu)</th>
                    <th class="col-pernyataan">Pernyataan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuanAmis->ikssAuditee as $index => $ikssAuditee)
                    <tr>
                        <td class="col-no-temuan">{{ $index+1 }}</td>
                        <td class="col-kts">{{ optional($ikssAuditee->visitasi->first())->ketidak_sesuaian ?: '-' }}</td>
                        <td class="col-referensi">{{ $ikssAuditee->instrumen->indikator }}</td>
                        <td class="col-pernyataan">{{ optional($ikssAuditee->visitasi->first())->pernyataan ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-weight: bold; font-size:14px; color:#00447c;">2. Saran Perbaikan</p>
        <table class="saran-perbaikan-table">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-bidang">Bidang</th>
                    <th class="col-kelebihan">Kelebihan</th>
                    <th class="col-peluang">Peluang Peningkatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuanAmis->ikssAuditee as $index => $ikssAuditee)
                    <tr>
                        <td class="col-no">{{ $index+1 }}</td>
                        <td class="col-bidang">{{ $ikssAuditee->instrumen->satuan }}</td>
                        <td class="col-kelebihan">{{ optional($ikssAuditee->visitasi->first())->kelebihan ?: '-' }}</td>
                        <td class="col-peluang">{{ optional($ikssAuditee->visitasi->first())->peluang_peningkatan ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-weight: bold; font-size:14px; color:#00447c;">3. Hasil Penilaian RSB</p>
        <table class="rsb-table">
            <thead>
                <tr>
                    <th rowspan="2" class="col-no-rsb">No</th>
                    <th rowspan="2" class="col-ikss">IKSS</th>
                    <th rowspan="2" class="col-indikator">Indikator</th>
                    <th colspan="4" style="text-align:center;">Penilaian Auditor</th>
                </tr>
                <tr>
                    <th class="col-ketua">Ketua</th>
                    <th class="col-anggota">Anggota</th>
                    <th class="col-total">Total</th>
                    <th class="col-rata">Rata-Rata</th>
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
                        <td class="col-no-rsb">{{ $index + 1 }}</td>
                        <td class="col-ikss">{{ $ikssAuditee->instrumen->indikatorKinerja->kode_ikss }}</td>
                        <td class="col-indikator">{{ $ikssAuditee->instrumen->indikator }}</td>

                        {{-- Kolom Ketua --}}
                        <td class="col-ketua">
                            @if($nilaiKetua)
                                {{ $nilaiKetua->nilai }}
                            @else
                                <span style="color:red;">-</span>
                            @endif
                        </td>

                        {{-- Kolom Anggota --}}
                        <td class="col-anggota">
                            @if($nilaiAnggota)
                                {{ $nilaiAnggota->nilai }}
                            @else
                                <span style="color:red;">-</span>
                            @endif
                        </td>

                        {{-- Total --}}
                        <td class="col-total">
                            {{ $nilaiTotal }}
                        </td>

                        {{-- Rata-rata --}}
                        <td class="col-rata">
                            {{ number_format($nilaiRataRata, 2) }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="section-title" style="margin-top: 30px !important;">VI. KESIMPULAN AUDIT</div>
        <p>Hasil evaluasi yang dilakukan oleh tim audit menghasilkan kesimpulan sebagai berikut:</p>

        <table class="kesimpulan-table">
            <thead>
                <tr>
                    <th class="col-no-kesimpulan">No.</th>
                    <th class="col-pertanyaan">Pertanyaan</th>
                    <th class="col-jawaban">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jawabanKuisioner as $index => $item)
                    <tr>
                        <td class="col-no-kesimpulan">{{ $index + 1 }}</td>
                        <td class="col-pertanyaan">{{ $item->kuisioner->pertanyaan }}</td>
                        <td class="col-jawaban"><strong>{{ $item->opsi->opsi }}</strong></td>
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

        @php
            // Radar SS tepat di bawah tabel SS, samakan dengan unduh_dokumen (filter has_data)
            $ssLabels = [];
            $ssValues = [];
            $ssItems = collect($sortedGrouped ?? [])->filter(function($i){ return !empty($i['has_data']); })->values();
            foreach ($ssItems as $item) {
                $ssLabels[] = $item['kode_satuan'];
                $ssValues[] = round((float)($item['rata_rata'] ?? 0), 2);
            }
            $ssConfig = [
                'type' => 'radar',
                'data' => [
                    'labels' => $ssLabels,
                    'datasets' => [[
                        'label' => 'Nilai Sasaran Strategis',
                        'data' => $ssValues,
                        'fill' => true,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'pointBackgroundColor' => 'rgba(54, 162, 235, 1)',
                        'pointBorderColor' => '#fff',
                        'pointHoverBackgroundColor' => '#fff',
                        'pointHoverBorderColor' => 'rgba(54, 162, 235, 1)',
                        'pointRadius' => 3,
                        'pointHoverRadius' => 5,
                        'tension' => 0.2
                    ]],
                ],
                'options' => [
                    'responsive' => true,
                    'maintainAspectRatio' => true,
                    'elements' => [ 'line' => [ 'borderWidth' => 2 ] ],
                    'scales' => [
                        'r' => [
                            'min' => 0,
                            'max' => 4,
                            'beginAtZero' => true,
                            'angleLines' => [ 'display' => true, 'color' => 'rgba(210,210,210,0.5)', 'lineWidth' => 1 ],
                            'grid' => [ 'color' => 'rgba(210,210,210,0.5)', 'circular' => true, 'lineWidth' => 1 ],
                            'ticks' => [ 'stepSize' => 1, 'backdropColor' => 'transparent', 'color' => '#666', 'font' => ['size' => 10] ],
                            'pointLabels' => [ 'font' => ['size' => 10, 'weight' => 'bold'], 'color' => '#333', 'padding' => 15 ],
                        ]
                    ],
                    'plugins' => [
                        'legend' => [ 'position' => 'bottom', 'labels' => [ 'boxWidth' => 12, 'padding' => 15, 'font' => ['size' => 11] ] ],
                    ],
                ],
            ];
            $qcBase = 'https://quickchart.io/chart';
            $ssUrl = $qcBase . '?version=4&width=700&height=500&backgroundColor=white&c=' . urlencode(json_encode($ssConfig, JSON_UNESCAPED_SLASHES));
        @endphp
        @if(!empty($ssLabels))
            <div style="margin: 10px 0 30px;">
                <div style="font-weight:bold; margin-bottom:8px;">Grafik Penilaian Sasaran Strategis</div>
                <img src="{{ $ssUrl }}" alt="Radar Sasaran Strategis" style="width:100%; max-width:100%;">
            </div>
        @endif

        @if(isset($kriteriaScores) && count($kriteriaScores) > 0)
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
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $kriteria['kode_kriteria'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: left;">{{ $kriteria['nama_kriteria'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ number_format($kriteria['total_nilai_ketua'], 2) }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ number_format($kriteria['total_nilai_anggota'], 2) }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ number_format($kriteria['total_nilai'], 2) }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $kriteria['jumlah_penilaian'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ number_format($kriteria['rata_rata'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            // Radar Prodi tepat di bawah tabel Prodi
            $prodiLabels = [];
            $prodiValues = [];
            foreach (($kriteriaScores ?? []) as $item) {
                $prodiLabels[] = $item['kode_kriteria'] ?? '';
                $prodiValues[] = round((float)($item['rata_rata'] ?? 0), 2);
            }
            $prodiConfig = [
                'type' => 'radar',
                'data' => [
                    'labels' => $prodiLabels,
                    'datasets' => [[
                        'label' => 'Nilai Instrumen Prodi',
                        'data' => $prodiValues,
                        'fill' => true,
                        'backgroundColor' => 'rgba(40, 167, 69, 0.2)',
                        'borderColor' => 'rgba(40, 167, 69, 1)',
                        'pointBackgroundColor' => 'rgba(40, 167, 69, 1)',
                        'pointBorderColor' => '#fff',
                        'pointHoverBackgroundColor' => '#fff',
                        'pointHoverBorderColor' => 'rgba(40, 167, 69, 1)',
                        'pointRadius' => 3,
                        'pointHoverRadius' => 5,
                        'tension' => 0.2
                    ]],
                ],
                'options' => [
                    'responsive' => true,
                    'maintainAspectRatio' => true,
                    'elements' => [ 'line' => [ 'borderWidth' => 2 ] ],
                    'scales' => [
                        'r' => [
                            'min' => 0,
                            'max' => 4,
                            'beginAtZero' => true,
                            'angleLines' => [ 'display' => true, 'color' => 'rgba(210,210,210,0.5)', 'lineWidth' => 1 ],
                            'grid' => [ 'color' => 'rgba(210,210,210,0.5)', 'circular' => true, 'lineWidth' => 1 ],
                            'ticks' => [ 'stepSize' => 1, 'backdropColor' => 'transparent', 'color' => '#666', 'font' => ['size' => 10] ],
                            'pointLabels' => [ 'font' => ['size' => 10, 'weight' => 'bold'], 'color' => '#333', 'padding' => 15 ],
                        ]
                    ],
                    'plugins' => [
                        'legend' => [ 'position' => 'bottom', 'labels' => [ 'boxWidth' => 12, 'padding' => 15, 'font' => ['size' => 11] ] ],
                    ],
                ],
            ];
            $qcBase = 'https://quickchart.io/chart';
            $prodiUrl = $qcBase . '?version=4&width=700&height=500&backgroundColor=white&c=' . urlencode(json_encode($prodiConfig, JSON_UNESCAPED_SLASHES));
        @endphp
        @if(!empty($prodiLabels))
            <div style="margin: 10px 0 30px;">
                <div style="font-weight:bold; margin-bottom:8px;">Grafik Penilaian Instrumen Prodi</div>
                <img src="{{ $prodiUrl }}" alt="Radar Instrumen Prodi" style="width:100%; max-width:100%;">
            </div>
        @endif
        @endif

        <div class="signature-section">
            <div class="signature-right">
                <p class="date">Bengkulu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <div class="footer">
            <p>Dibuat pada {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }} WIB</p>
            <p>Sistem Integrasi Mutu UNIB Universitas Bengkulu</p>
        </div>
    </div>

</body>
</html>
