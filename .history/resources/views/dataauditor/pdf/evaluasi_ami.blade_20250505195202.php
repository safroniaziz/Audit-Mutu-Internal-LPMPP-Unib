<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risalah Rapat</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #3d3d3d;
            color: white;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 30px;
            color: #333;
            border-bottom: 2px solid #3d3d3d;
            padding-bottom: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #888;
        }

        .risalah-container {
            margin-top: 30px;
        }

        .risalah-header {
            background-color: #f5f5f5;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 5px solid #3d3d3d;
        }

        .risalah-header h4 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .risalah-body {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .risalah-body p {
            margin: 0;
            font-size: 12px;
            color: #555;
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
            text-align: right;
        }

        .signature-right {
            width: 250px;
            float: right;
            text-align: center;
            margin-top: 50px;
        }

        .date {
            margin-bottom: 20px;
        }

        .signature {
            text-decoration: underline;
            font-weight: bold;
            margin-bottom: 5px;
        }

    </style>
</head>
<body>

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
                EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR
            </td>
        </tr>
    </table>

    <div class="header">
        <h1>EVALUASI AUDIT MUTU INTERNAL OLEH AUDITOR</h1>
        <p>UNIB/ SPMI/STD.D-F-08</p>
    </div>

    <div class="section-title">Audit prodi : Nama Program Studi/Fakultas</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Kategori</th>
                <th>Status Risalah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ahmad Fikri</td>
                <td>Pimpinan</td>
                <td>Sudah Dicatat</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti Nurhaliza</td>
                <td>Anggota</td>
                <td>Belum Dicatat</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Budi Santoso</td>
                <td>Notulen</td>
                <td>Sudah Dicatat</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Risalah Rapat per Anggota</div>
    <div class="risalah-container">
        <div class="risalah-header">
            <h4>Ahmad Fikri (Pimpinan)</h4>
        </div>
        <div class="risalah-body">
            <p><strong>Risalah 1:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p><strong>Risalah 2:</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="risalah-header">
            <h4>Siti Nurhaliza (Anggota)</h4>
        </div>
        <div class="risalah-body">
            <p class="no-risalah">Belum ada risalah yang dicatat untuk anggota ini.</p>
        </div>

        <div class="risalah-header">
            <h4>Budi Santoso (Notulen)</h4>
        </div>
        <div class="risalah-body">
            <p><strong>Risalah 1:</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
        </div>
    </div>

    <div class="section-title">Dokumen Rapat</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokumen</th>
                <th>Tanggal Unggah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Notulen Rapat Evaluasi</td>
                <td>04 Mei 2025</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Daftar Hadir</td>
                <td>04 Mei 2025</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dibuat pada Senin, 05 Mei 2025 14:00</p>
    </div>

    <div class="signature-section">
        <div class="signature-right">
            <p class="date">..........................., 05 Mei 2025</p>
            <p class="signature">Ahmad Fikri</p>
            <p>Pimpinan Rapat</p>
        </div>
    </div>

</body>
</html>
