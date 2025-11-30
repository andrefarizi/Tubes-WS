# Setup Google Maps API untuk WheelTrack

## ⚠️ PENTING: API Key Sudah Terkonfigurasi!

API Key Google Maps sudah tersimpan di file `.env`:
```
GOOGLE_MAPS_API_KEY=AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA
```

**Tidak perlu edit file view lagi!** Semua file sudah menggunakan `{{ config('maps.google_api_key') }}`.

---

## 🚀 Quick Start

### 1. Pastikan API Key Valid

Buka browser dan test API key:
```
https://maps.googleapis.com/maps/api/js?key=AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA&callback=initMap
```

Jika muncul error "InvalidKeyMapError", berarti:
- ❌ API key tidak valid atau expired
- ❌ API belum di-enable
- ❌ Billing belum aktif

### 2. Clear Config Cache

```bash
php artisan config:clear
```

### 3. Jalankan Server

```bash
php artisan serve
```

### 4. Buka Aplikasi

- **Peta Semua Showroom**: http://localhost:8000/maps
- **Detail Showroom**: http://localhost:8000/showroom/detail-page?nama=...
- **Rute ke Showroom**: http://localhost:8000/maps/showroom?nama=...

---

## 🔧 Jika API Key Error

### Cara Mendapatkan API Key Baru
- Kunjungi: https://console.cloud.google.com/
- Login dengan akun Google Anda

### 2. Buat Project Baru (jika belum punya)
- Klik dropdown project di header
- Klik "NEW PROJECT"
- Beri nama: `WheelTrack-Maps`
- Klik "CREATE"

### 3. Enable API yang Diperlukan
Aktifkan API berikut:

1. **Maps JavaScript API**
   - Menu: APIs & Services > Library
   - Cari: "Maps JavaScript API"
   - Klik "ENABLE"

2. **Geocoding API**
   - Menu: APIs & Services > Library
   - Cari: "Geocoding API"
   - Klik "ENABLE"

3. **Directions API**
   - Menu: APIs & Services > Library
   - Cari: "Directions API"
   - Klik "ENABLE"

4. **Places API**
   - Menu: APIs & Services > Library
   - Cari: "Places API"
   - Klik "ENABLE"

### 4. Buat API Key
- Menu: APIs & Services > Credentials
- Klik "CREATE CREDENTIALS"
- Pilih "API key"
- Copy API Key yang dihasilkan

### 5. Restrict API Key (Opsional tapi Recommended)
- Klik pada API key yang baru dibuat
- Di "Application restrictions":
  - Pilih "HTTP referrers (web sites)"
  - Tambahkan: `http://localhost/*` dan `http://127.0.0.1/*`
  - Untuk production: `https://yourdomain.com/*`
- Di "API restrictions":
  - Pilih "Restrict key"
  - Centang:
    - Maps JavaScript API
    - Geocoding API
    - Directions API
    - Places API
- Klik "SAVE"

### 6. Update API Key di .env

**JANGAN edit file view!** Cukup update file `.env`:

```env
GOOGLE_MAPS_API_KEY=YOUR_NEW_API_KEY_HERE
```

Lalu clear config cache:
```bash
php artisan config:clear
```

Refresh browser (Ctrl+F5).

---

## 📋 Files Yang Sudah Dikonfigurasi

Semua file ini sudah otomatis menggunakan API key dari `.env`:

✅ `resources/views/maps.blade.php`
✅ `resources/views/maps-detail.blade.php`  
✅ `resources/views/showroom-detail.blade.php`

**Kode yang digunakan:**
```blade
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}&..."></script>
```

---

## 🐛 Troubleshooting

### Error: "InvalidKeyMapError"

**Penyebab:**
- API key tidak valid
- API belum di-enable (Maps JavaScript API, Geocoding API, Directions API, Places API)
- Billing belum aktif di Google Cloud

**Solusi:**
1. Buka https://console.cloud.google.com/
2. Pilih project Anda
3. Menu: **APIs & Services > Enabled APIs & services**
4. Pastikan ke-4 API ini sudah enabled:
   - ✅ Maps JavaScript API
   - ✅ Geocoding API
   - ✅ Directions API
   - ✅ Places API
5. Menu: **Billing** → Aktifkan (perlu kartu kredit)
6. Generate API key baru jika perlu

### Error: "This page can't load Google Maps correctly"

**Solusi:**
```bash
# 1. Cek API key di .env
cat .env | grep GOOGLE_MAPS_API_KEY

# 2. Clear config cache
php artisan config:clear

# 3. Restart server
# Ctrl+C lalu php artisan serve
```

### Maps Tidak Muncul (Gray Box)

**Solusi:**
1. Buka Console Browser (F12)
2. Lihat tab "Console" untuk error message
3. Pastikan tidak ada CORS error
4. Pastikan internet connected

### Warning: "cdn.tailwindcss.com should not be used in production"

Ini hanya warning development. Untuk production nanti bisa install Tailwind via npm:
```bash
npm install -D tailwindcss
npx tailwindcss init
```

Tapi untuk development, CDN sudah cukup.

---

## 📝 Configuration Files

### config/maps.php
```php
<?php
return [
    'google_api_key' => env('GOOGLE_MAPS_API_KEY', ''),
];
```

### .env
```env
GOOGLE_MAPS_API_KEY=AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA
```

---

### Free Tier (Per Bulan):
- **Maps JavaScript API**: $200 kredit gratis
- **Geocoding API**: 40,000 requests gratis
- **Directions API**: 40,000 requests gratis
- **Places API**: $200 kredit gratis

### Tips Hemat Quota:
1. Enable billing tapi set budget alerts
2. Restrict API key ke domain tertentu
3. Cache hasil geocoding untuk mengurangi requests
4. Gunakan lazy loading untuk maps

## Troubleshooting

### Maps tidak muncul (gray box):
- ✅ Pastikan API key sudah dimasukkan
- ✅ Cek API sudah di-enable semua
- ✅ Buka Console browser (F12) untuk lihat error

### "This page can't load Google Maps correctly":
- ✅ API key salah atau belum di-set
- ✅ Billing belum diaktifkan (perlu kartu kredit)
- ✅ Domain tidak masuk whitelist

### Geocoding tidak berfungsi:
- ✅ Geocoding API belum di-enable
- ✅ Format alamat tidak lengkap
- ✅ Quota sudah habis

## Fitur yang Sudah Diimplementasi

### ✅ Halaman Peta Showroom (`/maps`)
1. **Peta Interaktif**
   - Marker untuk semua showroom
   - Warna marker sesuai status (hijau=buka, kuning=segera tutup, merah=tutup)
   - Info window dengan detail showroom

2. **Filter & Search**
   - Search by nama/merek showroom
   - Filter by lokasi (kota)
   - Filter by status (buka/tutup/segera tutup)

3. **Sort Options**
   - Terdekat dari lokasi user
   - Alphabetical (nama)
   - Rating tertinggi

4. **Jam Buka/Tutup Real-time**
   - Status badge pada setiap showroom
   - Countdown waktu tutup
   - Info "Buka dalam X jam"

5. **Showroom Terdekat**
   - Tombol "Cari Terdekat dari Saya"
   - Perhitungan jarak otomatis
   - Auto-center ke showroom terdekat

### ✅ Halaman Detail Rute (`/maps/showroom?nama=...`)
1. **Informasi Showroom**
   - Detail lengkap showroom
   - Status buka/tutup real-time
   - Countdown jam tutup

2. **Pilihan Rute**
   - Dari lokasi user (GPS)
   - Dari USU Medan
   - Dari alamat custom

3. **Info Rute**
   - Jarak tempuh (km)
   - Estimasi waktu (menit)
   - Petunjuk arah step-by-step
   - Visualisasi rute di peta

4. **Integration**
   - Tombol "Buka di Google Maps"
   - Link ke detail showroom lengkap

### ✅ Update Showroom Detail (`/showroom/detail-page`)
- Tombol "Lihat Peta & Dapatkan Arah"
- Link langsung ke halaman rute maps

### ✅ Update Navbar
- Menu "Peta Showroom" di navbar
- Akses cepat ke halaman maps

## Routes yang Ditambahkan

```php
// Maps routes
Route::get('/maps', [MapsController::class, 'index'])->name('maps.index');
Route::get('/maps/showroom', [MapsController::class, 'showroomDetail'])->name('maps.showroom');
```

## Controller Baru

**MapsController.php**
- `index()`: Render halaman peta semua showroom
- `showroomDetail()`: Render halaman rute detail showroom

## Alur Penggunaan

1. User buka `/maps` → Lihat semua showroom di peta
2. Filter/search showroom yang diinginkan
3. Klik marker atau card → Lihat info showroom
4. Klik "Lihat Rute" → Masuk ke `/maps/showroom?nama=...`
5. Pilih titik awal (GPS/USU/Custom)
6. Lihat rute, jarak, waktu tempuh
7. Klik "Buka di Google Maps" untuk navigasi real-time

## Notes

- Semua fitur sudah menggunakan UI yang konsisten (red theme)
- Real-time status jam buka/tutup menggunakan JavaScript
- Responsive design untuk mobile & desktop
- Integrasi penuh dengan data SPARQL showroom
