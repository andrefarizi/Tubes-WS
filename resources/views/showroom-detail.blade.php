<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Showroom - Showroom Indonesia</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    body { font-family: 'Inter', sans-serif; }
    :root { --logo-bg: #F3F4F6; }
    .logo-bg { background-color: var(--logo-bg) !important; }
  </style>
</head>
<body class="bg-gradient-to-br from-red-50 via-white to-red-50">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-red-600 to-red-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0 flex items-center">
          <i class="fas fa-car-side text-white text-3xl"></i>
          <span class="font-bold text-2xl text-white ml-3">Showroom Indonesia</span>
        </div>
        <div class="hidden md:block">
          
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Loading State -->
    <div id="loading" class="text-center py-20">
      <i class="fas fa-spinner fa-spin text-6xl text-red-600 mb-4"></i>
      <p class="text-gray-600 text-xl">Memuat detail showroom...</p>
    </div>

    <!-- Detail Content -->
    <div id="detailContent" class="hidden">
      
      <!-- Layout Horizontal - Background Merah Menyatu -->
      <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row" style="background-color: #c6c6c6;">
          
          <!-- Gambar Besar di Kiri -->
          <div class="lg:w-2/5 relative flex items-center justify-center p-12 logo-bg">
            <div class="absolute inset-0 bg-black/10"></div>
            <img id="showroomImage" src="" alt="Showroom" class="relative z-10 w-full max-w-md h-auto object-contain drop-shadow-2xl">
          </div>

          <!-- Informasi Detail di Kanan -->
          <div class="lg:w-3/5 p-8 lg:p-12 space-y-6 bg-white rounded-t-3xl lg:rounded-t-none lg:rounded-r-3xl">
            
            <!-- Nama Showroom -->
            <div>
              <h1 id="showroomName" class="showroom-title text-4xl lg:text-5xl font-extrabold text-gray-900 mb-3">-</h1>
              <p id="showroomMerek" class="text-red-600 text-xl font-bold mb-4">-</p>
            </div>

            <!-- Lokasi & Rating -->
            <div class="flex flex-wrap items-center gap-6 pb-6 border-b-2 border-gray-200">
              <div class="flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-red-600 text-xl"></i>
                <span id="showroomLokasi" class="text-gray-700 text-lg font-medium">-</span>
              </div>
              <div class="flex items-center gap-2">
                <span id="showroomStars" class="text-yellow-500 text-xl">-</span>
                <span id="showroomRating" class="text-gray-900 font-bold text-xl">-</span>
              </div>
            </div>

            <!-- Grid Info Detail -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              
              <!-- Alamat -->
              <div class="md:col-span-2">
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-location-dot text-red-600"></i>
                  Alamat
                </h2>
                <p id="showroomAlamat" class="text-gray-700 text-base leading-relaxed">-</p>
              </div>

              <!-- Jam Operasional -->
              <div>
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-clock text-red-600"></i>
                  Jam Operasional
                </h2>
                <div id="showroomJamOperasional" class="text-gray-700 text-base">-</div>
              </div>

              <!-- Telepon -->
              <div>
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-phone text-red-600"></i>
                  Kontak
                </h2>
                <a id="showroomTelepon" href="tel:" class="text-red-600 hover:text-red-700 font-semibold text-base flex items-center gap-2 transition-colors">
                  <i class="fas fa-phone-volume"></i>
                  <span>-</span>
                </a>
              </div>

               <div>
    <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
      <i class="fas fa-globe text-red-600"></i>
      Website Resmi
    </h2>
    <a id="showroomWebsite"
       href="#"
       target="_blank"
       rel="noopener"
       class="text-red-600 hover:text-red-700 font-semibold text-base flex items-center gap-2 transition-colors">
      <i class="fas fa-arrow-up-right-from-square"></i>
      <span>Kunjungi situs</span>
    </a>
  </div>


            </div>

            <!-- Tombol Kembali -->
            <div class="pt-6">
              <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar</span>
              </a>
            </div>

          </div>

        </div>
      </div>

    </div>

    <!-- Error State -->
    <div id="errorContent" class="hidden text-center py-20">
      <i class="fas fa-exclamation-triangle text-6xl text-red-400 mb-4"></i>
      <p class="text-red-600 text-2xl font-semibold mb-2">Showroom Tidak Ditemukan</p>
      <p class="text-gray-600 mb-6">Data showroom tidak dapat dimuat</p>
      <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar
      </a>
    </div>

  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Ambil nama showroom dari URL parameter
      const urlParams = new URLSearchParams(window.location.search);
      const showroomName = urlParams.get('nama');

      if (!showroomName) {
        showError();
        return;
      }

      loadShowroomDetail(showroomName);
    });

    async function loadShowroomDetail(nama) {
      try {
        const response = await fetch(`{{ url('/showroom/detail') }}?nama=${encodeURIComponent(nama)}`);
        
        console.log('Response status:', response.status);
        
        if (!response.ok) {
          const errorData = await response.json();
          console.error('Error response:', errorData);
          throw new Error(errorData.error || 'Gagal memuat data');
        }

        const data = await response.json();
        console.log('Data received:', data);
        
        if (!data || Object.keys(data).length === 0) {
          throw new Error('Data tidak ditemukan');
        }

        displayShowroomDetail(data);
        
      } catch (error) {
        console.error('Error:', error);
        showError();
      }
    }

  function displayShowroomDetail(data) {
      // Ambil nilai dari response
      const nama = data.nama?.value || 'Nama tidak tersedia';
      const merek = data.merek?.value || '-';
      const lokasi = data.lokasi?.value || '-';
      const alamat = data.alamat?.value || 'Alamat tidak tersedia';
  // Data bisa memakai noTelepon (lihat SPARQL) atau telepon sebelumnya
  const telepon = data.noTelepon?.value || data.telepon?.value || '-';
      const jamOperasional = data.jamOperasional?.value || 'Tidak tersedia';
      const rating = data.rating?.value || '-';

      // Logo berdasarkan merek
      const logo = getBrandLogo(merek);

      // Rating stars
      const ratingNum = parseFloat(rating) || 0;
      let stars = '-';
      if (ratingNum > 0) {
        const fullStars = '★'.repeat(Math.floor(ratingNum));
        const emptyStars = '☆'.repeat(5 - Math.floor(ratingNum));
        stars = fullStars + emptyStars;
      }

      // Update DOM
      const nameEl = document.getElementById('showroomName');
      nameEl.textContent = nama;
      const len = nama.length;
      // Resize logic: keep card size stable, only adjust font size
      if (len > 95) {
        nameEl.classList.remove('text-4xl','lg:text-5xl');
        nameEl.classList.add('text-2xl','lg:text-3xl');
      } else if (len > 70) {
        nameEl.classList.remove('text-4xl','lg:text-5xl');
        nameEl.classList.add('text-3xl','lg:text-4xl');
      }
      document.getElementById('showroomMerek').textContent = merek;
      document.getElementById('showroomLokasi').textContent = lokasi;
      document.getElementById('showroomAlamat').textContent = alamat;
      document.getElementById('showroomJamOperasional').textContent = jamOperasional;
      document.getElementById('showroomRating').textContent = rating;
      document.getElementById('showroomStars').textContent = stars;
      
      const teleponLink = document.getElementById('showroomTelepon');
      if (telepon && telepon !== '-') {
        teleponLink.href = `tel:${telepon}`;
        teleponLink.querySelector('span').textContent = telepon;
      } else {
        teleponLink.removeAttribute('href');
        teleponLink.querySelector('span').textContent = 'Tidak tersedia';
      }

      const imgElement = document.getElementById('showroomImage');
      imgElement.src = logo;
      imgElement.alt = merek;

      // Show content, hide loading
      document.getElementById('loading').classList.add('hidden');
      document.getElementById('detailContent').classList.remove('hidden');
    }

    function showError() {
      document.getElementById('loading').classList.add('hidden');
      document.getElementById('errorContent').classList.remove('hidden');
    }

    function getBrandLogo(merek) {
      const brandLogos = {
        'toyota': "{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}",
        'honda': "{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}",
        'bmw': "{{ asset('images/BMW.svg.png') }}",
        'daihatsu': "{{ asset('images/daihatsu-logo-png_seeklogo-201025.png') }}",
        'mitsubishi': "{{ asset('images/Mitsubishi-logo.png') }}",
        'suzuki': "{{ asset('images/1280px-suzuki-logo-2svg-618bfa5b29cfbdff54b843503f462364.png') }}",
        'byd': "{{ asset('images/byd-logo-png_seeklogo-546145.png') }}",
        'nissan': "{{ asset('images/Nissan-Logo-PNG-Clipart.png') }}",
        'mercedes': "{{ asset('images/mercedes-benz-logo-png_seeklogo-190348.png') }}",
        'kia': "{{ asset('images/Kia-Motors-Logo-500x281.png') }}",
        'hyundai': "{{ asset('images/Sejarah-Mobil-Hyundai.png') }}",
        'chevrolet': "{{ asset('images/Chevrolet-logo.png') }}",
        'wuling': "{{ asset('images/wuling-logo-png_seeklogo-383139.png') }}",
        'mg': "{{ asset('images/logo-mg-morris.png') }}",
        'isuzu': "{{ asset('images/Isuzu-logo.png') }}",
        'dfsk': "{{ asset('images/logo-dfsk-small.png') }}",
        'datsun': "{{ asset('images/Datsun-logo-2013-2560x1440.png') }}",
        'chery': "{{ asset('images/Chery-Logo-1997.png') }}",
        'ford': "{{ asset('images/580b57fcd9996e24bc43c47c.png') }}",
        'default': "{{ asset('images/unnamed.png') }}"
      };

      const cleanMerek = (merek || '').toLowerCase().replace('dealer ', '').trim();
      
      if (brandLogos[cleanMerek]) {
        return brandLogos[cleanMerek];
      }
      
      for (const key in brandLogos) {
        if (cleanMerek.includes(key)) {
          return brandLogos[key];
        }
      }
      
      return brandLogos['default'];
    }
  </script>

</body>
</html>
