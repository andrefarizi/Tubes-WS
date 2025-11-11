<!DOCTYPE html>
<html lang="id">
<head>
  <title>Showroom Mobil</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h1 { text-align: center; }
    .search-bar {
      display: flex; gap: 10px; justify-content: center;
      align-items: center; margin-bottom: 20px; flex-wrap: wrap;
    }
    input, select { padding: 10px; font-size: 16px; }
    input { width: 40%; min-width: 260px; }
    select { min-width: 200px; }
    #results { display: flex; flex-wrap: wrap; justify-content: center; }
    .card {
  border: 6px solid #ccc;
  padding: 12px;
  margin: 10px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  width: 65%; /* Ubah sesuai kebutuhan */
  min-width: 320px;
  background: #f9f9f9;
  height: 200px; /* Atur tinggi card agar lebih persegi panjang */
  display: flex;
  flex-direction: column; /* Untuk memastikan konten teratur secara vertikal */
  justify-content: space-between; /* Menjaga jarak antar elemen dalam card */
}
    a { color: #007bff; text-decoration: none; }
  </style>
</head>
<body>
  <h1>Daftar Showroom Mobil</h1>

  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Cari merek atau mobil...">

    <select id="locationSelect" title="Filter lokasi">
      <option value="">Semua Lokasi</option>
    </select>

    <!-- Baru: urutkan rating -->
    <select id="sortSelect" title="Urutkan rating">
      <option value="">Semua Rating</option>
      <option value="desc">Tertinggi ke Terendah</option>
      <option value="asc">Terendah ke Tertinggi</option>
    </select>
  </div>

  <div id="results">Memuat data showroom...</div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const searchInput    = document.getElementById('searchInput');
      const locationSelect = document.getElementById('locationSelect');
      const sortSelect     = document.getElementById('sortSelect');
      const resultsDiv     = document.getElementById('results');

      const LOC_URL    = "{{ url('/showroom/locations') }}";
      const SEARCH_URL = "{{ url('/search') }}";

      // isi dropdown lokasi
      fetch(LOC_URL)
        .then(res => res.json())
        .then(locations => {
          locations.forEach(loc => {
            const opt = document.createElement('option');
            opt.value = loc;
            opt.textContent = loc;
            locationSelect.appendChild(opt);
          });
        })
        .catch(() => {
          locationSelect.innerHTML = '<option value="">Gagal memuat lokasi</option>';
        });

      async function searchShowroom() {
        try {
          const keyword = searchInput.value || '';
          const lokasi  = locationSelect.value || '';
          const sort    = sortSelect.value || '';

          resultsDiv.textContent = 'Memuat data showroom...';

          const url = `${SEARCH_URL}?q=${encodeURIComponent(keyword)}&lokasi=${encodeURIComponent(lokasi)}&sort=${encodeURIComponent(sort)}`;
          const res = await fetch(url);
          if (!res.ok) throw new Error(`HTTP ${res.status}`);
          const data = await res.json();

          resultsDiv.innerHTML = '';
          if (!Array.isArray(data) || data.length === 0) {
            resultsDiv.innerHTML = '<p>Tidak ada showroom ditemukan.</p>';
            return;
          }

          data.forEach(item => {
            const nama   = item.nama?.value || 'Tidak ada nama';
            const rating = item.rating?.value || '-';
            const merek  = item.merek?.value || '-';
            const lok    = item.lokasi?.value || '-';
            const alamat = item.alamat?.value || '-';
            const telp   = item.noTelepon?.value || '-';
            const jam    = item.jamOperasional?.value || '-';
            const web    = item.website?.value || '';

            resultsDiv.innerHTML += `
              <div class="card">
                <b>${nama}</b><br>
                Rating: ${rating}<br>
                Merek: ${merek}<br>
                Lokasi: ${lok}<br>
                Alamat: ${alamat}<br>
                Telepon: ${telp}<br>
                Jam Operasional: ${jam}<br>
                ${web ? `<a href="${web}" target="_blank" rel="noopener">Kunjungi Situs</a>` : ''}
              </div>
            `;
          });
        } catch (err) {
          resultsDiv.innerHTML = `<p>Terjadi kesalahan: ${err.message}</p>`;
        }
      }

      // Hanya event input yang memicu pencarian (auto-search)
      searchInput.addEventListener('input', searchShowroom);
      locationSelect.addEventListener('change', searchShowroom);
      sortSelect.addEventListener('change', searchShowroom);

      // Tampilkan 25 showroom acak saat pertama kali
      searchShowroom();
    });
  </script>

</body>
</html>
