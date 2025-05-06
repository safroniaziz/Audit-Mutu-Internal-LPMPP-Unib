<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Audit Mutu Internal</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Font default untuk semua elemen */
        * {
            font-family: Arial, Helvetica, sans-serif !important;
            box-sizing: border-box;
        }

        body, p, div, td, th, span, li, ul, ol, h1, h2, h3, h4, h5, h6 {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        body {
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .document-container {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #fff;
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

        .logo-cell {
            width: 20%;
            text-align: center;
            background-color: #f8f8f8;
        }

        .title-cell {
            width: 40%;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            color: #00447c;
            background-color: #f8f8f8;
        }

        .info-cell {
            width: 40%;
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
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #00447c;
            color: white;
            text-align: left;
            font-weight: 500;
        }

        tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        tr:hover {
            background-color: #f0f4f8;
        }

        .section-title {
            font-size: 16px;
            font-weight: 500;
            margin-top: 30px;
            color: #00447c;
            border-bottom: 2px solid #00447c;
            padding-bottom: 8px;
            position: relative;
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

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 11px;
            color: #777;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .risalah-container {
            margin-top: 30px;
        }

        .risalah-header {
            background-color: #f0f4f8;
            padding: 12px 15px;
            margin-bottom: 0;
            border-radius: 5px 5px 0 0;
            border-left: 5px solid #00447c;
        }

        .risalah-header h4 {
            margin: 0;
            font-size: 14px;
            font-weight: 500;
            color: #00447c;
        }

        .risalah-body {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-top: none;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .risalah-body p {
            margin: 0;
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }

        .risalah-body p + p {
            margin-top: 10px;
        }

        .no-risalah {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 15px;
            border: 1px dashed #ccc;
            background-color: #f9f9f9;
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
        }

        .date {
            margin-bottom: 20px;
        }

        .signature {
            text-decoration: underline;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 80px;
        }

        .check-mark {
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
        }

        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }

            .document-container {
                padding: 0;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="document-container">
        <table class="header-table" style="margin-top: 0;">
            <tr>
                <td rowspan="4" class="logo-cell">
                    <img src="/api/placeholder/120/120" alt="Logo UNIB" style="width: 90px; height: auto;">
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

        <div class="">Audit Prodi/Fakultas: Nama Program Studi/Fakultas</div>
        <p>Evaluasi dilakukan dengan menilai tingkat kesesuaian antara pernyataan dengan kenyataan selama pelaksanaan audit berlangsung, dengan ketentuan nilai sebagai berikut:</p>

        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Nilai</th>
                    <th>Tingkat Kesesuaian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Sangat sesuai</td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Sesuai</td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td>Kurang sesuai</td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td>Tidak sesuai</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%; text-align: center;">No</th>
                    <th rowspan="2" style="width: 70%;">Butir Evaluasi</th>
                    <th colspan="4" style="text-align: center;">Tingkat Kesesuaian</th>
                </tr>
                <tr>
                    <th style="width: 6%; text-align: center;">1</th>
                    <th style="width: 6%; text-align: center;">2</th>
                    <th style="width: 6%; text-align: center;">3</th>
                    <th style="width: 6%; text-align: center;">4</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>Tujuan pengembangan audit bermanfaat bagi pengembangan mutu institusi</td>
                    <td></td>
                    <td class="check-mark">✓</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td>Proses audit dilaksanakan sesuai dengan prosedur dan standar yang telah ditetapkan</td>
                    <td class="check-mark">✓</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td>Temuan audit mencerminkan kondisi yang sebenarnya pada unit yang diaudit</td>
                    <td class="check-mark">✓</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td>Rekomendasi yang diberikan dapat ditindaklanjuti oleh pihak teraudit</td>
                    <td class="check-mark">✓</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">Masukan Auditor</div>
        <div class="risalah-container">
            <div class="risalah-header" >
                <h4 >Materi/instrumen Audit</h4>
            </div>
            <div class="risalah-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="risalah-header" >
                <h4 >Pelaksanaan Audit</h4>
            </div>
            <div class="risalah-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="risalah-header" >
                <h4 >Saran untuk teraudit</h4>
            </div>
            <div class="risalah-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>

        <div class="signature-section">
            <div class="signature-right">
                <p class="date">Bengkulu, 05 Mei 2025</p>
                <p class="signature">{{ Auth::user()->name }}</p>
                <p>Auditor</p>
            </div>
        </div>

        <div class="footer">
            <p>Dibuat pada Senin, 05 Mei 2025 14:00 WIB</p>
            <p>Sistem Penjaminan Mutu Internal Universitas Bengkulu</p>
        </div>
    </div>
</body>
</html>
