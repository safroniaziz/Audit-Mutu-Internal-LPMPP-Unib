<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedang Penyesuaian - SIAMI</title>
    <meta name="description" content="Aplikasi SIAMI sedang dalam proses penyesuaian. Mohon maaf atas ketidaknyamanan ini.">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .maintenance-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .maintenance-icon {
            font-size: 80px;
            margin-bottom: 30px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.3rem;
            color: #7f8c8d;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 40px;
        }

        .contact-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .contact-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .contact-info p {
            color: #666;
            margin-bottom: 8px;
        }

        .refresh-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .loading-dots {
            display: inline-block;
            margin-left: 10px;
        }

        .loading-dots::after {
            content: '';
            animation: dots 1.5s infinite;
        }

        @keyframes dots {
            0%, 20% {
                content: '';
            }
            40% {
                content: '.';
            }
            60% {
                content: '..';
            }
            80%, 100% {
                content: '...';
            }
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .maintenance-container {
                padding: 40px 20px;
                margin: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1.1rem;
            }

            .description {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">🔧</div>
        
        <h1>Sedang Penyesuaian</h1>
        <p class="subtitle">Aplikasi SIAMI</p>
        
        <div class="description">
            <p>Kami sedang melakukan penyesuaian dan perbaikan pada sistem SIAMI untuk memberikan pengalaman yang lebih baik kepada Anda.</p>
            <p>Mohon maaf atas ketidaknyamanan ini. Tim kami sedang bekerja keras untuk menyelesaikan penyesuaian ini secepat mungkin.</p>
        </div>

        <div class="contact-info">
            <h3>📞 Informasi Kontak</h3>
            <p><strong>Email:</strong> support@siami.ac.id</p>
            <p><strong>Telepon:</strong> (021) 1234-5678</p>
            <p><strong>Jam Operasional:</strong> Senin - Jumat, 08:00 - 17:00 WIB</p>
        </div>

        <a href="#" class="refresh-btn" onclick="window.location.reload()">
            🔄 Coba Lagi
        </a>

        <div class="footer">
            <p>&copy; {{ date('Y') }} SIAMI - Sistem Informasi Audit Mutu Internal</p>
            <p>Terima kasih atas kesabaran dan pengertian Anda<span class="loading-dots"></span></p>
        </div>
    </div>

    <script>
        // Auto refresh setiap 30 detik
        setTimeout(function() {
            window.location.reload();
        }, 30000);

        // Menampilkan waktu terakhir update
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const timeString = now.toLocaleString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            // Tambahkan informasi waktu di footer jika diperlukan
            const footer = document.querySelector('.footer');
            const timeInfo = document.createElement('p');
            timeInfo.innerHTML = `<small>Halaman terakhir diperbarui: ${timeString}</small>`;
            timeInfo.style.marginTop = '10px';
            timeInfo.style.color = '#999';
            footer.appendChild(timeInfo);
        });
    </script>
</body>
</html>
