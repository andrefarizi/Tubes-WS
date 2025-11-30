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

    #map {
      height: 450px;
      width: 100%;
      border-radius: 1rem;
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

              <div class="md:col-span-2">
                <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                  <i class="fas fa-map-marked-alt text-red-600"></i>
                  Navigasi & Rute
                </h2>
                <a id="mapsLink" href="#" 
                  class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 
                  text-white font-bold rounded-xl shadow-lg hover:from-green-700 hover:to-green-800 
                    transition-all duration-200 w-full justify-center">
                  <i class="fas fa-route text-xl"></i>
                  <span>Lihat Peta & Dapatkan Arah</span>
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

    <!-- GOOGLE MAPS SECTION -->
    <div id="mapsSection" class="hidden mt-12">
      <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8">
        
        <!-- Header Maps -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
          <h2 class="text-3xl font-extrabold text-gray-900 flex items-center gap-3">
            <i class="fas fa-map-marked-alt text-red-600"></i>
            Lokasi & Rute
          </h2>
          <button id="openGoogleMaps" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all shadow-lg">
            <i class="fab fa-google"></i>
            <span>Buka di Google Maps</span>
          </button>
        </div>

        <!-- Map Container -->
        <div id="map" class="shadow-2xl mb-6"></div>

        <!-- Route Info Cards -->
        <div id="routeInfo" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6" style="display: none;">
          <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-5 rounded-xl border-2 border-blue-200 shadow-md">
            <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
              <i class="fas fa-route text-blue-600"></i>
              Jarak
            </p>
            <p id="distance" class="text-blue-700 font-extrabold text-2xl">-</p>
          </div>
          <div class="bg-gradient-to-br from-green-50 to-green-100 p-5 rounded-xl border-2 border-green-200 shadow-md">
            <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
              <i class="fas fa-clock text-green-600"></i>
              Estimasi Waktu
            </p>
            <p id="duration" class="text-green-700 font-extrabold text-2xl">-</p>
          </div>
          <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-5 rounded-xl border-2 border-orange-200 shadow-md">
            <p class="text-gray-600 text-sm font-semibold mb-1 flex items-center gap-2">
              <i class="fas fa-map-pin text-orange-600"></i>
              Titik Awal
            </p>
            <p id="via" class="text-orange-700 font-bold text-lg leading-tight">-</p>
          </div>
        </div>

        <!-- Route Buttons -->
        <div class="flex flex-col md:flex-row gap-4">
          <button id="routeFromUSU" class="flex-1 px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold rounded-xl hover:from-red-700 hover:to-red-800 transition-all shadow-lg flex items-center justify-center gap-2">
            <i class="fas fa-university text-xl"></i>
            <span>Rute dari Universitas Sumatera Utara</span>
          </button>
          <button id="routeFromCurrent" class="flex-1 px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-xl hover:from-green-700 hover:to-green-800 transition-all shadow-lg flex items-center justify-center gap-2">
            <i class="fas fa-location-crosshairs text-xl"></i>
            <span>Rute dari Lokasi Saya Sekarang</span>
          </button>
        </div>

      </div>
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

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}&callback=initMap&libraries=places" async defer></script>

  <script>
    let map;
    let directionsService;
    let directionsRenderer;
    let showroomLocation;
    let currentShowroomData = {};

    function initMap() {
      // Default center (Medan)
      const medanCenter = { lat: 3.5952, lng: 98.6722 };
      
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: medanCenter,
        mapTypeControl: true,
        streetViewControl: true,
        fullscreenControl: true,
        styles: [
          {
            featureType: "poi",
            elementType: "labels",
            stylers: [{ visibility: "off" }]
          }
        ]
      });

      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: false,
        polylineOptions: {
          strokeColor: '#DC2626',
          strokeWeight: 5
        }
      });
    }

    function setupGoogleMaps(data) {
      if (!map) {
        console.warn('Map belum siap');
        return;
      }

      const alamat = data.alamat?.value || '';
      const lokasi = data.lokasi?.value || '';
      const nama = data.nama?.value || '';
      
      // Geocode alamat untuk mendapat koordinat
      const geocoder = new google.maps.Geocoder();
      const fullAddress = `${alamat}, ${lokasi}, Sumatera Utara, Indonesia`;
      
      geocoder.geocode({ address: fullAddress }, (results, status) => {
        if (status === 'OK' && results[0]) {
          showroomLocation = results[0].geometry.location;
          
          // Create custom marker untuk showroom
          const marker = new google.maps.Marker({
            position: showroomLocation,
            map: map,
            title: nama,
            animation: google.maps.Animation.DROP,
            icon: {
              url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
              scaledSize: new google.maps.Size(50, 50)
            }
          });

          // Info window untuk marker
          const infoWindow = new google.maps.InfoWindow({
            content: `
              <div style="padding: 10px; max-width: 250px;">
                <h3 style="font-weight: bold; color: #DC2626; margin-bottom: 8px;">${nama}</h3>
                <p style="color: #374151; margin-bottom: 5px;"><i class="fas fa-map-marker-alt"></i> ${lokasi}</p>
                <p style="color: #6B7280; font-size: 14px;">${alamat}</p>
              </div>
            `
          });

          marker.addListener('click', () => {
            infoWindow.open(map, marker);
          });

          // Center map ke showroom dengan smooth animation
          map.setCenter(showroomLocation);
          map.setZoom(16);

          // Setup tombol buka Google Maps
          document.getElementById('openGoogleMaps').onclick = () => {
            const url = `https://www.google.com/maps/search/?api=1&query=${showroomLocation.lat()},${showroomLocation.lng()}`;
            window.open(url, '_blank');
          };

          // Show maps section
          document.getElementById('mapsSection').classList.remove('hidden');
          
        } else {
          console.warn('Geocoding gagal:', status);
          // Fallback: tetap tampilkan map centered di Medan
          document.getElementById('mapsSection').classList.remove('hidden');
        }
      });
    }

    function calculateRoute(origin, originName = '') {
      if (!showroomLocation) {
        alert('⚠️ Lokasi showroom belum tersedia. Mohon tunggu sebentar.');
        return;
      }

      // Show loading di route info
      document.getElementById('routeInfo').style.display = 'grid';
      document.getElementById('distance').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
      document.getElementById('duration').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
      document.getElementById('via').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

      const request = {
        origin: origin,
        destination: showroomLocation,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      };

      directionsService.route(request, (result, status) => {
        if (status === 'OK') {
          directionsRenderer.setDirections(result);
          
          const route = result.routes[0].legs[0];
          document.getElementById('distance').textContent = route.distance.text;
          document.getElementById('duration').textContent = route.duration.text;
          
          // Extract nama lokasi awal yang lebih readable
          const startAddr = originName || route.start_address.split(',')[0];
          document.getElementById('via').textContent = startAddr;
          
        } else {
          alert('❌ Gagal menghitung rute: ' + status + '\n\nCoba lagi dalam beberapa saat.');
          document.getElementById('routeInfo').style.display = 'none';
        }
      });
    }

    // Event listeners untuk tombol rute
    document.getElementById('routeFromUSU').addEventListener('click', () => {
      // Koordinat USU Medan yang akurat - Gerbang Utama
      // Lokasi: Gerbang Utama Universitas Sumatera Utara, Jl. Dr. T. Mansur, Padang Bulan
      // Verifikasi: https://www.google.com/maps?q=3.5672804,98.6538982
      const usuLocation = { lat: 3.5672804, lng: 98.6538982 };
      calculateRoute(usuLocation, 'Universitas Sumatera Utara (Gerbang Utama)');
    });

    document.getElementById('routeFromCurrent').addEventListener('click', () => {
      if (navigator.geolocation) {
        // Show loading indicator
        const btn = document.getElementById('routeFromCurrent');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin text-xl"></i><span>Mendapatkan lokasi...</span>';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
          (position) => {
            const currentLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            calculateRoute(currentLocation, 'Lokasi Anda');
            
            // Restore button
            btn.innerHTML = originalText;
            btn.disabled = false;
          },
          (error) => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            
            let errorMsg = 'Gagal mendapatkan lokasi Anda.';
            if (error.code === 1) {
              errorMsg = '⚠️ Akses lokasi ditolak.\n\nMohon izinkan akses lokasi di browser Anda.';
            } else if (error.code === 2) {
              errorMsg = '⚠️ Lokasi tidak tersedia.\n\nPastikan GPS/Location Services aktif.';
            } else if (error.code === 3) {
              errorMsg = '⚠️ Timeout mendapatkan lokasi.\n\nCoba lagi.';
            }
            
            alert(errorMsg);
            console.error('Geolocation error:', error);
          },
          {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
          }
        );
      } else {
        alert('❌ Browser Anda tidak mendukung Geolocation.\n\nGunakan browser modern seperti Chrome, Firefox, atau Edge.');
      }
    });

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
    // Store data globally untuk Google Maps
    currentShowroomData = data;
    
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
    
    // Set Maps link
    document.getElementById('mapsLink').href = `{{ url('/maps/showroom') }}?nama=${encodeURIComponent(nama)}`;
    
    // Setup Google Maps dengan data showroom
    setupGoogleMaps(data);
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