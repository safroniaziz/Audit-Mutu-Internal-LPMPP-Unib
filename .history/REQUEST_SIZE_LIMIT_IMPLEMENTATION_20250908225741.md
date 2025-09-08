# Implementasi Pembatasan Ukuran Request 450KB

## 📋 Overview

Implementasi ini membatasi ukuran request maksimal **450KB** untuk mencegah error 413 "Request Entity Too Large" pada sistem SIntamu. Validasi dilakukan di level controller method, bukan di route middleware.

## 🛠️ Komponen yang Dibuat

### 1. Middleware RequestSizeLimit
**File**: `app/Http/Middleware/RequestSizeLimit.php`

- Membatasi ukuran request maksimal 450KB
- Mengecek Content-Length header dan actual request body
- Return response JSON dengan status 413 jika melebihi batas
- Menyertakan informasi ukuran saat ini dan maksimal

### 2. Helper RequestValidator
**File**: `app/Helpers/RequestValidator.php`

- Static methods untuk validasi ukuran request
- Method `validateRequestSize()` untuk validasi umum
- Method `validateFileSize()` untuk validasi file upload
- Method `formatBytes()` untuk format ukuran yang mudah dibaca

### 3. Trait ValidatesRequestSize
**File**: `app/Traits/ValidatesRequestSize.php`

- Trait untuk memudahkan penggunaan validasi di controller
- Method `validateRequestSize()` untuk validasi request
- Method `validateFileSize()` untuk validasi file
- Method `validateRequestSizeWithMessage()` untuk custom message

### 4. Test Suite
**File**: `tests/Feature/RequestSizeLimitTest.php`

- Test untuk middleware RequestSizeLimit
- Test untuk helper RequestValidator
- Test untuk route dengan middleware
- Test formatBytes helper

## 🔧 Konfigurasi

### Middleware Registration
**File**: `bootstrap/app.php`

```php
$middleware->alias([
    'request.size.limit' => RequestSizeLimit::class,
]);
```

### Route Implementation
**File**: `routes/web.php`

**CATATAN**: Middleware TIDAK ditambahkan ke route. Validasi dilakukan di level controller method saja.

```php
// Route pengisian instrumen (TANPA middleware)
Route::post('/submit-all-instrumen', [AuditeePengajuanAmiController::class, 'submitAllInstrumen'])
    ->name('submitAllInstrumen');

// Route upload file (TANPA middleware)
Route::post('/upload-files', [AuditeePengajuanAmiController::class, 'uploadFiles'])
    ->name('uploadFiles');
```

## 📍 Method Controller yang Dibatasi

### AuditeePengajuanAmiController
- `lengkapiProfil()` - Lengkapi profil auditee
- `saveIkss()` - Save IKSS data
- `saveIkssSS()` - Save IKSS SS data
- `submitAllInstrumen()` - Submit semua instrumen
- `submitInstrumenSS()` - Submit instrumen SS
- `submitInstrumenProdi()` - Submit instrumen prodi
- `uploadPerjanjianKinerja()` - Upload perjanjian kinerja
- `uploadFiles()` - Upload files

### AuditorAuditController (akan ditambahkan)
- `submitDeskEvaluation()` - Submit desk evaluation
- `submitVisitasi()` - Submit visitasi
- `submitPenilaianInstrumenProdi()` - Submit penilaian
- `saveKuisioner()` - Save kuisioner

## 💻 Penggunaan di Controller

### Menggunakan Trait (Recommended)
```php
use App\Traits\ValidatesRequestSize;

class YourController extends Controller
{
    use ValidatesRequestSize;
    
    public function yourMethod(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation; // Return JSON response dengan status 413
        }
        
        // Lanjutkan proses normal...
    }
}
```

### Menggunakan Helper Langsung
```php
use App\Helpers\RequestValidator;

$validation = RequestValidator::validateRequestSize($request);
if ($validation) {
    return response()->json($validation, 413);
}
```

### Contoh Implementasi di AuditeePengajuanAmiController
```php
public function submitAllInstrumen(Request $request)
{
    // Validasi ukuran request maksimal 450KB
    $sizeValidation = $this->validateRequestSize($request);
    if ($sizeValidation) {
        return $sizeValidation;
    }
    
    // Lanjutkan validasi dan proses normal...
    $validator = Validator::make($request->all(), [
        // ... validasi lainnya
    ]);
}
```

## 📊 Response Format

### Success Response
```json
{
    "success": true,
    "data": "..."
}
```

### Error Response (413)
```json
{
    "success": false,
    "message": "Ukuran request terlalu besar. Maksimal 450KB.",
    "max_size": "450KB",
    "current_size": "500.00 KB",
    "error_code": "REQUEST_TOO_LARGE"
}
```

## 🧪 Testing

Jalankan test suite:
```bash
php artisan test tests/Feature/RequestSizeLimitTest.php
```

## 🔍 Monitoring

### Log Request Besar
Middleware akan log request yang melebihi batas untuk monitoring:

```php
Log::warning('Request size exceeded limit', [
    'url' => $request->url(),
    'method' => $request->method(),
    'size' => $this->formatBytes(strlen($request->getContent())),
    'max_size' => '450KB',
    'ip' => $request->ip(),
    'user_agent' => $request->userAgent()
]);
```

## ⚙️ Konfigurasi Server

Pastikan konfigurasi server mendukung pembatasan ini:

### Nginx
```nginx
client_max_body_size 500k;  # Sedikit lebih besar dari 450KB
```

### PHP
```ini
post_max_size = 500K
upload_max_filesize = 500K
```

## 🚀 Deployment

1. Deploy semua file yang dibuat
2. Clear cache Laravel: `php artisan config:clear`
3. Restart web server
4. Test dengan data besar untuk memastikan pembatasan berfungsi

## 📝 Catatan Penting

- Batas 450KB sudah cukup untuk sebagian besar form data
- File upload tetap dibatasi oleh Laravel validation (max:10240 = 10MB)
- Middleware berjalan sebelum controller, sehingga efisien
- Response error konsisten dengan format JSON yang sudah ada
- Logging untuk monitoring dan debugging

## 🔧 Troubleshooting

### Jika masih mendapat error 413 dari nginx:
1. Periksa konfigurasi nginx `client_max_body_size`
2. Restart nginx: `sudo systemctl restart nginx`
3. Periksa log nginx: `tail -f /var/log/nginx/error.log`

### Jika middleware tidak berjalan:
1. Clear cache: `php artisan config:clear`
2. Periksa alias middleware di `bootstrap/app.php`
3. Periksa route menggunakan middleware yang benar
