<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Showroom - Showroom Indonesia</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    :root {
      --logo-bg: #F3F4F6;
    }

    .logo-bg {
      background-color: var(--logo-bg) !important;
    }

    @keyframes float {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .floating-logo {
      animation: float 3s ease-in-out infinite;
    }


    @keyframes fadeFloat {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .scroll-hidden {
      opacity: 0;
      transform: translateY(20px);
    }

    .scroll-show {
      animation: fadeFloat 0.9s ease-out forwards;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-red-50 via-white to-red-50">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-red-600 to-red-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0 flex items-center">
          <img src="/images/logo 1.png" alt="WheelTrack" class="h-12 w-auto object-contain">
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Loading -->
    <div id="loading" class="text-center py-20">
      <i class="fas fa-spinner fa-spin text-6xl text-red-600 mb-4"></i>
      <p class="text-gray-600 text-xl">Memuat detail showroom...</p>
    </div>

    <!-- Detail -->
    <div id="detailContent" class="hidden">

      <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row" style="background-color: #c6c6c6;">

          <!-- Gambar -->
          <div class="lg:w-2/5 relative flex items-center justify-center p-12 logo-bg">
            <div class="absolute inset-0 bg-black/10"></div>
            <img id="showroomImage" src="" alt="Showroom" class="relative z-10 w-full max-w-md h-auto object-contain drop-shadow-2xl floating-logo">
            <a href="{{ url('/') }}"
              class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg 
             hover:bg-red-600 hover:text-white transition-all flex items-center gap-2 font-semibold">
              <i class="fas fa-arrow-left"></i>
              <span class="">Back</span>
            </a>

          </div>

          <!-- Detail -->
          <div class="lg:w-3/5 p-8 lg:p-12 space-y-6 bg-white rounded-t-3xl lg:rounded-r-3xl">

            <div>
              <h1 id="showroomName" class="showroom-title text-3xl lg:text-4xl font-extrabold text-gray-900 mb-3">-</h1>
              <p id="showroomMerek" class="text-red-600 text-xl font-bold mb-4">-</p>
            </div>

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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-location-dot text-red-600"></i>
                  Alamat
                </h2>
                <p id="showroomAlamat" class="text-gray-700 text-base leading-relaxed">-</p>
              </div>

              <div>
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-clock text-red-600"></i>
                  Jam Operasional
                </h2>
                <div id="showroomJamOperasional" class="text-gray-700 text-base">-</div>
              </div>

              <div>
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-phone text-red-600"></i>
                  Kontak
                </h2>
                <a id="showroomTelepon" href="tel:" class="text-red-600 hover:text-red-700 font-semibold text-base flex items-center gap-2 transition-colors">
                  <span>-</span>
                </a>
              </div>

              <div>
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-globe text-red-600"></i>
                  Website Resmi
                </h2>
                <a id="showroomWebsite" href="#" target="_blank" rel="noopener"
                  class="inline-flex items-center gap-3 px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 
                  text-white font-semibold rounded-xl shadow-md hover:from-red-600 hover:to-red-700 
                    transition-all duration-200">
                  <i class="fas fa-arrow-up-right-from-square"></i>
                  <span>Kunjungi Situs</span>
                </a>

              </div>
            </div>



          </div>

        </div>
      </div>

    </div>

    <!-- ERROR -->
    <div id="errorContent" class="hidden text-center py-20">
      <i class="fas fa-exclamation-triangle text-6xl text-red-400 mb-4"></i>
      <p class="text-red-600 text-2xl font-semibold mb-2">Showroom Tidak Ditemukan</p>
      <p class="text-gray-600 mb-6">Data showroom tidak dapat dimuat</p>
      <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all">
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali ke Daftar
      </a>
    </div>

    <!-- FOTO MOBIL -->
    <div id="mobilContainer" class="hidden mt-20 mb-2">
      <h2 class="text-2xl font-extrabold text-red-600 mb-4 flex items-center gap-4 text-align-center justify-center">
        <i class="fas fa-car text-gray-800"></i>
        Produk Showroom
        <i class="fas fa-car text-gray-800"></i>
      </h2>

      <div class="w-full bg-white p-6 rounded-3xl shadow-xl flex justify-center">
        <img
          id="mobilImage"
          src=""
          alt="Foto Mobil"
          class="w-full max-w-4xl h-auto object-contain rounded-3xl shadow-lg bg-white scroll-hidden">
      </div>


    </div>

  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
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

        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.error || 'Gagal memuat data');
        }

        const data = await response.json();
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
    const nama = data.nama?.value || 'Nama tidak tersedia';
    const merek = data.merek?.value || '-';
    const lokasi = data.lokasi?.value || '-';
    const alamat = data.alamat?.value || 'Alamat tidak tersedia';
    const telepon = data.noTelepon?.value || data.telepon?.value || '-';
    const jamOperasional = data.jamOperasional?.value || 'Tidak tersedia';
    const rating = data.rating?.value || '-';
    
    // [PERUBAHAN 1: Ambil data website]
    const website = data.website?.value || '#'; 

    const logo = getBrandLogo(merek);
    const ratingNum = parseFloat(rating) || 0;

    let stars = '-';
    if (ratingNum > 0) {
        const filled = '★'.repeat(Math.floor(ratingNum));
        const empty = '☆'.repeat(5 - Math.floor(ratingNum));
        stars = filled + empty;
    }

    document.getElementById('showroomName').textContent = nama;
    document.getElementById('showroomMerek').textContent = merek;
    document.getElementById('showroomLokasi').textContent = lokasi;
    document.getElementById('showroomAlamat').textContent = alamat;
    document.getElementById('showroomJamOperasional').textContent = jamOperasional;
    document.getElementById('showroomRating').textContent = rating;
    document.getElementById('showroomStars').textContent = stars;

    const tel = document.getElementById('showroomTelepon');
    if (telepon && telepon !== '-') {
        tel.href = `tel:${telepon}`;
        tel.querySelector('span').textContent = telepon;
    } else {
        tel.removeAttribute('href');
        tel.querySelector('span').textContent = 'Tidak tersedia';
    }

    // [PERUBAHAN 2: Logic Website Resmi]
    const web = document.getElementById('showroomWebsite');
    const webSpan = web.querySelector('span'); 
    
    if (website && website !== '#' && website !== '-') {
        // Pastikan URL memiliki protokol (http/https)
        const fullUrl = website.startsWith('http') || website.startsWith('https') ? website : `http://${website}`;
        
        web.href = fullUrl;
        web.target = '_blank';
        
        // Mengaktifkan style warna merah (active)
        web.classList.remove('bg-gray-400', 'hover:bg-gray-500'); 
        web.classList.add('from-red-500', 'to-red-600', 'hover:from-red-600', 'hover:to-red-700');
        webSpan.textContent = 'Kunjungi Situs';
        web.disabled = false;
        web.removeAttribute('title');
    } else {
        web.removeAttribute('href');
        web.removeAttribute('target');
        // Menonaktifkan style (warna abu-abu)
        web.classList.add('bg-gray-400', 'hover:bg-gray-500'); 
        web.classList.remove('from-red-500', 'to-red-600', 'hover:from-red-600', 'hover:to-red-700');
        webSpan.textContent = 'Tidak tersedia';
        web.disabled = true;
        web.title = 'Website tidak tersedia'; 
    }
    // [AKHIR LOGIC PERUBAHAN WEBSITE]
    
    const imgElement = document.getElementById('showroomImage');
    imgElement.src = logo;

    document.getElementById('loading').classList.add('hidden');
    document.getElementById('detailContent').classList.remove('hidden');


    const mobilImage = document.getElementById('mobilImage');
    const mobilContainer = document.getElementById('mobilContainer');

    const cleanMerek = merek.toLowerCase().replace('dealer ', '').trim();
    const mobilSrc = `/images/${cleanMerek}.png`;

    mobilImage.src = mobilSrc;

    fetch(mobilSrc)
        .then(res => {
            if (res.ok) {
                mobilContainer.classList.remove('hidden');
                mobilImage.alt = `Mobil ${merek}`;
            } else {
                mobilContainer.classList.add('hidden');
            }
        })
        .catch(() => mobilContainer.classList.add('hidden'));
}

    function showError() {
      document.getElementById('loading').classList.add('hidden');
      document.getElementById('errorContent').classList.remove('hidden');
    }

    function getBrandLogo(merek) {
      const logos = {
        'toyota': "{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}",
        'honda': "{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}",
        'bmw': "{{ asset('images/BMW.svg.png') }}",
        'daihatsu': "{{ asset('images/daihatsu-logo-png_seeklogo-201025.png') }}",
        'mitsubishi': "{{ asset('images/Mitsubishi-logo.png') }}",
        'suzuki': "{{ asset('images/1280px-suzuki-logo-2svg-618bfa5b29cfbdff54b843503f462364.png') }}",
        'byd': "{{ asset('images/byd-logo-png_seeklogo-546145.png') }}",
        'nissan': "{{ asset('images/Nissan-Logo-PNG-Clipart.png') }}",
        'mercedes-benz': "{{ asset('images/mercedes-benz-logo-png_seeklogo-190348.png') }}",
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
        'mazda': "{{ asset('images/mazda_logo.png') }}",
        'aion': "{{ asset('images/aion2.png') }}",
        'default': "{{ asset('images/unnamed.png') }}"
      };

      const key = (merek || '').toLowerCase().replace('dealer ', '').trim();
      return logos[key] || logos['default'];
    }

    const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('scroll-show');
        observer.unobserve(entry.target); // animasi sekali saja
      }
    });
  }, { threshold: 0.2 });

  const target = document.getElementById('mobilImage');
  if (target) observer.observe(target);
  </script>

</body>

</html>