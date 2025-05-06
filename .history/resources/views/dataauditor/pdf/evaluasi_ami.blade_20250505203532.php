<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Audit Mutu Internal</title>
    <style>
        /* Pastikan font Roboto di-load pertama kali */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        /* Reset CSS dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, "Segoe UI", Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        }

        body {
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background-color: #fff;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Perbaikan khusus untuk print */
        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }

            body {
                padding: 0;
                font-size: 11pt;
            }

            /* Pastikan font tetap Roboto saat dicetak */
            * {
                font-family: 'Roboto', -apple-system, BlinkMacSystemFont, "Segoe UI", Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important;
            }
        }

        /* Header styles */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border: 1px solid #ddd;
        }

        .header-table td {
            border: 1px solid #ddd;
            padding: 8px 12px;
        }

        .logo-cell {
            width: 20%;
            text-align: center;
            vertical-align: middle;
        }

        .title-cell {
            width: 40%;
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            color: #00447c;
            font-size: 16px;
        }

        .info-cell {
            width: 40%;
            font-weight: normal;
        }

        .info-cell-highlight {
            font-weight: bold;
            background-color: #e6f0ff;
        }

        /* Main header */
        .document-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #00447c;
        }

        .document-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #00447c;
            margin-bottom: 5px;
        }

        .document-header p {
            font-size: 14px;
            color: #555;
        }

        /* Tables */
        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            page-break-inside: avoid;
        }

        .evaluation-table th,
        .evaluation-table td {
            border: 1px solid #e0e0e0;
            padding: 10px 12px;
            text-align: left;
        }

        .evaluation-table th {
            background-color: #00447c;
            color: white;
            font-weight: 500;
        }

        .evaluation-table tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        /* Section titles */
        .section-title {
            font-size: 16px;
            font-weight: 500;
            margin: 30px 0 15px 0;
            color: #00447c;
            padding-bottom: 8px;
            border-bottom: 2px solid #00447c;
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

        /* Risalah sections */
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
            font-size: 14px;
            font-weight: 500;
            color: #00447c;
            margin: 0;
        }

        .risalah-body {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-top: none;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 0 0 5px 5px;
        }

        .risalah-body p {
            margin: 0;
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }

        /* Signature section */
        .signature-section {
            margin-top: 60px;
            position: relative;
            min-height: 150px;
        }

        .signature-right {
            width: 250px;
            position: absolute;
            right: 0;
            text-align: center;
        }

        .signature-date {
            margin-bottom: 20px;
        }

        .signature-name {
            text-decoration: underline;
            font-weight: bold;
            margin: 80px 0 5px 0;
        }

        /* Check marks */
        .check-mark {
            text-align: center;
            color: #4CAF50;
            font-weight: bold;
        }

        /* Footer */
        .document-footer {
            text-align: center;
            margin-top: 50px;
            font-size: 11px;
            color: #777;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div>
        <table class="header-table">
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

        <div class="document-header">
            <h1>EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</h1>
            <p>UNIB/SPMI/STD.D-F-08</p>
        </div>

        <div class="section-title">Audit Prodi/Fakultas: Nama Program Studi/Fakultas</div>
        <p>Evaluasi dilakukan dengan menilai tingkat kesesuaian antara pernyataan dengan kenyataan selama pelaksanaan audit berlangsung, dengan ketentuan nilai sebagai berikut:</p>

        <table class="evaluation-table">
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

        <table class="evaluation-table">
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
            <div class="risalah-header">
                <h4>Materi/instrumen Audit</h4>
            </div>
            <div class="risalah-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="risalah-header">
                <h4>Pelaksanaan Audit</h4>
            </div>
            <div class="risalah-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="risalah-header">
                <h4>Saran untuk teraudit</h4>
            </div>
            <div class="risalah-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>

        <div class="signature-section">
            <div class="signature-right">
                <p class="signature-date">Bengkulu, 05 Mei 2025</p>
                <p class="signature-name">{{ Auth::user()->name }}</p>
                <p>Auditor</p>
            </div>
        </div>

        <div class="document-footer">
            <p>Dibuat pada Senin, 05 Mei 2025 14:00 WIB</p>
            <p>Sistem Penjaminan Mutu Internal Universitas Bengkulu</p>
        </div>
    </div>
</body>
</html>
