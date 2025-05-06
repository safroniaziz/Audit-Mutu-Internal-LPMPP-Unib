<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Audit Mutu Internal</title>
    <style>
        body {
            font-family: 'Arial', 'DejaVu Sans', sans-serif;
            font-size: 11px;
            margin: 30px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
            font-size: 11px;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
        }

        .subtitle {
            font-size: 12px;
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
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
    </style>
</head>
<body>

    <!-- Header -->
    <table class="header-table" style="margin-bottom: 15px;">
        <tr>
            <td rowspan="4" style="width: 15%; text-align: center;">
                <img src="{{ public_path('assets/src/images/logo_unib.png') }}" class="logo">
            </td>
            <td rowspan="2" style="text-align: center; font-weight: bold;">
                UNIVERSITAS BENGKULU
            </td>
            <td style="width: 30%;">
                Kode Dokumen: UNIB/SPMI/STD.D-F-09
            </td>
        </tr>
        <tr>
            <td>
                Tanggal: 5 Mei 2025
            </td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center; font-weight: bold;">
                DOKUMEN MUTU SISTEM PENJAMINAN MUTU INTERNAL
            </td>
            <td>
                Revisi: 0
            </td>
        </tr>
        <tr>
            <td>
                Halaman: 1 dari 1
            </td>
        </tr>
    </table>

    <!-- Judul -->
    <div class="title">BERITA ACARA AUDIT MUTU INTERNAL</div>
    <div class="subtitle">UNIB/SPMI/STD.D-F-09</div>

    <!-- Deskripsi -->
    <div class="section">
        Dengan ini dinyatakan bahwa pada tanggal <strong>5 Mei 2025</strong>, telah dilaksanakan Audit Mutu Internal (AMI) oleh:
    </div>

    <!-- Informasi Auditor -->
    <table class="details-table">
        <tr>
            <td>Nama Auditor</td>
            <td>:</td>
            <td>Prof. Dr. KAMALUDIN, S.E., M.M.</td>
        </tr>
        <tr>
            <td>NIP/NIDN Auditor</td>
            <td>:</td>
            <td>196603041998021001</td>
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
            <td>Nama Kepala Prodi Akuntansi</td>
        </tr>
        <tr>
            <td>NIP/NIDN</td>
            <td>:</td>
            <td>988765263789876456</td>
        </tr>
        <tr>
            <td>Program Studi/Jurusan</td>
            <td>:</td>
            <td>Nama Program Studi</td>
        </tr>
        <tr>
            <td>Fakultas</td>
            <td>:</td>
            <td>Keguruan dan Ilmu Pendidikan</td>
        </tr>
        <tr>
            <td>Catatan Pelaksanaan Audit</td>
            <td>:</td>
            <td>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
            <td>(Nama Auditor)</td>
            <td>(Nama Auditee)</td>
        </tr>
    </table>

</body>
</html>
