<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Audit Mutu Internal</title>
    <style>
        @page {
            margin: 8mm 8mm 8mm 8mm;
        }
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
            font-size: 16px;
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

        .section-title {
            font-size: 16px;
            margin-top: 20px;
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

        .tableData {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .tableData th, .tableData td {
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            font-family: 'Roboto', sans-serif !important;
        }

        .tableData th {
            background-color: #00447c;
            color: white;
            text-align: left;
            font-weight: bold;
        }

        .tableData tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        .tableData tr:hover {
            background-color: #f0f4f8;
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
                    DAFTAR PERTANYAAN VISITASI OLEH AUDITOR
                </td>
            </tr>
        </table>

        <div class="header">
            <h1>FORMULIR DAFTAR PERTANYAAN</h1>
            <p>UUNIB/SPMI/STD.D-F-09</p>
        </div>

        <!-- Deskripsi -->
        <div class="section">
            Dengan ini dinyatakan bahwa pada tanggal <strong>5 Mei 2025</strong>, telah dilaksanakan Audit Mutu Internal (AMI) oleh:
        </div>

        <!-- Informasi Auditor -->
        <table class="details-table" style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width: 15%; vertical-align: top;">Hari/Tanggal</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 33%;">Senin, 5 Mei 2025</td>

                    <td style="width: 15%;">Auditee</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 33%;">Nama Auditee</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Waktu</td>
                    <td>:</td>
                    <td>10:00 WIB</td>

                    <td style="background-color: #e6f2ff; font-weight: bold; text-align:center;" colspan="3">Data Auditor</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Fakultas/Prodi</td>
                    <td>:</td>
                    <td>Nama Fakultas/Prodi</td>

                    <td>Ketua</td>
                    <td>:</td>
                    <td>Nama Auditor Ketua</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Lingkup Audit</td>
                    <td>:</td>
                    <td>[Isi Lingkup Audit]</td>

                    <td>Pendamping 1</td>
                    <td>:</td>
                    <td>Nama Auditor Pendamping 1</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>Pendamping 2</td>
                    <td>:</td>
                    <td>Nama Auditor Pendamping 2</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">DAFTAR PERTANYAAN VISITASI OLEH AUDITOR</div>
        <p>
            Daftar pertanyaan ini diajukan oleh auditor selama proses visitasi untuk menilai masing-masing indikator kinerja program studi sesuai dengan instrumen yang telah dipilih oleh auditee.
        </p>

        <table class="tableData">
            <tbody>
                <tr>
                    <th style="width: 5%; ">No</th>
                    <th style="width: 25%;">Instrumen Indikator Kinerja</th>
                    <th style="width: 25%">Pertanyaan</th>
                    <th style="">Hasil Observasi (Catatan Audit)</th>
                    <th style=" width: 10%;">S</th> <!-- Diperlebar -->
                    <th style=" width: 10%;">TS</th> <!-- Diperlebar -->
                    <th style=" width: 15%;">Catatan</th> <!-- Diperlebar -->
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td style="">1</td>
                    <td>Tujuan pengembangan audit bermanfaat bagi pengembangan mutu institusi</td>
                    <td>Tujuan pengembangan audit bermanfaat bagi pengembangan mutu institusi</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="">2</td>
                    <td>Proses audit dilaksanakan sesuai dengan prosedur dan standar yang telah ditetapkan</td>
                    <td>Proses audit dilaksanakan sesuai dengan prosedur dan standar yang telah ditetapkan</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="">3</td>
                    <td>Temuan audit mencerminkan kondisi yang sebenarnya pada unit yang diaudit</td>
                    <td>Temuan audit mencerminkan kondisi yang sebenarnya pada unit yang diaudit</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="">4</td>
                    <td>Rekomendasi yang diberikan dapat ditindaklanjuti oleh pihak teraudit</td>
                    <td>Rekomendasi yang diberikan dapat ditindaklanjuti oleh pihak teraudit</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature-right">
                <p class="date">Bengkulu, 05 Mei 2025</p>
                <p class="signature">{{ Auth::user()->name }}</p>
                <p>Auditor</p>
            </div>
        </div>

        <div class="footer">
            <p>Dibuat pada Senin, 05 Mei 2025 14:00 WIB</p>
            <p>Sistem Informasi Audit Mutu Internal Universitas Bengkulu</p>
        </div>
    </div>

</body>
</html>
