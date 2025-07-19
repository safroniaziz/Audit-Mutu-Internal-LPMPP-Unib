# Panduan Penggunaan Timezone Helper Functions

## Overview

Setelah membuat `TimezoneHelper` class dan helper functions, sekarang Anda bisa menangani timezone dengan mudah tanpa perlu menulis kode yang sama berulang kali.

## Helper Functions yang Tersedia

### 1. `local_to_utc($localDateTime)`
**Fungsi**: Mengkonversi waktu lokal (WIB) ke UTC untuk disimpan di database
**Input**: String format `Y-m-d\TH:i` (dari input datetime-local)
**Output**: Carbon object dalam UTC atau null

```php
// Contoh penggunaan
$waktuVisitasi = local_to_utc($request->waktu_visitasi);
```

### 2. `utc_to_local($utcDateTime)`
**Fungsi**: Mengkonversi waktu UTC dari database ke waktu lokal (WIB)
**Input**: String atau Carbon object dalam UTC
**Output**: Carbon object dalam timezone Asia/Jakarta

```php
// Contoh penggunaan
$localTime = utc_to_local($pengajuan->waktu);
```

### 3. `format_local_time($utcDateTime, $format = 'd/m/Y H:i')`
**Fungsi**: Format waktu UTC ke string lokal dengan format tertentu
**Input**: Waktu UTC dan format (opsional)
**Output**: String waktu dalam format yang diinginkan

```php
// Contoh penggunaan
echo format_local_time($pengajuan->waktu); // Output: 17/07/2025 08:00
echo format_local_time($pengajuan->waktu, 'H:i'); // Output: 08:00
```

### 4. `format_for_input($utcDateTime)`
**Fungsi**: Format waktu UTC untuk input datetime-local
**Input**: Waktu UTC
**Output**: String format `Y-m-d\TH:i`

```php
// Contoh penggunaan
$inputValue = format_for_input($pengajuan->waktu); // Output: 2025-07-17T08:00
```

### 5. `format_indonesian_time($utcDateTime, $format = 'd F Y H:i')`
**Fungsi**: Format waktu UTC ke format Indonesia
**Input**: Waktu UTC dan format (opsional)
**Output**: String waktu dalam bahasa Indonesia

```php
// Contoh penggunaan
echo format_indonesian_time($pengajuan->waktu); // Output: 17 Juli 2025 08:00
echo format_indonesian_time($pengajuan->waktu, 'l, d F Y'); // Output: Kamis, 17 Juli 2025
```

### 6. `check_time_window($scheduledTime, $timeWindow = 2)`
**Fungsi**: Cek apakah waktu saat ini berada dalam rentang waktu yang dijadwalkan
**Input**: Waktu terjadwal dan rentang waktu (dalam jam)
**Output**: Array dengan status validasi

```php
// Contoh penggunaan
$validation = check_time_window($pengajuan->waktu, 2);
if ($validation['is_valid']) {
    // Waktu masih valid
} else {
    // Waktu sudah tidak valid
}
```

## Contoh Penggunaan di Controller

### Sebelum (Manual):
```php
// Convert waktu_visitasi to UTC for database storage
$waktuVisitasi = null;
if ($request->waktu_visitasi) {
    $waktuVisitasi = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->waktu_visitasi, 'Asia/Jakarta')->utc();
}

// Display waktu
$scheduledTime = \Carbon\Carbon::parse($pengajuan->waktu)->setTimezone('Asia/Jakarta');
echo $scheduledTime->format('d/m/Y H:i');
```

### Sesudah (Dengan Helper):
```php
// Convert waktu_visitasi to UTC for database storage
$waktuVisitasi = local_to_utc($request->waktu_visitasi);

// Display waktu
echo format_local_time($pengajuan->waktu);
```

## Contoh Penggunaan di View/Blade

### Sebelum:
```php
{{ \Carbon\Carbon::parse($pengajuanAmis->waktu)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
```

### Sesudah:
```php
{{ format_local_time($pengajuanAmis->waktu, 'H:i') }} WIB
```

## Contoh Penggunaan di JavaScript

Untuk frontend, Anda masih perlu menggunakan JavaScript untuk menangani timezone:

```javascript
// Convert UTC time from database to local timezone for display
if (assignments.waktu_visitasi) {
    const waktuInput = document.getElementById('waktu_visitasi');
    if (waktuInput) {
        const date = new Date(assignments.waktu_visitasi);
        // Adjust for timezone offset (UTC+7 for Asia/Jakarta)
        const localDate = new Date(date.getTime() + (7 * 60 * 60 * 1000));
        const formattedDate = localDate.toISOString().slice(0, 16);
        waktuInput.value = formattedDate;
    }
}
```

## Keuntungan Menggunakan Helper Functions

1. **Konsistensi**: Semua kode menggunakan logika timezone yang sama
2. **Maintainability**: Jika ada perubahan logika timezone, cukup ubah di satu tempat
3. **Readability**: Kode lebih mudah dibaca dan dipahami
4. **Reusability**: Bisa digunakan di seluruh aplikasi
5. **Testing**: Lebih mudah untuk unit testing

## Best Practices

1. **Selalu gunakan helper functions** untuk konversi timezone
2. **Simpan waktu dalam UTC** di database
3. **Tampilkan waktu dalam WIB** di frontend
4. **Gunakan format yang konsisten** untuk input dan output
5. **Test helper functions** untuk memastikan akurasi

## Troubleshooting

### Jika helper functions tidak terdeteksi:
1. Jalankan `composer dump-autoload`
2. Pastikan file `app/Helpers/helpers.php` sudah terdaftar di `composer.json`
3. Restart server Laravel

### Jika timezone masih salah:
1. Pastikan `APP_TIMEZONE=Asia/Jakarta` di file `.env`
2. Pastikan server menggunakan timezone yang benar
3. Cek apakah ada cache yang perlu di-clear 
