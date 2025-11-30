# 🔒 URGENT: Regenerate Exposed API Key

## ⚠️ Security Issue Detected

Google Cloud Platform telah mendeteksi bahwa API key Anda ter-expose secara public di GitHub:

```
Project: My First Project (white-cider-478103-v2)
Exposed Key: AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA
Location: https://github.com/andrefarizi/Tubes-WS/blob/a531c919b6ff93286b49a1d7b01611f8c965b34a/MAPS_SETUP.md
```

## 🚨 LANGKAH YANG HARUS DILAKUKAN SEGERA

### Step 1: Regenerate API Key (WAJIB!)

1. **Login ke Google Cloud Console**
   - Buka: https://console.cloud.google.com/
   - Pilih project: `My First Project` (white-cider-478103-v2)

2. **Masuk ke Credentials**
   - Menu: **APIs & Services** → **Credentials**
   - Cari API key: `AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA`

3. **Regenerate Key**
   - Klik pada API key tersebut
   - Klik tombol **"REGENERATE KEY"** (bukan delete!)
   - Confirm regeneration
   - **COPY API key yang baru**

4. **Atau Buat API Key Baru**
   - Jika tidak ada tombol "Regenerate", klik **"CREATE CREDENTIALS"**
   - Pilih **"API key"**
   - Copy API key baru
   - **DELETE API key lama** (AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA)

### Step 2: Update API Key di Local

1. **Edit file `.env`** (JANGAN commit file ini!)
   ```bash
   # Di file .env
   GOOGLE_MAPS_API_KEY=YOUR_NEW_API_KEY_HERE
   ```

2. **Clear Laravel cache**
   ```bash
   php artisan config:clear
   ```

3. **Restart development server**
   ```bash
   php artisan serve
   ```

### Step 3: Tambahkan API Key Restrictions (PENTING!)

Untuk mencegah abuse, tambahkan restrictions:

1. **Application Restrictions**
   - Buka API key di Google Cloud Console
   - Section: **Application restrictions**
   - Pilih: **HTTP referrers (web sites)**
   - Tambahkan referrer:
     ```
     http://localhost/*
     http://127.0.0.1/*
     https://yourdomain.com/*  (untuk production nanti)
     ```
   - Klik **SAVE**

2. **API Restrictions**
   - Section: **API restrictions**
   - Pilih: **Restrict key**
   - Centang hanya API yang dibutuhkan:
     - ✅ Maps JavaScript API
     - ✅ Geocoding API
     - ✅ Directions API
     - ✅ Places API
   - Klik **SAVE**

### Step 4: Monitor Billing & Usage

1. **Check Billing Activity**
   - Menu: **Billing** → **Reports**
   - Lihat apakah ada usage yang mencurigakan
   - Check tanggal/waktu usage

2. **Set Budget Alerts**
   - Menu: **Billing** → **Budgets & alerts**
   - Klik **CREATE BUDGET**
   - Set limit (misal: $10/month)
   - Set alert threshold: 50%, 90%, 100%
   - Add email untuk notifikasi

3. **Enable Quota Alerts**
   - Menu: **IAM & Admin** → **Quotas**
   - Set alerts untuk API usage limits

---

## ✅ Verification Checklist

Setelah regenerate API key, pastikan:

- [ ] API key lama sudah di-delete/regenerate
- [ ] API key baru sudah di `.env`
- [ ] `.env` tidak di-commit ke Git (check `.gitignore`)
- [ ] Application restrictions sudah di-set (HTTP referrers)
- [ ] API restrictions sudah di-set (4 APIs only)
- [ ] Budget alerts sudah di-setup
- [ ] Test aplikasi masih berfungsi:
  - [ ] http://localhost:8000/maps
  - [ ] http://localhost:8000/maps/showroom?nama=TOYOTA%20DELTAMAS%20BALAI%20KOTA
  - [ ] http://localhost:8000/test-maps

---

## 🔐 Best Practices untuk Keamanan API Key

### ❌ JANGAN:
- Commit file `.env` ke Git/GitHub
- Hardcode API key di source code
- Share API key di chat/email/documentation
- Publish API key di public repository
- Gunakan API key tanpa restrictions

### ✅ LAKUKAN:
- Simpan API key hanya di `.env` (local)
- Gunakan environment variables
- Add API key restrictions (referrers + API limits)
- Monitor billing & usage secara berkala
- Set budget alerts
- Regenerate key jika ter-expose
- Gunakan `.env.example` tanpa nilai untuk template

---

## 📝 File Structure yang Aman

```
Tubes-WS/
├── .env                          # ❌ NEVER COMMIT (contains real API key)
├── .env.example                  # ✅ Safe to commit (no real values)
├── .gitignore                    # ✅ Must include .env
├── config/maps.php              # ✅ Safe (loads from env)
└── resources/views/
    ├── maps.blade.php           # ✅ Safe (uses config())
    └── maps-detail.blade.php    # ✅ Safe (uses config())
```

### Contoh `.env` (LOCAL ONLY - NEVER COMMIT)
```env
GOOGLE_MAPS_API_KEY=AIzaSyC_YOUR_ACTUAL_NEW_KEY_HERE
```

### Contoh `.env.example` (SAFE TO COMMIT)
```env
GOOGLE_MAPS_API_KEY=
```

### Contoh Blade Template (SAFE)
```blade
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}"></script>
```

---

## 🆘 Jika Sudah Terlanjur Ter-expose

1. **Segera regenerate** API key (jangan tunggu!)
2. **Check billing** untuk usage yang tidak dikenali
3. **Report ke Google** jika ada abuse:
   - https://support.google.com/cloud/contact/cloud_platform_report
4. **Enable notifications** untuk future security alerts
5. **Review permissions** project GCP Anda

---

## 📞 Support & Resources

- **Google Cloud Security**: https://cloud.google.com/security
- **API Key Best Practices**: https://cloud.google.com/docs/authentication/api-keys
- **Compromised Credentials**: https://cloud.google.com/iam/docs/compromised-credentials
- **Budget Alerts**: https://cloud.google.com/billing/docs/how-to/budgets

---

## ⚠️ REMINDER

**API key yang ter-expose di commit `a531c919`:**
```
AIzaSyBy-ugy58EBTMwG2TqtBVlPhR8oF3LeMhA
```

**HARUS di-regenerate SEKARANG!**

Meskipun sudah di-remove dari file, key ini masih tercatat di Git history dan bisa diakses siapa saja.
