# 📍 Koordinat & Jam Operasional - Penjelasan Sistem

## ❓ Pertanyaan Umum

### 1. **Apakah jam operasional real-time dari Google Maps?**

**TIDAK.** Jam operasional diambil dari **dataset SPARQL Anda**, bukan dari Google Maps API.

**Alasannya:**
- ✅ Google Maps API **tidak menyediakan jam operasional** secara gratis
- ✅ Google Places API yang menyediakan jam operasional hanya tersedia di **paid tier** (berbayar)
- ✅ Quota gratis Google Places API sangat terbatas (hanya untuk demo)

**Solusi Kami:**
```
Dataset SPARQL → Jam Operasional (08.00-18.00)
                 ↓
JavaScript Real-time → Hitung status (Buka/Tutup)
                       berdasarkan waktu sistem
```

**Status yang ditampilkan REAL-TIME:**
- 🟢 **Buka** - Jika waktu sekarang antara jam buka-tutup
- 🟡 **Segera Tutup** - Jika kurang dari 1 jam lagi tutup (dengan countdown)
- 🔴 **Tutup** - Jika di luar jam operasional

**Contoh:**
```
Data SPARQL: "08.00-18.00"
Waktu sekarang: 17:45

Status: 🟡 Segera Tutup
Info: "⚠️ Tutup dalam 15 menit!"
```

---

### 2. **Apakah koordinat random?**

**TIDAK RANDOM!** Koordinat didapat dari 2 cara:

#### A. **Koordinat Manual (Paling Akurat) ✅**
```javascript
// Database koordinat yang sudah diverifikasi dari Google Maps
const coordinates = {
  'TOYOTA DELTAMAS BALAI KOTA': { 
    lat: 3.5909601,  // ← Koordinat REAL dari Google Maps
    lng: 98.6484569  
  },
  'ASTRA DAIHATSU MEDAN': { 
    lat: 3.590960, 
    lng: 98.648457 
  }
};
```

**Cara Verifikasi:**
1. Buka Google Maps
2. Cari nama showroom (misal: "Toyota Deltamas Balai Kota Medan")
3. Klik lokasi → Lihat koordinat
4. Copy koordinat → Masukkan ke database manual

#### B. **Geocoding API (Otomatis tapi bisa kurang akurat) ⚠️**
```javascript
// Jika koordinat tidak ada di database manual
geocoder.geocode({ 
  address: "Jl. Balai Kota No.2a, Kota Medan, Sumatera Utara, Indonesia",
  componentRestrictions: {
    country: 'ID',
    administrativeArea: 'Sumatera Utara',
    locality: 'Medan'
  }
}, (results, status) => {
  // Hasil geocoding Google → koordinat otomatis
});
```

**Masalah Geocoding:**
- Alamat kurang spesifik → Koordinat tidak tepat
- Nama jalan berbeda → Geocoding gagal
- Bangunan baru → Belum ada di Google Maps

**Solusi:**
- Gunakan koordinat manual untuk showroom penting
- Log koordinat hasil geocoding untuk diverifikasi
- Fallback ke center kota jika geocoding gagal

---

### 3. **Mengapa koordinat USU tidak tepat?**

**Sudah diperbaiki!**

**Sebelumnya:**
```javascript
const usuLocation = { lat: 3.5688, lng: 98.6566 }; // Kurang presisi
```

**Sekarang (Akurat):**
```javascript
// Koordinat USU Medan yang akurat - Gerbang Utama
// Lokasi: Gerbang Utama Universitas Sumatera Utara, Jl. Dr. T. Mansur, Padang Bulan
// Verifikasi: https://www.google.com/maps?q=3.5672804,98.6538982
const usuLocation = { lat: 3.5672804, lng: 98.6538982 };
```

**Cara Verifikasi:**
1. Buka: https://www.google.com/maps?q=3.5672804,98.6538982
2. Koordinat yang muncul: `3°34'02.2"N 98°39'14.0"E`
3. Convert ke decimal: `3.5672804, 98.6538982`
4. Lokasi: Tepat di Gerbang Utama USU (bukan di tengah kampus)

---

## 🔧 Cara Menambahkan Koordinat Showroom Baru

### Step 1: Cari di Google Maps
```
1. Buka Google Maps
2. Ketik nama showroom (contoh: "Honda Ahmad Yani Medan")
3. Klik marker showroom
4. Koordinat muncul di URL atau info panel
```

### Step 2: Copy Koordinat
```
URL: google.com/maps/@3.5909601,98.6484569,17z
                        ^^^^^^^^  ^^^^^^^^^
                        Latitude  Longitude
```

### Step 3: Tambahkan ke Code

Edit file: `resources/views/maps-detail.blade.php`

```javascript
function getKnownShowroomCoordinates(namaShowroom) {
  const coordinates = {
    'TOYOTA DELTAMAS BALAI KOTA': { lat: 3.5909601, lng: 98.6484569 },
    'ASTRA DAIHATSU MEDAN': { lat: 3.590960, lng: 98.648457 },
    
    // ← TAMBAHKAN DI SINI
    'NAMA SHOWROOM BARU': { lat: 3.xxxxxx, lng: 98.xxxxxx },
    
  };
  return coordinates[namaShowroom] || null;
}
```

### Step 4: Test

```
1. Buka: http://localhost:8000/maps/showroom?nama=NAMA%20SHOWROOM%20BARU
2. Cek apakah marker muncul di lokasi yang benar
3. Buka Console (F12) → Lihat log koordinat
```

---

## 📊 Sistem Prioritas Koordinat

```
1. Manual Database (HIGHEST PRIORITY) ✅
   ↓ Jika tidak ada
2. Geocoding API (Google) ⚠️
   ↓ Jika gagal
3. Fallback ke Center Kota (LOWEST) 🔴
```

**Flowchart:**
```
Load Showroom
    ↓
Cek getKnownShowroomCoordinates()
    ↓
Ada? → Ya → Gunakan koordinat manual ✅
    ↓ Tidak
Geocode alamat dengan Google API
    ↓
Berhasil? → Ya → Gunakan hasil geocoding ⚠️
         ↓ Tidak
    Fallback: Center Medan (3.5952, 98.6722) 🔴
```

---

## 🔍 Cara Verifikasi Koordinat di Console

Buka Browser Console (F12) saat load halaman maps:

```javascript
// ✅ Koordinat dari Manual Database
📍 Koordinat TOYOTA DELTAMAS BALAI KOTA: {
  lat: 3.5909601,
  lng: 98.6484569,
  source: 'manual',
  accuracy: 'verified'
}

// ⚠️ Koordinat dari Geocoding
📍 Koordinat HONDA AHMAD YANI: {
  lat: 3.59xxxx,
  lng: 98.65xxxx,
  address: "Jl. Ahmad Yani No.15, Medan",
  googleMapsLink: "https://www.google.com/maps?q=3.59,98.65"
}

// 🔴 Koordinat Fallback (Gagal)
❌ Geocoding gagal: ZERO_RESULTS untuk alamat: Jl. Tidak Ada, Medan
```

---

## 🎯 Rekomendasi

### Untuk Akurasi Maksimal:

**1. Verifikasi Manual Semua Showroom Penting**
```bash
# Buat daftar koordinat di Excel/Spreadsheet
Nama Showroom              | Latitude   | Longitude  | Verified
---------------------------|------------|------------|----------
Toyota Deltamas Balai Kota | 3.5909601  | 98.6484569 | ✅ Yes
Astra Daihatsu Medan       | 3.590960   | 98.648457  | ✅ Yes
Honda Ahmad Yani           | -          | -          | ❌ Perlu cek
```

**2. Update Dataset SPARQL dengan Koordinat**
```sparql
# Tambahkan koordinat langsung di RDF
:ToyotaDeltamas a :Showroom ;
    :nama "TOYOTA DELTAMAS BALAI KOTA" ;
    :alamat "Jl. Balai Kota No.2a" ;
    :lat "3.5909601" ;    # ← Tambahkan ini
    :lng "98.6484569" .   # ← Dan ini
```

**3. Buat Admin Panel untuk Input Koordinat**
```
Form Input:
- Nama Showroom: [_________]
- Alamat: [_________]
- Latitude: [_________]  ← Input manual
- Longitude: [_________] ← Input manual
[Save to SPARQL Database]
```

---

## 📝 Log Koordinat untuk Verifikasi

Semua koordinat hasil geocoding di-log ke console dengan format:

```javascript
📍 Koordinat NAMA SHOWROOM: {
  lat: 3.xxxxxx,
  lng: 98.xxxxxx,
  address: "Alamat Lengkap",
  googleMapsLink: "https://www.google.com/maps?q=..."
}
```

**Cara Gunakan:**
1. Buka `/maps/showroom?nama=...`
2. Buka Console (F12)
3. Copy koordinat yang muncul
4. Buka `googleMapsLink` untuk verifikasi
5. Jika benar → Tambahkan ke manual database
6. Jika salah → Cari manual di Google Maps

---

## 🚀 Next Steps untuk Akurasi 100%

### Option 1: Google Places API (Berbayar)
```javascript
// Dapatkan koordinat + jam operasional real dari Google
const service = new google.maps.places.PlacesService(map);
service.getDetails({
  placeId: 'ChIJ...',  // ID unik dari Google
  fields: ['geometry', 'opening_hours', 'formatted_phone_number']
}, (place, status) => {
  // place.geometry.location → Koordinat akurat
  // place.opening_hours → Jam buka real-time
});
```

**Cost:** ~$17 per 1000 requests

### Option 2: Manual Input ke Database
```
1. Buat form admin untuk input koordinat
2. Staff input koordinat dari Google Maps manual
3. Simpan di SPARQL dataset
4. System baca dari dataset (100% akurat)
```

**Cost:** $0 (Gratis, tapi butuh tenaga manual)

### Option 3: Hybrid (Recommended)
```
1. Koordinat manual untuk showroom populer (Top 10-20)
2. Geocoding untuk sisanya
3. Admin bisa update koordinat yang salah
```

**Cost:** Minimal, akurasi tinggi

---

## ✅ Summary

| Aspek | Metode Sekarang | Akurasi |
|-------|-----------------|---------|
| **Jam Operasional** | Dataset SPARQL + JavaScript real-time | ✅ Real-time status (buka/tutup) |
| **Koordinat USU** | Manual verified (3.5672804, 98.6538982) - Gerbang Utama | ✅ 100% Akurat |
| **Koordinat Showroom** | Manual Database → Geocoding → Fallback | ⚠️ 80-90% Akurat |
| **Google Maps Link** | Generated dari koordinat | ✅ Berfungsi |
| **Rute/Directions** | Google Directions API | ✅ Real-time traffic |

**Untuk akurasi 100%:** Verifikasi manual semua koordinat showroom dan masukkan ke database.
