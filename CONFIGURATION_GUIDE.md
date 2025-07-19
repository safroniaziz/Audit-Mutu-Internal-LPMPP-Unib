# Panduan Konfigurasi Aplikasi

## File .env

Pastikan file `.env` Anda memiliki konfigurasi berikut:

```env
APP_NAME="SIAMI 2025"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_URL=http://localhost

# ... konfigurasi lainnya
```

## Konfigurasi yang Penting

### 1. Timezone
```env
APP_TIMEZONE=Asia/Jakarta
```
- Mengatur timezone aplikasi ke WIB
- Semua waktu akan disimpan dan ditampilkan dalam Asia/Jakarta

### 2. Locale (Bahasa)
```env
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
```
- Mengatur bahasa aplikasi ke Indonesia
- Format tanggal dan waktu akan menggunakan bahasa Indonesia

### 3. Faker Locale
```env
APP_FAKER_LOCALE=id_ID
```
- Mengatur locale untuk data dummy/faker ke Indonesia

## Setelah Mengubah Konfigurasi

1. **Restart server Laravel**
2. **Clear cache**:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```
3. **Restart browser** untuk clear cache frontend

## Testing

Setelah konfigurasi yang benar:

### Timezone
- **Input**: 19 Juli 2025 01:00
- **Database**: 2025-07-19 01:00:00 (Asia/Jakarta)
- **Display**: 19 Juli 2025 01:00

### Locale
- **Format tanggal**: 19 Juli 2025 (bukan July 19, 2025)
- **Format hari**: Kamis (bukan Thursday)
- **Format bulan**: Juli (bukan July)

## Troubleshooting

### Jika timezone masih salah:
1. Cek apakah `APP_TIMEZONE=Asia/Jakarta` di `.env`
2. Restart server Laravel
3. Clear cache dengan perintah di atas
4. Cek timezone server: `date` command

### Jika locale masih bahasa Inggris:
1. Cek apakah `APP_LOCALE=id` di `.env`
2. Clear cache dengan perintah di atas
3. Restart browser
4. Cek apakah ada cache yang tersisa

### Jika masih ada masalah:
1. Restart server Laravel
2. Clear semua cache
3. Restart browser
4. Test dengan data baru 
