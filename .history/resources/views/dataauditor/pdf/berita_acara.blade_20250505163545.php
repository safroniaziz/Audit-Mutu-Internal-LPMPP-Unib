<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Audit Mutu Internal</title>
    <style>
        body {
            font-family: 'Arial', 'DejaVu Sans', sans-serif;
            font-size: 12px;
            margin: 40px;
            line-height: 1.5;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .bordered td, .bordered th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }
        .header-table td {
            text-align: center;
            font-weight: bold;
        }
        .logo {
            width: 90px;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin: 15px 0 5px 0;
        }
        .sub-title {
            text-align: center;
            font-size: 14px;
            margin-bottom: 25px;
            color: #444;
        }
        .section {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .ttd {
            text-align: center;
            width: 100%;
        }
        .ttd td {
            width: 50%;
        }
        .details-table {
            margin-bottom: 20px;
            width: 100%;
            page-break-inside: avoid; /* Mencegah pemisahan tabel antar halaman */
        }
        .details-table tr {
            page-break-inside: avoid; /* Mencegah pemisahan baris antar halaman */
            page-break-after: auto;
        }
        .details-table tr td:first-child {
            width: 35%;
            vertical-align: top;
            padding: 5px 10px 5px 0;
        }
        .details-table tr td:nth-child(2) {
            width: 5%;
            vertical-align: top;
            padding: 5px 5px 5px 0;
            white-space: nowrap;
        }
        .details-table tr td:nth-child(3) {
            width: 60%;
            vertical-align: top;
            padding: 5px 0;
            text-align: justify;
        }
        .highlight {
            background-color: #f9f9f9;
            padding: 10px;
            margin: 15px 0;
            border-left: 3px solid #ddd;
        }
        .separator {
            height: 15px;
        }
        .keep-together {
            page-break-inside: avoid; /* Mencegah pemisahan elemen */
        }
        .page-break {
            page-break-before: always; /* Memaksa halaman baru */
        }
    </style>
</head>
<body>

    <!-- Header Table -->
    <table class="bordered header-table" style="margin-bottom: 25px; border-collapse: collapse; width: 100%;">
        <tr>
            <td rowspan="4" style="width: 20%; vertical-align: middle; text-align: center; border: 1px solid #ddd; padding: 5px;">
                <img src="{{ public_path('assets/src/images/logo_unib.png') }}" alt="Logo" class="logo" style="width: 120px; height: auto;">
            </td>
            <td rowspan="2" style="width: 40%; vertical-align: middle; text-align: center; border: 1px solid #ddd; padding: 5px;">
                UNIVERSITAS<br>BENGKULU
            </td>
            <td style="width: 40%; text-align: left; font-weight: normal; border: 1px solid #ddd; padding: 5px;">
                Kode/No : UNIB/<br>SPMI/STD.D-F-09
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-weight: normal; border: 1px solid #ddd; padding: 5px;">
                Tanggal : 5 Mei 2025
            </td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid #ddd; padding: 5px;">
                DOKUMEN MUTU<br>SISTEM PENJAMINAN<br>MUTU INTERNAL
            </td>
            <td style="text-align: left; font-weight: normal; border: 1px solid #ddd; padding: 5px;">
                Revisi : 0
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-weight: bold; border: 1px solid #ddd; padding: 5px;">
                Berita Acara Audit Mutu Internal
            </td>
        </tr>
    </table>

    <!-- Title -->
    <div class="title">Berita Acara Audit Mutu Internal</div>
    <div class="sub-title">UNIB/SPMI/STD.D-F-09</div>

    <!-- Deskripsi -->
    <div class="section">
        Dengan ini dinyatakan bahwa pada tanggal <strong>5 Mei 2025</strong>, Auditor:
    </div>

    <!-- Detail Auditor & Auditee -->
    <table class="details-table">
        <!-- Baris Auditor - Dijaga tetap satu halaman -->
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

        <tr class="separator">
            <td colspan="3"></td>
        </tr>

        <!-- Baris AMI -->
        <tr>
            <td colspan="3" class="highlight"><strong>Telah melaksanakan Audit Mutu Internal (AMI):</strong></td>
        </tr>

        <tr class="separator">
            <td colspan="3"></td>
        </tr>

        <!-- Baris Auditee -->
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

        <!-- Baris Catatan - Boleh pindah halaman jika diperlukan -->
        <tr>
            <td>Catatan Pelaksanaan Audit</td>
            <td>:</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
        </tr>
    </table>

    <!-- Tanda Tangan -->
    <div class="keep-together">
        <table class="ttd">
            <tr>
                <td>Auditor</td>
                <td>Auditee</td>
            </tr>
            <tr>
                <td>(Prof. Dr. KAMALUDIN, S.E., M.M.)</td>
                <td>(x)</td>
            </tr>
        </table>
    </div>

</body>
</html>
