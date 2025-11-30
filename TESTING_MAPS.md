# 🗺️ TESTING PANDUAN - Fitur Maps WheelTrack

## ✅ Checklist Sebelum Testing

- [ ] API Key sudah ada di `.env` (GOOGLE_MAPS_API_KEY)
- [ ] Config cache sudah di-clear (`php artisan config:clear`)
- [ ] Server Laravel running (`php artisan serve`)
- [ ] Browser dengan internet aktif

---

## 📍 Test 1: Halaman Peta Showroom

### URL: http://localhost:8000/maps

**Yang Harus Muncul:**
1. ✅ Navbar merah dengan logo WheelTrack
2. ✅ Filter section (Search, Lokasi, Status)
3. ✅ Tombol sort (Terdekat, Nama, Rating)
4. ✅ Google Maps dengan marker showroom
5. ✅ Sidebar list showroom di kanan

**Test Interaksi:**

#### A. Test Search
```
1. Ketik "Toyota" di search box
2. List showroom harus filter hanya Toyota
3. Marker di peta juga hanya Toyota
```

#### B. Test Filter Lokasi
```
1. Pilih "Medan" di dropdown lokasi
2. Hanya showroom Medan yang muncul
3. Map auto-zoom ke area Medan
```

#### C. Test Filter Status
```
1. Pilih "Buka Sekarang" di dropdown status
2. Hanya showroom dengan badge hijau yang muncul
3. Badge menampilkan:
   - 🟢 "Buka" (hijau)
   - 🟡 "Segera Tutup" (kuning) 
   - 🔴 "Tutup" (merah)
```

#### D. Test Sort Terdekat
```
1. Klik tombol "Terdekat"
2. Browser akan minta permission lokasi → Allow
3. List showroom diurutkan dari terdekat
4. Muncul jarak "X.XX km dari Anda"
```

#### E. Test Marker Click
```
1. Klik marker di peta
2. Info window popup dengan:
   - Nama showroom
   - Merek
   - Rating bintang
   - Status badge (buka/tutup)
   - Jarak dari user (jika GPS aktif)
   - Tombol "Lihat Rute"
```

#### F. Test Card Click
```
1. Klik card showroom di sidebar
2. Map auto-zoom ke showroom tersebut
3. Marker centered di tengah
```

#### G. Test Tombol "Cari Terdekat dari Saya"
```
1. Klik tombol hijau "Cari Terdekat dari Saya"
2. Permission GPS → Allow
3. Map auto-zoom ke showroom terdekat
4. Marker ter-highlight dengan ring hijau 2 detik
5. Card di sidebar auto-scroll ke showroom tersebut
```

**Expected Result:**
- ✅ Semua marker berwarna sesuai status
- ✅ Counter "X Showroom" update sesuai filter
- ✅ No console errors di browser (F12)

---

## 🚗 Test 2: Halaman Detail Rute

### URL: http://localhost:8000/maps/showroom?nama=TOYOTA%20DELTAMAS%20BALAI%20KOTA

**Yang Harus Muncul:**
1. ✅ Navbar dengan breadcrumb navigation
2. ✅ Header merah dengan info showroom
3. ✅ Status badge real-time (buka/tutup)
4. ✅ Countdown jam tutup (contoh: "Tutup dalam 2 jam 15 menit")
5. ✅ Google Maps centered ke showroom
6. ✅ Marker merah di lokasi showroom
7. ✅ Grid informasi detail (alamat, jam, telepon)
8. ✅ 3 tombol pilihan rute

**Test Interaksi:**

#### A. Test Tombol "Lokasi Saya Sekarang"
```
1. Klik tombol hijau "Lokasi Saya Sekarang"
2. Permission GPS → Allow
3. Tombol berubah jadi "Mendapatkan lokasi..." dengan spinner
4. Setelah dapat lokasi:
   - Garis merah muncul di peta (rute)
   - Card "Informasi Rute" muncul dengan:
     * Jarak (km)
     * Estimasi waktu
     * Titik awal: "Lokasi Anda Sekarang"
     * Titik tujuan: Nama showroom
   - Panel "Petunjuk Arah" muncul dengan step-by-step
5. Map auto-zoom menampilkan seluruh rute
```

#### B. Test Tombol "Universitas Sumatera Utara"
```
1. Klik tombol merah "Universitas Sumatera Utara"
2. Langsung hitung rute tanpa GPS permission
3. Info rute muncul:
   - Titik awal: "Universitas Sumatera Utara"
   - Garis rute dari USU ke showroom
   - Petunjuk arah step-by-step
```

#### C. Test Input Custom Address
```
1. Ketik "Merdeka Walk Medan" di input box
2. Klik tombol search (ikon kaca pembesar)
3. System geocode alamat
4. Jika alamat valid:
   - Rute muncul
   - Info rute update
5. Jika alamat tidak ditemukan:
   - Alert "Alamat tidak ditemukan"
```

#### D. Test Petunjuk Arah Step-by-Step
```
1. Setelah rute muncul, scroll ke "Petunjuk Arah"
2. Harus ada list numbered (1, 2, 3, ...)
3. Setiap step berisi:
   - Instruksi (misal: "Belok kanan ke Jl. Gajah Mada")
   - Jarak untuk step tersebut (misal: "500 m")
4. Total step sesuai dengan rute Google Maps
```

#### E. Test Tombol "Buka di Google Maps"
```
1. Klik tombol biru "Buka di Google Maps"
2. Tab baru terbuka
3. Google Maps app/website terbuka
4. Lokasi showroom ter-centered
```

#### F. Test Tombol "Reset Rute"
```
1. Klik tombol "Reset Rute" (muncul setelah ada rute)
2. Garis rute hilang dari peta
3. Card "Informasi Rute" hilang
4. Map kembali zoom ke showroom saja
```

#### G. Test Status Real-time
```
Asumsi showroom buka 08:00-18:00, test di jam berbeda:

- Jam 10:00 (pagi):
  ✅ Badge hijau "Buka Sekarang"
  ✅ Text: "Tutup dalam 8 jam 0 menit"

- Jam 17:30 (sore):
  ✅ Badge kuning "Segera Tutup" (dengan animasi pulse)
  ✅ Text: "⚠️ Tutup dalam 30 menit!"

- Jam 19:00 (malam):
  ✅ Badge merah "Tutup"
  ✅ Text: "Buka besok jam 08:00"

- Jam 07:00 (pagi sebelum buka):
  ✅ Badge merah "Tutup"
  ✅ Text: "Buka dalam 1 jam 0 menit"
```

**Expected Result:**
- ✅ Rute terlihat jelas dengan garis merah tebal
- ✅ Info jarak & waktu akurat
- ✅ Petunjuk arah mudah dibaca
- ✅ No console errors

---

## 📱 Test 3: Detail Showroom Page (Updated)

### URL: http://localhost:8000/showroom/detail-page?nama=TOYOTA%20DELTAMAS%20BALAI%20KOTA

**Yang Harus Muncul:**
1. ✅ Tombol hijau besar "Lihat Peta & Dapatkan Arah"
2. ✅ Tombol berada di grid bersama Website Resmi

**Test Interaksi:**
```
1. Klik tombol "Lihat Peta & Dapatkan Arah"
2. Redirect ke: /maps/showroom?nama=...
3. Langsung masuk halaman rute (Test 2)
```

---

## 🏠 Test 4: Navbar Integration

### Di Halaman: http://localhost:8000/ (Showroom List)

**Yang Harus Muncul:**
1. ✅ Menu "Peta Showroom" di navbar (desktop)
2. ✅ Menu "Peta Showroom" di mobile menu
3. ✅ Background merah lebih gelap (active state)

**Test Interaksi:**
```
Desktop:
1. Klik "Peta Showroom" di navbar
2. Redirect ke /maps

Mobile:
1. Klik icon hamburger (mobile)
2. Menu dropdown muncul
3. Klik "Peta Showroom"
4. Redirect ke /maps
```

---

## 🔍 Browser Console Checks

Buka Console (F12) dan pastikan:

### ✅ HARUS ADA (Normal):
```
✓ initMap function called
✓ showrooms loaded: [Array of showrooms]
✓ user location: {lat: ..., lng: ...}
✓ geocoding success: ...
```

### ❌ TIDAK BOLEH ADA:
```
✗ InvalidKeyMapError
✗ RefererNotAllowedMapError  
✗ ApiNotActivatedMapError
✗ CORS error
✗ 403 Forbidden
```

### ⚠️ Boleh Ada (Warning Only):
```
⚠ cdn.tailwindcss.com should not be used in production
  → Ini OK untuk development

⚠ Google Maps JavaScript API has been loaded directly without loading=async
  → Sudah ada async defer di script tag, bisa diabaikan
```

---

## 📊 Performance Test

### Load Time Check:
```
1. Buka /maps
2. Buka DevTools (F12) → Network tab
3. Reload page (Ctrl+F5)
4. Check:
   - Maps API load time: < 2 detik
   - Total page load: < 5 detik
   - Geocoding requests: Sesuai jumlah showroom
```

### Marker Performance:
```
Dengan 10+ showroom:
✅ Semua marker muncul dalam < 3 detik
✅ Map tetap responsive (bisa zoom/pan)
✅ No lag saat filter
```

---

## 🌐 Mobile Responsive Test

### Test di Device:
- iPhone (Safari)
- Android (Chrome)
- Tablet (iPad)

### Yang Harus OK:
```
✅ Map full width di mobile
✅ Sidebar list muncul di bawah map
✅ Touch zoom/pan berfungsi
✅ Info window tidak kepotong
✅ Tombol-tombol tidak overlap
✅ Status badge readable di mobile
```

---

## 📝 Test Summary Template

Copy template ini untuk report hasil testing:

```
# Test Report - Maps Feature WheelTrack

Date: _____________
Tester: _____________
Browser: _____________

## Test Results:

### 1. Halaman Peta Showroom (/maps)
- [ ] Maps loaded successfully
- [ ] Markers displayed with correct colors
- [ ] Search filter working
- [ ] Location filter working  
- [ ] Status filter working
- [ ] Sort by nearest working
- [ ] Click marker shows info window
- [ ] Click card zooms to marker
- [ ] "Cari Terdekat" button working

**Issues Found:**
_________________

### 2. Halaman Detail Rute (/maps/showroom)
- [ ] Map centered to showroom
- [ ] Status badge real-time working
- [ ] Route from GPS working
- [ ] Route from USU working
- [ ] Route from custom address working
- [ ] Step-by-step directions shown
- [ ] "Open in Google Maps" working
- [ ] Reset route working

**Issues Found:**
_________________

### 3. Detail Showroom Integration
- [ ] "Lihat Peta" button appears
- [ ] Button redirects correctly
- [ ] Navbar menu appears
- [ ] Mobile menu working

**Issues Found:**
_________________

### 4. Performance
- Maps load time: _____ seconds
- Page load time: _____ seconds
- Mobile responsive: _____ (OK/Issues)

### 5. Console Errors
- [ ] No InvalidKeyMapError
- [ ] No CORS errors
- [ ] No 403/404 errors

**Errors Found:**
_________________

## Overall Status: ✅ PASS / ❌ FAIL

**Notes:**
_________________
```

---

## 🆘 Quick Fix Commands

Jika ada masalah, jalankan command ini:

```bash
# Clear all cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Check API key
cat .env | grep GOOGLE_MAPS_API_KEY

# Check routes
php artisan route:list --path=maps

# Restart server
# Ctrl+C
php artisan serve
```

---

## ✅ Testing Selesai!

Jika semua test checklist ✅, fitur Maps sudah production-ready! 🎉
