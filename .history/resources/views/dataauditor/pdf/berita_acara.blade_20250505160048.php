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
            margin-top: 60px;
            text-align: center;
            width: 100%;
        }
        .ttd td {
            padding-top: 50px;
            width: 50%;
        }
        .details-table {
            margin-bottom: 20px;
        }
        .details-table td {
            padding: 5px 0;
            vertical-align: top;
        }
        .details-table td:first-child {
            width: 35%;
            padding-right: 10px;
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
    </style>
</head>
<body>

    <!-- Header Table -->
    <table class="bordered header-table" style="margin-bottom: 25px;">
        <tr>
            <td rowspan="4" style="width: 20%;">
                <img src="{{ asset('assets/src/images/logo_unib.png') }}" alt="Logo" class="logo">
            </td>
            <td rowspan="2" style="width: 40%;">
                UNIVERSITAS<br>BENGKULU
            </td>
            <td style="width: 40%; text-align: left; font-weight: normal;">
                Kode/No : UNIB/<br>
                SPMI/STD.D-F-09
            </td>
        </tr>
        <tr>
            <td rowspan="3">
                DOKUMEN MUTU<br>SISTEM PENJAMINAN<br>MUTU INTERNAL
            </td>
            <td style="text-align: left; font-weight: normal;">
                Tanggal : 5 Mei 2025
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-weight: normal;">
                Revisi : 0
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-weight: normal;">
                <strong>Berita Acara Audit Mutu Internal</strong>
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
        <tr>
            <td>Nama Auditor</td>
            <td>: Prof. Dr. KAMALUDIN, S.E., M.M.</td>
        </tr>
        <tr>
            <td>NIP/NIDN Auditor</td>
            <td>: 196603041998021001</td>
        </tr>
        <tr class="separator">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2" class="highlight"><strong>Telah/tidak dapat melaksanakan Audit Mutu Internal (AMI):</strong></td>
        </tr>
        <tr class="separator">
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>Nama Ka. Prodi/Perwakilan</td>
            <td>: x</td>
        </tr>
        <tr>
            <td>NIP/NIDN</td>
            <td>: 988765263789876456</td>
        </tr>
        <tr>
            <td>Program Studi/Jurusan</td>
            <td>: xyz</td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>: Keguruan dan Ilmu Pendidikan</td>
        </tr>
        <tr>
            <td>Catatan Pelaksanaan Audit</td>
            <td>: tes</td>
        </tr>
    </table>

    <!-- Penutup -->
    <div class="section">
        Telah melaksanakan Audit Mutu Internal (AMI).
    </div>

    <!-- Tanda Tangan -->
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

</body>
</html>
