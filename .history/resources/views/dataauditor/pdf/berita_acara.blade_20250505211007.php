<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Audit Mutu Internal</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #000;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }
        .header-logo {
            width: 100px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            background-color: #e0e0e0;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 13px;
            text-align: center;
            margin-bottom: 25px;
        }
        .details-table td {
            padding: 5px;
            vertical-align: top;
        }
        .details-table td:first-child {
            width: 30%;
        }
        .details-table td:nth-child(2) {
            width: 5%;
        }
        .details-table td:nth-child(3) {
            width: 65%;
        }
        .section-heading {
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 5px 8px;
            margin: 15px 0 10px;
            border-left: 4px solid #999;
        }
        .ttd-table {
            margin-top: 40px;
            text-align: center;
        }
        .ttd-table td {
            width: 50%;
            padding: 40px 10px 0;
        }
        .separator {
            height: 20px;
        }
        .justify {
            text-align: justify;
        }
        .keep-together {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td rowspan="4" style="text-align: center;">
                <img src="{{ public_path('assets/src/images/logo_unib.png') }}" alt="Logo UNIB" class="header-logo">
            </td>
            <td rowspan="2" style="text-align: center; font-weight: bold;">
                UNIVERSITAS BENGKULU
            </td>
            <td>Kode/No: UNIB/<br>SPMI/STD.D-F-09</td>
        </tr>
        <tr>
            <td>Tanggal: 5 Mei 2025</td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center; font-weight: bold;">
                DOKUMEN MUTU<br>SISTEM PENJAMINAN MUTU INTERNAL
            </td>
            <td>Revisi: 0</td>
        </tr>
        <tr>
            <td><strong>Berita Acara Audit Mutu Internal</strong></td>
        </tr>
    </table>

    <!-- Title -->
    <div class="title">Berita Acara Audit Mutu Internal</div>
    <div class="subtitle">UNIB/SPMI/STD.D-F-09</div>

    <!-- Isi -->
    <div class="section">
        Dengan ini dinyatakan bahwa pada tanggal <strong>5 Mei 2025</strong>, telah dilaksanakan Audit Mutu Internal oleh:
    </div>

    <!-- Tabel Auditor -->
    <table class="details-table">
        <tr class="keep-together">
            <td>Nama Auditor</td>
            <td>:</td>
            <td>Prof. Dr. KAMALUDIN, S.E., M.M.</td>
        </tr>
        <tr class="keep-together">
            <td>NIP/NIDN Auditor</td>
            <td>:</td>
            <td>196603041998021001</td>
        </tr>
    </table>

    <!-- Audit Info -->
    <div class="section-heading">Telah melaksanakan Audit Mutu Internal (AMI):</div>

    <!-- Tabel Auditee -->
    <table class="details-table">
        <tr class="keep-together">
            <td>Nama Ka. Prodi/Perwakilan</td>
            <td>:</td>
            <td>Nama Kepala Prodi Akuntansi</td>
        </tr>
        <tr class="keep-together">
            <td>NIP/NIDN</td>
            <td>:</td>
            <td>988765263789876456</td>
        </tr>
        <tr class="keep-together">
            <td>Program Studi/Jurusan</td>
            <td>:</td>
            <td>Nama Program Studi</td>
        </tr>
        <tr class="keep-together">
            <td>Fakultas</td>
            <td>:</td>
            <td>Keguruan dan Ilmu Pendidikan</td>
        </tr>
        <tr>
            <td>Catatan Pelaksanaan Audit</td>
            <td>:</td>
            <td class="justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
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
            <td>(Prof. Dr. KAMALUDIN, S.E., M.M.)</td>
            <td>(Nama Kepala Prodi Akuntansi)</td>
        </tr>
    </table>

</body>
</html>
