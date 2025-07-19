# Masalah datetime-local Input dan Solusinya

## Masalah yang Ditemukan

Ketika Anda memilih waktu "19 Juli 2025 01:00" di input datetime-local, waktu yang tersimpan di database menjadi "2025-07-18 18:00:00.000" (UTC). Ini terjadi karena **input datetime-local dari browser selalu mengirim waktu dalam UTC**.

## Analisis Masalah

### 1. Input datetime-local dari Browser
- **Yang Anda pilih**: 19 Juli 2025 01:00 (WIB)
- **Yang dikirim browser**: 2025-07-19T01:00 (dalam UTC)
- **Yang diterima server**: 2025-07-19T01:00 (dalam UTC)

### 2. Masalah Konversi
- **WIB**: 19 Juli 2025 01:00
- **UTC**: 18 Juli 2025 18:00 (karena WIB = UTC+7)
- **Hasil di database**: 2025-07-18 18:00:00.000 ✅

Ternyata hasilnya sudah benar! Masalahnya adalah **interpretasi waktu yang salah**.

## Penjelasan Teknis

### Mengapa datetime-local Mengirim UTC?

1. **HTML5 Specification**: Input datetime-local selalu mengirim waktu dalam UTC
2. **Browser Behavior**: Browser mengkonversi waktu lokal ke UTC sebelum mengirim
3. **Server Reception**: Server menerima waktu dalam UTC

### Contoh Konversi yang Benar:

```
Input User: 19 Juli 2025 01:00 WIB
↓
Browser Send: 2025-07-19T01:00 (UTC)
↓
Server Receive: 2025-07-19T01:00 (UTC)
↓
Interpret as WIB: 19 Juli 2025 01:00 WIB
↓
Convert to UTC: 18 Juli 2025 18:00 UTC
↓
Store in DB: 2025-07-18 18:00:00.000
```

## Solusi yang Diterapkan

### 1. Helper Function Baru: `datetime_local_to_utc()`

```php
public static function datetimeLocalToUtc($dateTimeInput)
{
    if (empty($dateTimeInput)) {
        return null;
    }

    // Parse the input as if it's in local timezone (WIB)
    // Then convert to UTC for storage
    $localTime = Carbon::createFromFormat('Y-m-d\TH:i', $dateTimeInput, self::TIMEZONE_LOCAL);
    return $localTime->utc();
}
```

### 2. Penggunaan di Controller

```php
// Sebelum
$waktuVisitasi = local_to_utc($request->waktu_visitasi);

// Sesudah
$waktuVisitasi = datetime_local_to_utc($request->waktu_visitasi);
```

## Testing

### Test Case 1: Pagi
- **Input**: 19 Juli 2025 01:00 WIB
- **Expected DB**: 2025-07-18 18:00:00.000 UTC
- **Display**: 19 Juli 2025 01:00 WIB

### Test Case 2: Siang
- **Input**: 19 Juli 2025 12:00 WIB
- **Expected DB**: 2025-07-19 05:00:00.000 UTC
- **Display**: 19 Juli 2025 12:00 WIB

### Test Case 3: Malam
- **Input**: 19 Juli 2025 23:00 WIB
- **Expected DB**: 2025-07-19 16:00:00.000 UTC
- **Display**: 19 Juli 2025 23:00 WIB

## Verifikasi Hasil

Untuk memverifikasi bahwa konversi sudah benar:

1. **Input waktu**: 19 Juli 2025 01:00
2. **Cek database**: Seharusnya 2025-07-18 18:00:00.000
3. **Tampilkan kembali**: Seharusnya 19 Juli 2025 01:00

## Cara Menghitung Manual

```
WIB = UTC + 7 jam
UTC = WIB - 7 jam

Contoh:
19 Juli 2025 01:00 WIB = 18 Juli 2025 18:00 UTC
19 Juli 2025 12:00 WIB = 19 Juli 2025 05:00 UTC
19 Juli 2025 23:00 WIB = 19 Juli 2025 16:00 UTC
```

## Best Practices

1. **Selalu gunakan `datetime_local_to_utc()`** untuk input datetime-local
2. **Simpan waktu dalam UTC** di database
3. **Tampilkan waktu dalam WIB** di frontend
4. **Test dengan berbagai waktu** (pagi, siang, malam)
5. **Verifikasi konversi** dengan perhitungan manual

## Troubleshooting

### Jika waktu masih salah:
1. Pastikan menggunakan `datetime_local_to_utc()` bukan `local_to_utc()`
2. Cek apakah ada cache yang perlu di-clear
3. Restart server Laravel
4. Jalankan `composer dump-autoload`

### Jika display waktu salah:
1. Pastikan menggunakan `format_local_time()` untuk display
2. Cek apakah timezone server sudah benar
3. Verifikasi konfigurasi `APP_TIMEZONE` di `.env` 
