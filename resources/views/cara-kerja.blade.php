<!DOCTYPE html>
<html lang="id">

<head>
  <title>WheelTrack </title>
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

    /* Fade masuk */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Floating looping */
    @keyframes floating {
      0% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }

      100% {
        transform: translateY(0);
      }
    }

    /* Apply ke card */
    .float-card {
      animation: fadeIn 1s ease-out, floating 3.5s ease-in-out infinite;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-red-50 via-white to-red-50">

  <!-- Navbar dengan Menu -->
  <nav class="bg-gradient-to-r from-red-600 to-red-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0 flex items-center">
          <img src="/images/logo 1.png" alt="WheelTrack" class="h-12 w-auto object-contain">
        </div>

        <div class="hidden md:flex items-center space-x-1">
          <a href="/" class="text-white hover:bg-red-800 px-4 py-2 rounded-lg transition-all duration-200 font-medium">
            <i class="fas fa-home mr-2"></i>Home
          </a>
          <a href="/cara-kerja" class="text-white bg-red-800 px-4 py-2 rounded-lg transition-all duration-200 font-medium">
            <i class="fas fa-info-circle mr-2"></i>Cara Kerja
          </a>
          <a href="/#form-searching" class="text-white hover:bg-red-800 px-4 py-2 rounded-lg transition-all duration-200 font-medium">
            <i class="fas fa-search mr-2"></i>Searching
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
        <a href="/" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-home mr-2"></i>Home
        </a>
        <a href="/cara-kerja" class="text-white bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-info-circle mr-2"></i>Cara Kerja
        </a>
        <a href="/#form-searching" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-search mr-2"></i>Searching
        </a>
        <a href="/#daftar-showroom" class="text-white hover:bg-red-800 block px-3 py-2 rounded-lg font-medium">
          <i class="fas fa-list mr-2"></i>Daftar Showroom
        </a>
      </div>
    </div>
  </nav>

  <!-- Section Cara Kerja -->
  <section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

      <h2 class="text-4xl font-extrabold text-red-600 mb-16 text-center">
        Cara Kerja WheelTrack ?
      </h2>

      <div class="space-y-16">

        <!-- Step 1 — KIRI -->
        <div class="flex flex-col md:flex-row items-center">

          <div class="md:w-2/3 md:pr-10 float-card">
            <div class="p-6 rounded-3xl shadow-lg hover:shadow-2xl bg-gradient-to-br from-red-50 to-white transition-all duration-300">

              <!-- Ikon DI DALAM card -->
              <div class="bg-gradient-to-r from-red-500 to-red-600 text-white
                        inline-flex items-center px-5 py-3 rounded-full
                        mb-4 shadow-md gap-3">
                <i class="fas fa-search text-xl"></i>

              </div>

              <h3 class="text-xl font-bold text-gray-900 mb-2">Cari Showroom</h3>
              <p class="text-gray-600">Gunakan fitur pencarian untuk menemukan showroom berdasarkan merek, lokasi, atau nama dealer yang Anda inginkan</p>
            </div>
          </div>

          <div class="md:w-1/3"></div>
        </div>



        <!-- Step 2 — KANAN -->
        <div class="flex flex-col md:flex-row-reverse items-center">

          <div class="md:w-2/3 md:pl-10 float-card">
            <div class="p-6 rounded-3xl shadow-lg hover:shadow-2xl bg-gradient-to-br from-red-50 to-white transition-all duration-300">

              <div class="bg-gradient-to-r from-red-500 to-red-600 text-white
                        inline-flex items-center px-5 py-3 rounded-full
                        mb-4 shadow-md gap-3">
                <i class="fas fa-filter text-xl"></i>

              </div>

              <h3 class="text-xl font-bold text-gray-900 mb-2">Filter & Urutkan</h3>
              <p class="text-gray-600">ilter hasil berdasarkan lokasi dan urutkan berdasarkan rating tertinggi untuk menemukan showroom terbaik.</p>
            </div>
          </div>

          <div class="md:w-1/3"></div>
        </div>



        <!-- Step 3 — KIRI -->
        <div class="flex flex-col md:flex-row items-center">

          <div class="md:w-2/3 md:pr-10 float-card">
            <div class="p-6 rounded-3xl shadow-lg hover:shadow-2xl bg-gradient-to-br from-red-50 to-white transition-all duration-300">

              <div class="bg-gradient-to-r from-red-500 to-red-600 text-white
                        inline-flex items-center px-5 py-3 rounded-full
                        mb-4 shadow-md gap-3">
                <i class="fas fa-car text-xl"></i>

              </div>

              <h3 class="text-xl font-bold text-gray-900 mb-2">Lihat Detail</h3>
              <p class="text-gray-600">Klik showroom untuk melihat detail lengkap seperti alamat, jam operasional, dan nomor telepon untuk dihubungi.</p>
            </div>
          </div>

          <div class="md:w-1/3"></div>
        </div>

      </div>

    </div>
  </section>

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
  </script>

</body>

</html>