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
            padding: 12px;
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
                    <strong>Kode/No:</strong> UNIB/SPMI/STD.D-F-09
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
            <h1>EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</h1>
            <p>UNIB/SPMI/STD.D-F-08</p>
        </div>
        <!-- Judul -->
        <div class="title">BERITA ACARA AUDIT MUTU INTERNAL</div>
        <div class="subtitle"></div>

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
    </div>

</body>
</html>
