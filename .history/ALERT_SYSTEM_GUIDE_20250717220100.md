# Sistem Alert Modern - Panduan Penggunaan

## Fitur Utama

✅ **Modern & Profesional** - Desain yang elegan dan modern  
✅ **Interaktif** - Animasi smooth dan hover effects  
✅ **Responsive** - Bekerja sempurna di semua device  
✅ **Auto-hide** - Bisa otomatis hilang setelah waktu tertentu  
✅ **Customizable** - Mudah dikustomisasi sesuai kebutuhan  
✅ **Context-aware** - Alert yang berbeda untuk halaman berbeda  

## Cara Penggunaan

### 1. Alert Otomatis (Session Flash Messages)

Alert akan muncul otomatis berdasarkan session flash messages:

```php
// Di Controller
return redirect()->back()->with('success', 'Data berhasil disimpan!');
return redirect()->back()->with('error', 'Terjadi kesalahan!');
return redirect()->back()->with('warning', 'Peringatan!');
return redirect()->back()->with('info', 'Informasi penting!');
```

### 2. Alert Manual dengan Component

```blade
<x-modern-alert 
    type="success" 
    title="Berhasil!" 
    message="Data berhasil disimpan"
    :autoHide="true"
    :autoHideDelay="4000"
/>
```

### 3. Alert dengan Action Button

```blade
<x-modern-alert 
    type="warning" 
    title="Peringatan!" 
    message="Data akan dihapus permanen"
    actionText="Batal"
    actionUrl="{{ route('cancel.delete') }}"
    :dismissible="true"
/>
```

### 4. Alert dengan JavaScript

```javascript
// Alert sederhana
showModernAlert('success', 'Berhasil!', 'Data berhasil disimpan', { autoHide: true });

// Alert dengan action
showModernAlert('warning', 'Peringatan!', 'Data akan dihapus', { 
    actionText: 'Batal', 
    action: 'cancelDelete()' 
});

// Alert dengan custom options
showModernAlert('info', 'Tips', 'Gunakan fitur ini dengan bijak', {
    autoHide: true,
    autoHideDelay: 8000,
    dismissible: false
});
```

## Parameter yang Tersedia

| Parameter | Type | Default | Deskripsi |
|-----------|------|---------|-----------|
| `type` | string | 'info' | Jenis alert: 'info', 'success', 'warning', 'danger', 'dark' |
| `title` | string | '' | Judul alert |
| `message` | string | '' | Pesan alert |
| `dismissible` | boolean | true | Bisa ditutup manual |
| `autoHide` | boolean | false | Otomatis hilang |
| `autoHideDelay` | number | 5000 | Delay auto-hide dalam ms |
| `icon` | string | null | Icon custom |
| `actionText` | string | '' | Teks tombol action |
| `actionUrl` | string | '' | URL untuk tombol action |
| `action` | string | '' | JavaScript function untuk tombol action |

## Alert Context-Aware

Sistem alert otomatis menampilkan alert yang sesuai berdasarkan route:

### Periode Aktif
- Alert peringatan tentang penghapusan data
- Tombol "Lihat Panduan"

### Data Management (Kriteria, Indikator, Instrumen)
- Tips pengelolaan data
- Auto-hide setelah 8 detik

### Audit Process
- Informasi tentang proses audit
- Auto-hide setelah 6 detik

### User Management
- Tips manajemen pengguna
- Auto-hide setelah 7 detik

## Styling & Animasi

### Animasi yang Tersedia
- **slide-in-top**: Masuk dari atas
- **slide-in-right**: Masuk dari kanan
- **fade**: Fade in/out
- **hover**: Efek hover dengan shadow

### Responsive Design
- Mobile-friendly layout
- Tombol close yang mudah diakses
- Text yang readable di semua ukuran

## Contoh Implementasi Lengkap

### Di Controller
```php
public function store(Request $request)
{
    try {
        // Proses data
        $data->save();
        
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}
```

### Di View
```blade
@extends('layouts.dashboard.dashboard')

@section('content')
    <!-- Alert akan muncul otomatis di sini -->
    
    <div class="card">
        <div class="card-header">
            <h3>Data Management</h3>
        </div>
        <div class="card-body">
            <!-- Content -->
        </div>
    </div>
@endsection
```

### Di JavaScript
```javascript
// Untuk AJAX success
$.ajax({
    url: '/api/data',
    method: 'POST',
    data: formData,
    success: function(response) {
        showModernAlert('success', 'Berhasil!', 'Data berhasil disimpan', { autoHide: true });
    },
    error: function(xhr) {
        showModernAlert('danger', 'Error!', 'Gagal menyimpan data', { autoHide: false });
    }
});
```

## Tips Penggunaan

1. **Gunakan auto-hide untuk pesan sukses** - User tidak perlu menutup manual
2. **Jangan auto-hide untuk error** - User perlu membaca pesan error
3. **Gunakan action button untuk konfirmasi** - Lebih interaktif
4. **Pesan yang singkat dan jelas** - Mudah dibaca
5. **Konsisten dalam penggunaan type** - success untuk sukses, warning untuk peringatan

## Customization

Untuk mengubah styling, edit file `resources/views/components/modern-alert.blade.php` bagian `<style>`.

Untuk mengubah behavior, edit bagian `<script>` di file yang sama. 
