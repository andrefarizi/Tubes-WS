<!DOCTYPE html>
<html lang="id">

<head>
  <title>Sumut Showroom Searching</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

    /* Scroll margin untuk kompensasi navbar sticky */
    #home,
    #cara-kerja,
    #form-searching,
    #daftar-showroom {
      scroll-margin-top: 80px;
    }

    /* Animasi marquee untuk logo mobil */
    @keyframes marquee-right {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }
    }

    @keyframes marquee-left {
      0% {
        transform: translateX(-50%);
      }

      100% {
        transform: translateX(0);
      }
    }

    .marquee-container {
      overflow: hidden;
      position: relative;
      background: transparent;
    }

    .marquee-content {
      display: flex;
      width: max-content;
    }

    .marquee-right {
      animation: marquee-right 40s linear infinite;
    }

    .marquee-left {
      animation: marquee-left 40s linear infinite;
    }


    .logo-item {
      flex-shrink: 0;
      width: 150px;
      height: 80px;
      margin: 0 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      border-radius: 12px;
      padding: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      pointer-events: none;
    }

    .logo-item:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 16px rgba(220, 38, 38, 0.3);
    }

    .logo-item img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
      filter: grayscale(20%);
      transition: filter 0.3s ease;
    }


    .logo-item:hover img {
      filter: grayscale(0%);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-red-50 via-white to-red-50">

  <!-- Navbar dengan Menu -->
  <nav class="bg-gradient-to-r from-red-600 to-red-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0 flex items-center">
          <i class="fas fa-car-side text-white text-3xl"></i>
          <span class="font-bold text-2xl text-white ml-3">Showroom Sumut</span>
        </div>
        <div class="hidden md:flex items-center space-x-1">
          <a href="#home" class="text-white hover:bg-red-800 px-4 py-2 rounded-lg transition-all duration-200 font-medium">
            <i class="fas fa-home mr-2"></i>Home
          </a>
          <a href="#cara-kerja" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
            <i class="fas fa-info-circle mr-2"></i>Cara Kerja
          </a>
          <a href="#form-searching" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
            <i class="fas fa-search mr-2"></i>Searching
          </a>
          <a href="#daftar-showroom" class="text-white hover:bg-red-800 px-4 py-2 rounded-lg transition-all duration-200 font-medium">
            <i class="fas fa-list mr-2"></i>Daftar Showroom
          </a>
        </div>
        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button id="mobile-menu-button" class="text-white hover:bg-red-800 p-2 rounded-lg">
            <i class="fas fa-bars text-2xl"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-red-700">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="#home" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-home mr-2"></i>Home
        </a>
        <a href="#cara-kerja" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-info-circle mr-2"></i>Cara Kerja
        </a>
        <a href="#form-searching" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-search mr-2"></i>Searching
        </a>
        <a href="#daftar-showroom" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-list mr-2"></i>Daftar Showroom
        </a>
      </div>
    </div>
  </nav>

  <!-- Section Home -->
  <div id="home" class="relative py-16 bg-gradient-to-br from-gray-100 to-gray-200">

    <!-- Background Animasi Logo Mobil - 3 Baris (di belakang) -->
    <div class="absolute inset-0 overflow-hidden">

      <!-- Baris 1 - Bergerak ke kanan -->
      <div class="marquee-container py-3">
        <div class="marquee-content marquee-right">
          <div class="logo-item"><img src="{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}" alt="Toyota"></div>
          <div class="logo-item"><img src="{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}" alt="Honda"></div>
          <div class="logo-item"><img src="{{ asset('images/BMW.svg.png') }}" alt="BMW"></div>
          <div class="logo-item"><img src="{{ asset('images/Mitsubishi-logo.png') }}" alt="Mitsubishi"></div>
          <div class="logo-item"><img src="{{ asset('images/1280px-suzuki-logo-2svg-618bfa5b29cfbdff54b843503f462364.png') }}" alt="Suzuki"></div>
          <div class="logo-item"><img src="{{ asset('images/daihatsu-logo-png_seeklogo-201025.png') }}" alt="Daihatsu"></div>
          <div class="logo-item"><img src="{{ asset('images/byd-logo-png_seeklogo-546145.png') }}" alt="BYD"></div>
          <div class="logo-item"><img src="{{ asset('images/Nissan-Logo-PNG-Clipart.png') }}" alt="Nissan"></div>
          <!-- Duplikat untuk seamless loop -->
          <div class="logo-item"><img src="{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}" alt="Toyota"></div>
          <div class="logo-item"><img src="{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}" alt="Honda"></div>
          <div class="logo-item"><img src="{{ asset('images/BMW.svg.png') }}" alt="BMW"></div>
          <div class="logo-item"><img src="{{ asset('images/Mitsubishi-logo.png') }}" alt="Mitsubishi"></div>
          <div class="logo-item"><img src="{{ asset('images/1280px-suzuki-logo-2svg-618bfa5b29cfbdff54b843503f462364.png') }}" alt="Suzuki"></div>
          <div class="logo-item"><img src="{{ asset('images/daihatsu-logo-png_seeklogo-201025.png') }}" alt="Daihatsu"></div>
          <div class="logo-item"><img src="{{ asset('images/byd-logo-png_seeklogo-546145.png') }}" alt="BYD"></div>
          <div class="logo-item"><img src="{{ asset('images/Nissan-Logo-PNG-Clipart.png') }}" alt="Nissan"></div>
        </div>
      </div>

      <!-- Baris 2 - Bergerak ke kiri (lebih lambat) -->
      <div class="marquee-container py-3">
        <div class="marquee-content marquee-left" style="animation-duration: 50s;">
          <div class="logo-item"><img src="{{ asset('images/mercedes-benz-logo-png_seeklogo-190348.png') }}" alt="Mercedes"></div>
          <div class="logo-item"><img src="{{ asset('images/Kia-Motors-Logo-500x281.png') }}" alt="Kia"></div>
          <div class="logo-item"><img src="{{ asset('images/Sejarah-Mobil-Hyundai.png') }}" alt="Hyundai"></div>
          <div class="logo-item"><img src="{{ asset('images/Chevrolet-logo.png') }}" alt="Chevrolet"></div>
          <div class="logo-item"><img src="{{ asset('images/wuling-logo-png_seeklogo-383139.png') }}" alt="Wuling"></div>
          <div class="logo-item"><img src="{{ asset('images/logo-mg-morris.png') }}" alt="MG"></div>
          <div class="logo-item"><img src="{{ asset('images/Isuzu-logo.png') }}" alt="Isuzu"></div>
          <div class="logo-item"><img src="{{ asset('images/logo-dfsk-small.png') }}" alt="DFSK"></div>
          <!-- Duplikat -->
          <div class="logo-item"><img src="{{ asset('images/mercedes-benz-logo-png_seeklogo-190348.png') }}" alt="Mercedes"></div>
          <div class="logo-item"><img src="{{ asset('images/Kia-Motors-Logo-500x281.png') }}" alt="Kia"></div>
          <div class="logo-item"><img src="{{ asset('images/Sejarah-Mobil-Hyundai.png') }}" alt="Hyundai"></div>
          <div class="logo-item"><img src="{{ asset('images/Chevrolet-logo.png') }}" alt="Chevrolet"></div>
          <div class="logo-item"><img src="{{ asset('images/wuling-logo-png_seeklogo-383139.png') }}" alt="Wuling"></div>
          <div class="logo-item"><img src="{{ asset('images/logo-mg-morris.png') }}" alt="MG"></div>
          <div class="logo-item"><img src="{{ asset('images/Isuzu-logo.png') }}" alt="Isuzu"></div>
          <div class="logo-item"><img src="{{ asset('images/logo-dfsk-small.png') }}" alt="DFSK"></div>
        </div>
      </div>

      <!-- Baris 3 - Bergerak ke kanan (cepat) -->
      <div class="marquee-container py-3">
        <div class="marquee-content marquee-right" style="animation-duration: 35s;">
          <div class="logo-item"><img src="{{ asset('images/Datsun-logo-2013-2560x1440.png') }}" alt="Datsun"></div>
          <div class="logo-item"><img src="{{ asset('images/Chery-Logo-1997.png') }}" alt="Chery"></div>
          <div class="logo-item"><img src="{{ asset('images/580b57fcd9996e24bc43c47c.png') }}" alt="Ford"></div>
          <div class="logo-item"><img src="{{ asset('images/unnamed.png') }}" alt="Brand"></div>
          <div class="logo-item"><img src="{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}" alt="Toyota"></div>
          <div class="logo-item"><img src="{{ asset('images/BMW.svg.png') }}" alt="BMW"></div>
          <div class="logo-item"><img src="{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}" alt="Honda"></div>
          <div class="logo-item"><img src="{{ asset('images/Mitsubishi-logo.png') }}" alt="Mitsubishi"></div>
          <!-- Duplikat -->
          <div class="logo-item"><img src="{{ asset('images/Datsun-logo-2013-2560x1440.png') }}" alt="Datsun"></div>
          <div class="logo-item"><img src="{{ asset('images/Chery-Logo-1997.png') }}" alt="Chery"></div>
          <div class="logo-item"><img src="{{ asset('images/580b57fcd9996e24bc43c47c.png') }}" alt="Ford"></div>
          <div class="logo-item"><img src="{{ asset('images/unnamed.png') }}" alt="Brand"></div>
          <div class="logo-item"><img src="{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}" alt="Toyota"></div>
          <div class="logo-item"><img src="{{ asset('images/BMW.svg.png') }}" alt="BMW"></div>
          <div class="logo-item"><img src="{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}" alt="Honda"></div>
          <div class="logo-item"><img src="{{ asset('images/Mitsubishi-logo.png') }}" alt="Mitsubishi"></div>
        </div>
      </div>
    </div>

    <!-- Form Pencarian (di depan/menimpa logo) -->
    <div id="form-searching" class="relative z-10 max-w-5xl mx-auto px-4">
      <div class="bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-2xl border-2 border-red-300">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

          <div class="relative md:col-span-2 text-left">
            <label class="block text-xl font-bold text-gray-700 mb-4">
              <i class="fas fa-search mr-2 text-red-600"></i>Cari Showroom
            </label>
            <input
              type="text"
              id="searchInput"
              placeholder="Cari merek, nama, atau alamat..."
              class="w-full px-4 py-3 border-2 border-gray-200 bg-white text-gray-900 rounded-xl focus:ring-4 focus:ring-red-200 focus:border-red-500 transition-all duration-200 outline-none">
          </div>

          <div class="relative text-left">
            <label class="block text-xl font-bold text-gray-700 mb-4">
              <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>Lokasi
            </label>
            <select
              id="locationSelect"
              class="w-full px-4 py-3 border-2 border-gray-200 bg-white text-gray-900 rounded-xl focus:ring-4 focus:ring-red-200 focus:border-red-500 transition-all duration-200 outline-none appearance-none cursor-pointer">
              <option value="">Semua Lokasi</option>
            </select>
          </div>

          <div class="relative text-left">
            <label class="block text-xl font-bold text-gray-700 mb-4">
              <i class="fas fa-star mr-2 text-yellow-500"></i>Urutkan Rating
            </label>
            <select
              id="sortSelect"
              class="w-full px-4 py-3 border-2 border-gray-200 bg-white text-gray-900 rounded-xl focus:ring-4 focus:ring-red-200 focus:border-red-500 transition-all duration-200 outline-none appearance-none cursor-pointer">
              <option value="">Semua Rating</option>
              <option value="desc">Rating Tertinggi</option>
              <option value="asc">Rating Terendah</option>
            </select>
          </div>

          <div class="mt-4 md:mt-0 md:col-span-4">
            <button
              id="searchButton"
              class="w-full px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-extrabold rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
              <span>Cari Showroom</span>
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Section Daftar Showroom -->
  <section id="daftar-showroom" class="bg-gradient-to-br from-red-50 via-white to-red-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">Daftar Showroom</h2>
      <div id="results" class="space-y-6 max-w-4xl mx-auto">
        <div class="text-center py-8">
          <i class="fas fa-spinner fa-spin text-4xl text-red-600 mb-3"></i>
          <p class="text-gray-600 text-lg">Memuat data showroom...</p>
        </div>
      </div>

      <!-- Pagination Controls -->
      <div id="pagination" style="display: none;" class="mt-12 flex justify-center items-center gap-2 flex-wrap">
        <!-- Will be populated by JavaScript -->
      </div>
    </div>
  </section>

  <!-- Section Cara Kerja -->
  <section id="cara-kerja" class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">Cara Kerja</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Step 1 -->
        <div class="text-center p-6 bg-gradient-to-br from-red-50 to-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
          <div class="w-20 h-20 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-search text-white text-3xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">1. Cari Showroom</h3>
          <p class="text-gray-600 leading-relaxed">Gunakan fitur pencarian untuk menemukan showroom berdasarkan merek, lokasi, atau nama dealer yang Anda inginkan.</p>
        </div>

        <!-- Step 2 -->
        <div class="text-center p-6 bg-gradient-to-br from-red-50 to-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
          <div class="w-20 h-20 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-filter text-white text-3xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">2. Filter & Urutkan</h3>
          <p class="text-gray-600 leading-relaxed">Filter hasil berdasarkan lokasi dan urutkan berdasarkan rating tertinggi untuk menemukan showroom terbaik.</p>
        </div>

        <!-- Step 3 -->
        <div class="text-center p-6 bg-gradient-to-br from-red-50 to-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
          <div class="w-20 h-20 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-car text-white text-3xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">3. Lihat Detail</h3>
          <p class="text-gray-600 leading-relaxed">Klik showroom untuk melihat detail lengkap seperti alamat, jam operasional, dan nomor telepon untuk dihubungi.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer - Ucapan Terima Kasih -->
  <footer id="footer" class="bg-gradient-to-r from-red-600 to-red-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <i class="fas  text-4xl mb-4 animate-pulse"></i>
        <h2 class="text-3xl font-bold mb-4">Terima Kasih!</h2>
        <p class="text-lg mb-6 text-red-100">
          Terima kasih telah menggunakan layanan searching Showroom . Kami berkomitmen untuk membantu Anda menemukan showroom mobil terbaik di Sumatera Utara.
        </p>
        <div class="border-t border-red-400 pt-6 mt-6">
          <p class="text-red-200 text-sm">
            &copy; 2025 Showroom . All rights reserved.
          </p>
          <div class="flex justify-center gap-6 mt-4">
            <i class="fab fa-facebook text-2xl hover:text-red-200 cursor-pointer transition-colors"></i>
            <i class="fab fa-instagram text-2xl hover:text-red-200 cursor-pointer transition-colors"></i>
            <i class="fab fa-twitter text-2xl hover:text-red-200 cursor-pointer transition-colors"></i>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Smooth scroll untuk menu dengan offset untuk navbar sticky
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const target = document.querySelector(targetId);
        if (target) {
          // Hitung posisi dengan offset navbar (64px = h-16)
          const navbarHeight = 64;
          const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;

          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });

          // Close mobile menu if open
          document.getElementById('mobile-menu').classList.add('hidden');
        }
      });
    });

    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    document.addEventListener("DOMContentLoaded", function() {
      const searchInput = document.getElementById('searchInput');
      const locationSelect = document.getElementById('locationSelect');
      const sortSelect = document.getElementById('sortSelect');
      const resultsDiv = document.getElementById('results');
      const paginationDiv = document.getElementById('pagination');
      const searchButton = document.getElementById('searchButton');

      const LOC_URL = "{{ url('/showroom/locations') }}";
      const SEARCH_URL = "{{ url('/search') }}";

      let allData = [];
      let currentPage = 1;
      const itemsPerPage = 5;

      // Brand logo mapping - using local images
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

      function getBrandLogo(merek) {
        // Membersihkan string merek
        const cleanMerek = (merek || '').toLowerCase().replace('dealer ', '').trim();

        // Cek key spesifik
        if (brandLogos[cleanMerek]) {
          return brandLogos[cleanMerek];
        }

        // Cek jika nama merek ada di dalam string
        for (const key in brandLogos) {
          if (cleanMerek.includes(key)) {
            return brandLogos[key];
          }
        }

        // Fallback
        return brandLogos['default'];
      }

      function renderShowrooms(data, page = 1) {
        resultsDiv.innerHTML = '';

        if (!Array.isArray(data) || data.length === 0) {
          resultsDiv.innerHTML = `
            <div class="text-center py-12">
              <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
              <p class="text-gray-500 text-xl font-medium">Tidak ada showroom ditemukan</p>
              <p class="text-gray-400 mt-2">Coba kata kunci atau filter lain</p>
            </div>
          `;
          paginationDiv.style.display = 'none';
          return;
        }

        // Calculate pagination
        const totalPages = Math.ceil(data.length / itemsPerPage);
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedData = data.slice(startIndex, endIndex);

        // Render showrooms
        paginatedData.forEach(item => {
          const nama = item.nama?.value || 'Tidak ada nama';
          const rating = item.rating?.value || '-';
          const merek = item.merek?.value || '-';
          const lok = item.lokasi?.value || '-';

          const logo = getBrandLogo(merek);
          const ratingNum = parseFloat(rating) || 0;
          let stars = '-';
          if (ratingNum > 0) {
            const fullStars = '★'.repeat(Math.floor(ratingNum));
            const emptyStars = '☆'.repeat(5 - Math.floor(ratingNum));
            stars = fullStars + emptyStars;
          }

          resultsDiv.innerHTML += `
            <a href="/showroom/detail-page?nama=${encodeURIComponent(nama)}" class="block bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 group cursor-pointer">
              <div class="flex flex-col md:flex-row">
                <div class="relative w-full md:w-48 h-48 md:h-auto flex items-center justify-center flex-shrink-0 logo-bg">
                  <div class="absolute inset-0 bg-white/5"></div>
                  <img src="${logo}" alt="${merek}" class="relative z-10 w-32 h-32 object-contain drop-shadow-lg p-4" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2736/2736906.png'">
                </div>
                <div class="flex-1 p-6">
                  <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-600 transition-colors">${nama}</h3>
                  <div class="flex items-center gap-2 mb-3">
                    <i class="fas fa-map-marker-alt text-red-500"></i>
                    <span class="text-gray-700 font-medium">${lok}</span>
                  </div>
                  <div class="flex items-center gap-2 mb-3">
                    <span class="text-yellow-500 text-lg">${stars}</span>
                    <span class="text-gray-800 font-bold text-lg">${rating}</span>
                  </div>
                  <div class="inline-flex items-center gap-2 text-red-600 font-semibold group-hover:gap-3 transition-all">
                    <span>Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                  </div>
                </div>
              </div>
            </a>
          `;
        });

        // Render pagination
        renderPagination(totalPages, page, data.length);
      }

      function renderPagination(totalPages, currentPage, totalItems) {
        paginationDiv.innerHTML = '';

        if (totalPages <= 1) {
          paginationDiv.style.display = 'none';
          return;
        }

        paginationDiv.style.display = 'flex';

        // Showing text
        const startItem = ((currentPage - 1) * itemsPerPage) + 1;
        const endItem = Math.min(currentPage * itemsPerPage, totalItems);

        const showingText = document.createElement('div');
        showingText.className = 'text-gray-600 font-medium mr-6';
        showingText.textContent = `Showing ${startItem} to ${endItem} of ${totalItems} results`;
        paginationDiv.appendChild(showingText);

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.className = `px-4 py-2 rounded-lg font-semibold transition-all ${
          currentPage === 1 
            ? 'bg-gray-200 text-gray-400 cursor-not-allowed' 
            : 'bg-white text-red-600 border-2 border-red-200 hover:bg-red-600 hover:text-white hover:border-red-600'
        }`;
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => {
          if (currentPage > 1) {
            goToPage(currentPage - 1);
          }
        };
        paginationDiv.appendChild(prevBtn);

        // Page numbers
        const maxVisible = 7;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
        let endPage = Math.min(totalPages, startPage + maxVisible - 1);

        if (endPage - startPage < maxVisible - 1) {
          startPage = Math.max(1, endPage - maxVisible + 1);
        }

        // First page
        if (startPage > 1) {
          addPageButton(1);
          if (startPage > 2) {
            const dots = document.createElement('span');
            dots.className = 'px-3 py-2 text-gray-400';
            dots.textContent = '...';
            paginationDiv.appendChild(dots);
          }
        }

        // Page buttons
        for (let i = startPage; i <= endPage; i++) {
          addPageButton(i);
        }

        // Last page
        if (endPage < totalPages) {
          if (endPage < totalPages - 1) {
            const dots = document.createElement('span');
            dots.className = 'px-3 py-2 text-gray-400';
            dots.textContent = '...';
            paginationDiv.appendChild(dots);
          }
          addPageButton(totalPages);
        }

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.className = `px-4 py-2 rounded-lg font-semibold transition-all ${
          currentPage === totalPages 
            ? 'bg-gray-200 text-gray-400 cursor-not-allowed' 
            : 'bg-white text-red-600 border-2 border-red-200 hover:bg-red-600 hover:text-white hover:border-red-600'
        }`;
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => {
          if (currentPage < totalPages) {
            goToPage(currentPage + 1);
          }
        };
        paginationDiv.appendChild(nextBtn);
      }

      function addPageButton(pageNum) {
        const btn = document.createElement('button');
        btn.textContent = pageNum;
        btn.className = `min-w-[40px] px-4 py-2 rounded-lg font-semibold transition-all ${
          pageNum === currentPage 
            ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg' 
            : 'bg-white text-gray-700 border-2 border-gray-200 hover:bg-red-50 hover:border-red-300 hover:text-red-600'
        }`;
        btn.onclick = () => goToPage(pageNum);
        paginationDiv.appendChild(btn);
      }

      function goToPage(page) {
        currentPage = page;
        renderShowrooms(allData, currentPage);

        // Scroll to results
        document.getElementById('daftar-showroom').scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }

      // Isi dropdown lokasi
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
          const lokasi = locationSelect.value || '';
          const sort = sortSelect.value || '';

          resultsDiv.innerHTML = `
            <div class="text-center py-8">
              <i class="fas fa-spinner fa-spin text-4xl text-red-600 mb-3"></i>
              <p class="text-gray-600 text-lg">Mencari showroom...</p>
            </div>
          `;

          const url = `${SEARCH_URL}?q=${encodeURIComponent(keyword)}&lokasi=${encodeURIComponent(lokasi)}&sort=${encodeURIComponent(sort)}`;
          const res = await fetch(url);
          if (!res.ok) throw new Error(`HTTP ${res.status}`);
          const data = await res.json();

          // Store data and render with pagination
          allData = Array.isArray(data) ? data : [];
          currentPage = 1;
          renderShowrooms(allData, currentPage);
        } catch (err) {
          resultsDiv.innerHTML = `
            <div class="text-center py-12">
              <i class="fas fa-exclamation-triangle text-6xl text-red-400 mb-4"></i>
              <p class="text-red-600 text-xl font-semibold">Terjadi Kesalahan</p>
              <p class="text-gray-600 mt-2">${err.message}</p>
            </div>
          `;
        }
      }

      // Event listeners
      searchButton.addEventListener('click', searchShowroom);

      // Enter key untuk submit
      searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          searchShowroom();
        }
      });

      // Initial load
      searchShowroom();
    });
  </script>

</body>

</html>