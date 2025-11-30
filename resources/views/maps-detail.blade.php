<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rute ke Showroom - WheelTrack</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
    }

    #map {
      height: 500px;
      width: 100%;
      border-radius: 1rem;
    }

    .status-badge {
      padding: 6px 14px;
      border-radius: 9999px;
      font-size: 0.875rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .pulse {
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
      0%, 100% {
        opacity: 1;
      }
      50% {
        opacity: .5;
      }
    }
  </style>
</head>

<body class="bg-gradient-to-br from-red-50 via-white to-red-50">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-red-600 to-red-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center gap-3">
          <img src="/images/logo 1.png" alt="WheelTrack" class="h-12 w-auto object-contain">
          <div class="text-white">
            <h1 class="font-bold text-lg">Navigasi Showroom</h1>
            <p class="text-xs text-red-100">Petunjuk arah ke tujuan</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <a href="{{ url('/maps') }}" class="flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all">
            <i class="fas fa-map"></i>
            <span class="font-semibold hidden sm:inline">Peta</span>
          </a>
          <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all">
            <i class="fas fa-home"></i>
            <span class="font-semibold hidden sm:inline">Beranda</span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Loading State -->
    <div id="loading" class="text-center py-20">
      <i class="fas fa-spinner fa-spin text-6xl text-red-600 mb-4"></i>
      <p class="text-gray-600 text-xl">Memuat informasi showroom...</p>
    </div>

    <!-- Error State -->
    <div id="error" style="display: none;" class="max-w-2xl mx-auto text-center py-12">
      <i class="fas fa-exclamation-triangle text-6xl text-red-400 mb-4"></i>
      <h2 class="text-2xl font-bold text-red-600 mb-4">Showroom Tidak Ditemukan</h2>
      <p class="text-gray-600 mb-6">Data showroom tidak dapat dimuat</p>
      <a href="{{ url('/maps') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all font-semibold">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Peta</span>
      </a>
    </div>

    <!-- Content -->
    <div id="content" style="display: none;">
      
      <!-- Showroom Info Card -->
      <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-6">
          <h1 id="showroomName" class="text-3xl font-extrabold text-white mb-2">-</h1>
          <div class="flex flex-wrap items-center gap-4 text-white">
            <span id="showroomMerek" class="flex items-center gap-2">
              <i class="fas fa-tag"></i>
              <span>-</span>
            </span>
            <span id="showroomLokasi" class="flex items-center gap-2">
              <i class="fas fa-map-marker-alt"></i>
              <span>-</span>
            </span>
            <span id="showroomRating" class="flex items-center gap-2">
              <i class="fas fa-star text-yellow-300"></i>
              <span>-</span>
            </span>
            <span id="showroomStatus" class="status-badge" style="background: white; color: #DC2626;">
              <i class="fas fa-clock"></i>
              <span>Memuat...</span>
            </span>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-8">
          
          <!-- Informasi Detail -->
          <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
              <i class="fas fa-info-circle text-red-600 mr-2"></i>
              Informasi Detail
            </h2>

            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
              <i class="fas fa-location-dot text-red-600 text-xl mt-1"></i>
              <div>
                <p class="text-sm text-gray-600 font-semibold mb-1">Alamat</p>
                <p id="showroomAlamat" class="text-gray-900 font-medium">-</p>
              </div>
            </div>

            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
              <i class="fas fa-clock text-red-600 text-xl mt-1"></i>
              <div class="flex-1">
                <p class="text-sm text-gray-600 font-semibold mb-1">Jam Operasional</p>
                <p id="showroomJam" class="text-gray-900 font-medium mb-2">-</p>
                <div id="openCloseTime" class="text-xs text-gray-500"></div>
              </div>
            </div>

            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl">
              <i class="fas fa-phone text-red-600 text-xl mt-1"></i>
              <div>
                <p class="text-sm text-gray-600 font-semibold mb-1">Kontak</p>
                <a id="showroomTelepon" href="tel:" class="text-red-600 hover:text-red-700 font-semibold">-</a>
              </div>
            </div>

            <a id="detailLink" href="#" class="block w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all text-center">
              <i class="fas fa-info-circle mr-2"></i>
              Lihat Detail Lengkap
            </a>
          </div>

          <!-- Quick Actions -->
          <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
              <i class="fas fa-directions text-red-600 mr-2"></i>
              Pilih Titik Awal
            </h2>

            <button id="routeFromCurrent" class="w-full px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-xl hover:from-green-700 hover:to-green-800 transition-all shadow-lg flex items-center justify-center gap-3">
              <i class="fas fa-location-crosshairs text-2xl"></i>
              <div class="text-left">
                <div>Lokasi Saya Sekarang</div>
                <div class="text-xs font-normal text-green-100">Gunakan GPS</div>
              </div>
            </button>

            <button id="routeFromUSU" class="w-full px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold rounded-xl hover:from-red-700 hover:to-red-800 transition-all shadow-lg flex items-center justify-center gap-3">
              <i class="fas fa-university text-2xl"></i>
              <div class="text-left">
                <div>Universitas Sumatera Utara</div>
                <div class="text-xs font-normal text-red-100">Kampus USU Medan</div>
              </div>
            </button>

            <div class="relative">
              <input type="text" id="customOrigin" placeholder="Atau ketik alamat awal..."
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all">
              <button id="routeFromCustom" class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all">
                <i class="fas fa-search"></i>
              </button>
            </div>

            <button id="openGoogleMaps" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all flex items-center justify-center gap-2">
              <i class="fab fa-google text-xl"></i>
              <span>Buka di Google Maps</span>
            </button>
          </div>

        </div>
      </div>

      <!-- Map & Route Info -->
      <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8">
        
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-extrabold text-gray-900">
            <i class="fas fa-map-marked-alt text-red-600 mr-2"></i>
            Peta & Rute
          </h2>
          <button id="resetRoute" style="display: none;" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-all">
            <i class="fas fa-redo mr-2"></i>
            Reset Rute
          </button>
        </div>

        <!-- Map Container -->
        <div id="map" class="shadow-2xl mb-6"></div>

        <!-- Route Info Cards -->
        <div id="routeInfo" style="display: none;">
          <h3 class="text-lg font-bold text-gray-900 mb-4">
            <i class="fas fa-route text-red-600 mr-2"></i>
            Informasi Rute
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-5 rounded-xl border-2 border-blue-200 shadow-md">
              <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
                <i class="fas fa-route text-blue-600"></i>
                Jarak Tempuh
              </p>
              <p id="distance" class="text-blue-700 font-extrabold text-3xl">-</p>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 p-5 rounded-xl border-2 border-green-200 shadow-md">
              <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
                <i class="fas fa-clock text-green-600"></i>
                Estimasi Waktu
              </p>
              <p id="duration" class="text-green-700 font-extrabold text-3xl">-</p>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-5 rounded-xl border-2 border-orange-200 shadow-md">
              <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
                <i class="fas fa-map-pin text-orange-600"></i>
                Dari
              </p>
              <p id="startPoint" class="text-orange-700 font-bold text-lg leading-tight">-</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-5 rounded-xl border-2 border-purple-200 shadow-md">
              <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
                <i class="fas fa-flag-checkered text-purple-600"></i>
                Ke
              </p>
              <p id="endPoint" class="text-purple-700 font-bold text-lg leading-tight">-</p>
            </div>

          </div>

          <!-- Step by Step Directions -->
          <div id="directionsPanel" class="mt-6 bg-gray-50 rounded-xl p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">
              <i class="fas fa-list-ol text-red-600 mr-2"></i>
              Petunjuk Arah
            </h3>
            <div id="directionsList" class="space-y-3">
              <!-- Directions akan di-generate di sini -->
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}&callback=initMap&libraries=places,geometry" async defer></script>

  <script>
    const showroomName = "{{ $showroomName ?? '' }}";
    
    let map;
    let directionsService;
    let directionsRenderer;
    let showroomLocation;
    let showroomData = {};

    // Database koordinat showroom yang sudah diverifikasi dari Google Maps
    // Format: Nama showroom → { lat, lng }
    function getKnownShowroomCoordinates(namaShowroom) {
      const coordinates = {
        'TOYOTA DELTAMAS BALAI KOTA': { lat: 3.5909601, lng: 98.6484569 },
        'ASTRA DAIHATSU MEDAN': { lat: 3.590960, lng: 98.648457 },
        // Tambahkan koordinat showroom lain di sini setelah verifikasi
        // Format: 'NAMA SHOWROOM': { lat: xxx, lng: yyy },
      };
      
      return coordinates[namaShowroom] || null;
    }

    function createShowroomMarker(nama, location) {
      new google.maps.Marker({
        position: location,
        map: map,
        title: nama,
        animation: google.maps.Animation.DROP,
        icon: {
          url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
          scaledSize: new google.maps.Size(50, 50)
        }
      });

      map.setCenter(location);
      map.setZoom(16);

      document.getElementById('openGoogleMaps').onclick = () => {
        const url = `https://www.google.com/maps/search/?api=1&query=${location.lat()},${location.lng()}`;
        window.open(url, '_blank');
      };

      document.getElementById('endPoint').textContent = nama;
    }

    function initMap() {
      const medanCenter = { lat: 3.5952, lng: 98.6722 };
      
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: medanCenter,
        mapTypeControl: true,
        streetViewControl: true,
        fullscreenControl: true,
        zoomControl: true
      });

      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: false,
        polylineOptions: {
          strokeColor: '#DC2626',
          strokeWeight: 6
        }
      });

      loadShowroomDetail();
    }

    async function loadShowroomDetail() {
      try {
        if (!showroomName) {
          throw new Error('Nama showroom tidak ditemukan');
        }

        const response = await fetch(`{{ url('/showroom/detail') }}?nama=${encodeURIComponent(showroomName)}`);
        
        if (!response.ok) {
          throw new Error('Gagal memuat data');
        }

        const data = await response.json();
        showroomData = data;

        displayShowroomDetail(data);

      } catch (error) {
        console.error('Error:', error);
        document.getElementById('loading').style.display = 'none';
        document.getElementById('error').style.display = 'block';
      }
    }

    function displayShowroomDetail(data) {
      const nama = data.nama?.value || '-';
      const merek = data.merek?.value || '-';
      const lokasi = data.lokasi?.value || '-';
      const alamat = data.alamat?.value || '-';
      const rating = data.rating?.value || '-';
      const jamOperasional = data.jamOperasional?.value || '-';
      const telepon = data.noTelepon?.value || data.telepon?.value || '-';

      document.getElementById('showroomName').textContent = nama;
      document.getElementById('showroomMerek').querySelector('span').textContent = merek;
      document.getElementById('showroomLokasi').querySelector('span').textContent = lokasi;
      document.getElementById('showroomRating').querySelector('span').textContent = rating + ' / 5.0';
      document.getElementById('showroomAlamat').textContent = alamat;
      document.getElementById('showroomJam').textContent = jamOperasional;
      
      const telEl = document.getElementById('showroomTelepon');
      if (telepon && telepon !== '-') {
        telEl.href = `tel:${telepon}`;
        telEl.textContent = telepon;
      } else {
        telEl.textContent = 'Tidak tersedia';
      }

      document.getElementById('detailLink').href = `{{ url('/showroom/detail-page') }}?nama=${encodeURIComponent(nama)}`;

      // Status & Time Info
      const status = getShowroomStatus(jamOperasional);
      const statusEl = document.getElementById('showroomStatus');
      statusEl.innerHTML = `<i class="fas fa-${status.icon}"></i><span>${status.text}</span>`;
      statusEl.style.background = status.bg;
      statusEl.style.color = status.color;

      document.getElementById('openCloseTime').innerHTML = status.timeInfo;

      // Geocode untuk mendapat koordinat AKURAT dari alamat showroom
      const geocoder = new google.maps.Geocoder();
      // Format alamat lebih spesifik untuk hasil geocoding yang akurat
      const fullAddress = `${alamat}, Kota ${lokasi}, Sumatera Utara, Indonesia`;
      
      // Manual koordinat untuk showroom yang sudah terverifikasi
      const knownLocations = getKnownShowroomCoordinates(nama);
      
      if (knownLocations) {
        // Gunakan koordinat manual yang sudah diverifikasi
        showroomLocation = new google.maps.LatLng(knownLocations.lat, knownLocations.lng);
        createShowroomMarker(nama, showroomLocation);
        document.getElementById('loading').style.display = 'none';
        document.getElementById('content').style.display = 'block';
      } else {
        // Geocode dari alamat jika koordinat belum ada di database
        geocoder.geocode({ 
          address: fullAddress,
          componentRestrictions: {
            country: 'ID',
            administrativeArea: 'Sumatera Utara',
            locality: lokasi
          }
        }, (results, status) => {
          if (status === 'OK' && results[0]) {
            showroomLocation = results[0].geometry.location;
            
            // Log koordinat untuk verifikasi (bisa dicatat untuk dimasukkan ke database)
            console.log(`📍 Koordinat ${nama}:`, {
              lat: showroomLocation.lat(),
              lng: showroomLocation.lng(),
              address: fullAddress,
              googleMapsLink: `https://www.google.com/maps?q=${showroomLocation.lat()},${showroomLocation.lng()}`
            });
            
            createShowroomMarker(nama, showroomLocation);
          } else {
            console.warn('❌ Geocoding gagal:', status, 'untuk alamat:', fullAddress);
            // Fallback: gunakan center Medan jika geocoding gagal
            showroomLocation = new google.maps.LatLng(3.5952, 98.6722);
            createShowroomMarker(nama + ' (Lokasi Perkiraan - Geocoding Gagal)', showroomLocation);
          }
          
          document.getElementById('loading').style.display = 'none';
          document.getElementById('content').style.display = 'block';
        });
      }
    }

    function getShowroomStatus(jamOperasional) {
      if (!jamOperasional || jamOperasional === 'Tidak tersedia' || jamOperasional === '-') {
        return {
          status: 'unknown',
          text: 'Jam tidak diketahui',
          icon: 'question-circle',
          bg: '#F3F4F6',
          color: '#6B7280',
          timeInfo: '<span class="text-gray-500">Informasi jam operasional tidak tersedia</span>'
        };
      }

      const now = new Date();
      const currentHour = now.getHours();
      const currentMinute = now.getMinutes();
      const currentTime = currentHour * 60 + currentMinute;

      const match = jamOperasional.match(/(\d{2})[\.:](\d{2})\s*-\s*(\d{2})[\.:](\d{2})/);
      
      if (match) {
        const openHour = parseInt(match[1]);
        const openMinute = parseInt(match[2]);
        const closeHour = parseInt(match[3]);
        const closeMinute = parseInt(match[4]);

        const openTime = openHour * 60 + openMinute;
        const closeTime = closeHour * 60 + closeMinute;

        let timeInfo = '';
        let status = {};

        if (currentTime < openTime) {
          const minutesUntilOpen = openTime - currentTime;
          const hoursUntilOpen = Math.floor(minutesUntilOpen / 60);
          const minsUntilOpen = minutesUntilOpen % 60;
          
          timeInfo = `<span class="text-red-600 font-semibold">Buka dalam ${hoursUntilOpen > 0 ? hoursUntilOpen + ' jam ' : ''}${minsUntilOpen} menit</span>`;
          status = {
            status: 'closed',
            text: 'Tutup',
            icon: 'lock',
            bg: '#FDE8E8',
            color: '#991B1B',
            timeInfo: timeInfo
          };
        } else if (currentTime >= openTime && currentTime < closeTime) {
          const minutesUntilClose = closeTime - currentTime;
          const hoursUntilClose = Math.floor(minutesUntilClose / 60);
          const minsUntilClose = minutesUntilClose % 60;
          
          if (minutesUntilClose <= 60) {
            timeInfo = `<span class="text-yellow-600 font-semibold pulse">⚠️ Tutup dalam ${minsUntilClose} menit!</span>`;
            status = {
              status: 'closing-soon',
              text: 'Segera Tutup',
              icon: 'clock',
              bg: '#FEF3C7',
              color: '#92400E',
              timeInfo: timeInfo
            };
          } else {
            timeInfo = `<span class="text-green-600 font-semibold">Tutup dalam ${hoursUntilClose > 0 ? hoursUntilClose + ' jam ' : ''}${minsUntilClose} menit</span>`;
            status = {
              status: 'open',
              text: 'Buka Sekarang',
              icon: 'check-circle',
              bg: '#DEF7EC',
              color: '#03543F',
              timeInfo: timeInfo
            };
          }
        } else {
          const minutesUntilOpen = (1440 - currentTime) + openTime; // Next day
          const hoursUntilOpen = Math.floor(minutesUntilOpen / 60);
          
          timeInfo = `<span class="text-red-600 font-semibold">Buka besok jam ${String(openHour).padStart(2, '0')}:${String(openMinute).padStart(2, '0')}</span>`;
          status = {
            status: 'closed',
            text: 'Tutup',
            icon: 'lock',
            bg: '#FDE8E8',
            color: '#991B1B',
            timeInfo: timeInfo
          };
        }

        return status;
      }

      return {
        status: 'unknown',
        text: 'Jam tidak diketahui',
        icon: 'question-circle',
        bg: '#F3F4F6',
        color: '#6B7280',
        timeInfo: '<span class="text-gray-500">Format jam tidak valid</span>'
      };
    }

    function calculateRoute(origin, originName = '') {
      if (!showroomLocation) {
        alert('⚠️ Lokasi showroom belum tersedia.');
        return;
      }

      // Show loading
      document.getElementById('routeInfo').style.display = 'block';
      document.getElementById('distance').innerHTML = '<i class="fas fa-spinner fa-spin text-2xl"></i>';
      document.getElementById('duration').innerHTML = '<i class="fas fa-spinner fa-spin text-2xl"></i>';
      document.getElementById('startPoint').textContent = 'Memuat...';
      document.getElementById('directionsList').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-2xl text-red-600"></i></div>';

      const request = {
        origin: origin,
        destination: showroomLocation,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
      };

      directionsService.route(request, (result, status) => {
        if (status === 'OK') {
          directionsRenderer.setDirections(result);
          
          const route = result.routes[0].legs[0];
          document.getElementById('distance').textContent = route.distance.text;
          document.getElementById('duration').textContent = route.duration.text;
          document.getElementById('startPoint').textContent = originName || route.start_address.split(',')[0];

          // Display step-by-step directions
          displayDirections(route.steps);

          document.getElementById('resetRoute').style.display = 'block';
        } else {
          alert('❌ Gagal menghitung rute: ' + status);
          document.getElementById('routeInfo').style.display = 'none';
        }
      });
    }

    function displayDirections(steps) {
      const listDiv = document.getElementById('directionsList');
      listDiv.innerHTML = '';

      steps.forEach((step, index) => {
        const instruction = step.instructions.replace(/<[^>]*>/g, ''); // Remove HTML tags
        const distance = step.distance.text;

        const stepDiv = document.createElement('div');
        stepDiv.className = 'flex gap-3 p-3 bg-white rounded-lg border border-gray-200';
        stepDiv.innerHTML = `
          <div class="flex-shrink-0 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
            ${index + 1}
          </div>
          <div class="flex-1">
            <p class="text-gray-900 font-medium">${instruction}</p>
            <p class="text-gray-500 text-sm mt-1"><i class="fas fa-route mr-1"></i>${distance}</p>
          </div>
        `;
        listDiv.appendChild(stepDiv);
      });
    }

    // Event Listeners
    document.getElementById('routeFromCurrent').addEventListener('click', () => {
      if (navigator.geolocation) {
        const btn = document.getElementById('routeFromCurrent');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin text-2xl"></i><div class="text-left"><div>Mendapatkan lokasi...</div></div>';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
          (position) => {
            const currentLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            calculateRoute(currentLocation, 'Lokasi Anda Sekarang');
            btn.innerHTML = originalHTML;
            btn.disabled = false;
          },
          (error) => {
            btn.innerHTML = originalHTML;
            btn.disabled = false;
            alert('⚠️ Gagal mendapatkan lokasi Anda.\n\nPastikan GPS aktif dan izin lokasi diaktifkan.');
          },
          { enableHighAccuracy: true, timeout: 10000 }
        );
      } else {
        alert('❌ Browser tidak mendukung Geolocation.');
      }
    });

    document.getElementById('routeFromUSU').addEventListener('click', () => {
      // Koordinat USU Medan yang akurat - Gerbang Utama USU
      // Lokasi: Gerbang Utama Universitas Sumatera Utara, Jl. Dr. T. Mansur, Padang Bulan
      // Verifikasi: https://www.google.com/maps?q=3.5672804,98.6538982
      const usuLocation = { lat: 3.5672804, lng: 98.6538982 };
      calculateRoute(usuLocation, 'Universitas Sumatera Utara (Gerbang Utama)');
    });

    document.getElementById('routeFromCustom').addEventListener('click', () => {
      const address = document.getElementById('customOrigin').value.trim();
      if (!address) {
        alert('Mohon masukkan alamat terlebih dahulu.');
        return;
      }

      const geocoder = new google.maps.Geocoder();
      geocoder.geocode({ address: address }, (results, status) => {
        if (status === 'OK' && results[0]) {
          const location = results[0].geometry.location;
          calculateRoute(location, address);
        } else {
          alert('❌ Alamat tidak ditemukan. Coba alamat yang lebih spesifik.');
        }
      });
    });

    document.getElementById('customOrigin').addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        document.getElementById('routeFromCustom').click();
      }
    });

    document.getElementById('resetRoute').addEventListener('click', () => {
      directionsRenderer.setDirections({ routes: [] });
      document.getElementById('routeInfo').style.display = 'none';
      document.getElementById('resetRoute').style.display = 'none';
      map.setCenter(showroomLocation);
      map.setZoom(16);
    });
  </script>

</body>
</html>
