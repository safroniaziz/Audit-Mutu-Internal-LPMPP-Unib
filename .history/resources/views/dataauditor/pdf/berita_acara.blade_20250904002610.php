<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Audit Mutu Internal</title>
    <style>
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
            padding: 5px 12px;
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
            font-size: 22px;
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
            margin: 10px 0;
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
                    <strong>Kode/No:</strong> {{ $periode->nomor_surat ?? 'UNIB/SPMI/STD.D-F-09' }}
                </td>
            </tr>
            <tr>
                <td class="info-cell">
                    <strong>Tanggal:</strong> 5 Mei 2025
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="title-cell" style="font-size: 14px;">
                    DOKUMEN MUTU<br>SISTEM PENJAMINAN<br>MUTU INTERNAL
                </td>
                <td class="info-cell">
                    <strong>Revisi:</strong> 0
                </td>
            </tr>
            <tr>
                <td class="info-cell info-cell-highlight">
                    EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR
                </td>
            </tr>
        </table>

        <div class="header">
            <h1>BERITA ACARA AUDIT MUTU INTERNAL</h1>
            <p>UUNIB/SPMI/STD.D-F-09</p>
        </div>

        <!-- Deskripsi -->
        <div class="section">
            Dengan ini dinyatakan bahwa pada tanggal <strong>5 Mei 2025</strong>, telah dilaksanakan Audit Mutu Internal (AMI) oleh:
        </div>

        <!-- Informasi Auditor -->
        <table class="details-table">
            <tr>
                <td>Nama Auditor</td>
                <td>:</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <td>NIP/NIDN Auditor</td>
                <td>:</td>
                <td>{{ Auth::user()->username ?? 'N/A' }}</td>
            </tr>
        </table>

        <div class="separator"></div>

        <!-- Box AMI -->
        <div class="blue-box">
            Telah melaksanakan Audit Mutu Internal (AMI):
        </div>

        <div class="separator"></div>

        <!-- Informasi Auditee -->
        <table class="details-table">
            <tr>
                <td>Nama Ka. Prodi/Perwakilan</td>
                <td>:</td>
                <td>{{ $pengajuan->auditee->nama_ketua ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>NIP/NIDN</td>
                <td>:</td>
                <td>{{ $pengajuan->auditee->nip_ketua ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Program Studi/Jurusan</td>
                <td>:</td>
                <td>{{ $pengajuan->auditee->nama_unit_kerja ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>{{ $pengajuan->auditee->fakultas ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Catatan Pelaksanaan Audit</td>
                <td>:</td>
                <td>
                    {{ $catatan_visitasi ?? 'Tidak ada catatan' }}
                </td>
            </tr>
        </table>

        <!-- Tanda Tangan -->
        <table class="ttd-table">
            <tr>
                <td>Auditor</td>
                <td>Auditee</td>
            </tr>
            <tr>
                <td>({{ Auth::user()->name }})</td>
                <td>({{ $pengajuan->auditee->nama_unit_kerja ?? 'N/A' }})</td>
            </tr>
        </table>

        <div class="footer">
            <p>Dibuat pada {{ now()->format('l, d F Y H:i') }} WIB</p>
            <p>Sistem Integrasi Mutu UNIB Universitas Bengkulu</p>
        </div>
    </div>

</body>
</html>
