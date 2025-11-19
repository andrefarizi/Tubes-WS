<!DOCTYPE html>
<html lang="id">
<head>
  <title>Cara Kerja - Showroom Mobil Indonesia</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-br from-red-50 via-white to-red-50">

  <!-- Navbar dengan Menu -->
  <nav class="bg-gradient-to-r from-red-600 to-red-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0 flex items-center">
          <i class="fas fa-car-side text-white text-3xl"></i>
          <span class="font-bold text-2xl text-white ml-3">Showroom</span>
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
          <a href="/#daftar-showroom" class="text-white hover:bg-red-800 px-4 py-2 rounded-lg transition-all duration-200 font-medium">
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

  

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
  </script>

</body>
</html>
