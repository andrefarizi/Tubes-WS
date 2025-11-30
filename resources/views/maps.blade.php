<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta Showroom - WheelTrack</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
    }

    #map {
      height: calc(100vh - 180px);
      width: 100%;
      border-radius: 1rem;
    }

    .status-badge {
      padding: 4px 12px;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .status-open {
      background: #DEF7EC;
      color: #03543F;
    }

    .status-closing-soon {
      background: #FEF3C7;
      color: #92400E;
    }

    .status-closed {
      background: #FDE8E8;
      color: #991B1B;
    }

    .showroom-card {
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .showroom-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(220, 38, 38, 0.2);
    }

    .filter-chip {
      transition: all 0.2s ease;
    }

    .filter-chip.active {
      background: linear-gradient(to right, #DC2626, #991B1B);
      color: white;
    }

    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #DC2626;
      border-radius: 10px;
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
            <h1 class="font-bold text-lg">Peta Showroom</h1>
            <p class="text-xs text-red-100">Temukan showroom terdekat</p>
          </div>
        </div>
        <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all">
          <i class="fas fa-arrow-left"></i>
          <span class="font-semibold">Kembali</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 py-6">
    
    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <!-- Search -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-search text-red-600 mr-1"></i>
            Cari Showroom
          </label>
          <input type="text" id="searchInput" placeholder="Ketik nama showroom atau merek..." 
            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all">
        </div>

        <!-- Location Filter -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-map-marker-alt text-red-600 mr-1"></i>
            Lokasi
          </label>
          <select id="locationFilter" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all">
            <option value="">Semua Lokasi</option>
          </select>
        </div>

        <!-- Status Filter -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            <i class="fas fa-clock text-red-600 mr-1"></i>
            Status
          </label>
          <select id="statusFilter" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all">
            <option value="">Semua Status</option>
            <option value="open">Buka Sekarang</option>
            <option value="closing-soon">Segera Tutup</option>
            <option value="closed">Tutup</option>
          </select>
        </div>

      </div>

      <!-- Sort & View Options -->
      <div class="flex flex-wrap items-center justify-between mt-4 pt-4 border-t border-gray-200">
        <div class="flex items-center gap-2">
          <span class="text-sm font-semibold text-gray-700">Urutkan:</span>
          <button id="sortNearest" class="filter-chip px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium hover:bg-gray-200">
            <i class="fas fa-location-arrow mr-1"></i>
            Terdekat
          </button>
          <button id="sortName" class="filter-chip px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium hover:bg-gray-200">
            <i class="fas fa-sort-alpha-down mr-1"></i>
            Nama
          </button>
          <button id="sortRating" class="filter-chip px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium hover:bg-gray-200">
            <i class="fas fa-star mr-1"></i>
            Rating
          </button>
        </div>
        
        <button id="findNearestBtn" class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-semibold hover:from-green-700 hover:to-green-800 transition-all shadow-lg">
          <i class="fas fa-location-crosshairs mr-2"></i>
          Cari Terdekat dari Saya
        </button>
      </div>
    </div>

    <!-- Map & List Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      
      <!-- Map -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg p-4">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900">
              <i class="fas fa-map text-red-600 mr-2"></i>
              Peta Interaktif
            </h2>
            <span id="mapCounter" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg font-semibold text-sm">
              0 Showroom
            </span>
          </div>
          <div id="map" class="shadow-inner"></div>
        </div>
      </div>

      <!-- Showroom List -->
      <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-lg p-4">
          <h2 class="text-xl font-bold text-gray-900 mb-4">
            <i class="fas fa-list text-red-600 mr-2"></i>
            Daftar Showroom
          </h2>
          
          <!-- Loading State -->
          <div id="listLoading" class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-4xl text-red-600 mb-3"></i>
            <p class="text-gray-600">Memuat showroom...</p>
          </div>

          <!-- Empty State -->
          <div id="listEmpty" style="display: none;" class="text-center py-8">
            <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Tidak ada showroom ditemukan</p>
          </div>

          <!-- List Container -->
          <div id="showroomList" style="display: none;" class="space-y-3 max-h-[calc(100vh-300px)] overflow-y-auto custom-scrollbar pr-2">
            <!-- Showroom cards akan di-generate di sini -->
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}&callback=initMap&libraries=places,geometry" async defer></script>

  <script>
    let map;
    let markers = [];
    let allShowrooms = [];
    let filteredShowrooms = [];
    let userLocation = null;
    let infoWindows = [];

    const SEARCH_URL = "{{ url('/search') }}";
    const LOC_URL = "{{ url('/showroom/locations') }}";

    // Brand logos
    const brandLogos = {
      'toyota': "{{ asset('images/toyota-logo-png_seeklogo-171947.png') }}",
      'honda': "{{ asset('images/3D-Logo-Honda-Chrome-Vertikal.png') }}",
      'bmw': "{{ asset('images/BMW.svg.png') }}",
      'daihatsu': "{{ asset('images/daihatsu-logo-png_seeklogo-201025.png') }}",
      'mitsubishi': "{{ asset('images/Mitsubishi-logo.png') }}",
      'suzuki': "{{ asset('images/1280px-suzuki-logo-2svg-618bfa5b29cfbdff54b843503f462364.png') }}",
      'byd': "{{ asset('images/byd-logo-png_seeklogo-546145.png') }}",
      'nissan': "{{ asset('images/Nissan-Logo-PNG-Clipart.png') }}",
      'wuling': "{{ asset('images/wuling-logo-png_seeklogo-383139.png') }}",
      'default': "{{ asset('images/unnamed.png') }}"
    };

    function getBrandLogo(merek) {
      const cleanMerek = (merek || '').toLowerCase().replace('dealer ', '').trim();
      for (const key in brandLogos) {
        if (cleanMerek.includes(key)) return brandLogos[key];
      }
      return brandLogos['default'];
    }

    function initMap() {
      // Default center (Medan)
      const medanCenter = { lat: 3.5952, lng: 98.6722 };
      
      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: medanCenter,
        mapTypeControl: true,
        streetViewControl: true,
        fullscreenControl: true,
        zoomControl: true,
        styles: [
          {
            featureType: "poi",
            elementType: "labels",
            stylers: [{ visibility: "off" }]
          }
        ]
      });

      // Load showrooms
      loadShowrooms();
      
      // Get user location
      getUserLocation();
    }

    function getUserLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            userLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            // Add user marker
            new google.maps.Marker({
              position: userLocation,
              map: map,
              title: 'Lokasi Anda',
              icon: {
                url: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                scaledSize: new google.maps.Size(40, 40)
              }
            });

            console.log('User location:', userLocation);
          },
          (error) => {
            console.warn('Geolocation error:', error);
          }
        );
      }
    }

    async function loadShowrooms() {
      try {
        const response = await fetch(SEARCH_URL);
        const data = await response.json();
        
        allShowrooms = Array.isArray(data) ? data : [];
        
        // Load locations untuk filter
        loadLocations();
        
        // Process dan tampilkan showrooms
        processShowrooms(allShowrooms);
        
      } catch (error) {
        console.error('Error loading showrooms:', error);
        document.getElementById('listLoading').style.display = 'none';
        document.getElementById('listEmpty').style.display = 'block';
      }
    }

    async function loadLocations() {
      try {
        const response = await fetch(LOC_URL);
        const locations = await response.json();
        
        const select = document.getElementById('locationFilter');
        locations.forEach(loc => {
          const option = document.createElement('option');
          option.value = loc;
          option.textContent = loc;
          select.appendChild(option);
        });
      } catch (error) {
        console.error('Error loading locations:', error);
      }
    }

    async function processShowrooms(showrooms) {
      // Clear existing markers
      markers.forEach(marker => marker.setMap(null));
      markers = [];
      infoWindows.forEach(iw => iw.close());
      infoWindows = [];

      const geocoder = new google.maps.Geocoder();
      const promises = [];

      for (let showroom of showrooms) {
        const nama = showroom.nama?.value || '';
        const alamat = showroom.alamat?.value || '';
        const lokasi = showroom.lokasi?.value || '';
        const merek = showroom.merek?.value || '';
        const rating = showroom.rating?.value || '-';
        const jamOperasional = showroom.jamOperasional?.value || '';
        
        const fullAddress = `${alamat}, ${lokasi}, Sumatera Utara, Indonesia`;

        const promise = new Promise((resolve) => {
          geocoder.geocode({ address: fullAddress }, (results, status) => {
            if (status === 'OK' && results[0]) {
              const location = results[0].geometry.location;
              
              showroom.coordinates = {
                lat: location.lat(),
                lng: location.lng()
              };

              // Calculate distance if user location available
              if (userLocation) {
                const distance = google.maps.geometry.spherical.computeDistanceBetween(
                  new google.maps.LatLng(userLocation.lat, userLocation.lng),
                  location
                );
                showroom.distance = distance / 1000; // Convert to km
              }

              // Determine open/close status
              showroom.status = getShowroomStatus(jamOperasional);

              // Create marker
              createMarker(showroom);
            }
            resolve();
          });
        });

        promises.push(promise);
      }

      await Promise.all(promises);

      filteredShowrooms = showrooms.filter(s => s.coordinates);
      
      // Update UI
      updateShowroomList(filteredShowrooms);
      document.getElementById('mapCounter').textContent = `${filteredShowrooms.length} Showroom`;
    }

    function getShowroomStatus(jamOperasional) {
      if (!jamOperasional || jamOperasional === 'Tidak tersedia') {
        return { status: 'unknown', text: 'Tidak diketahui', class: 'status-closed' };
      }

      const now = new Date();
      const currentHour = now.getHours();
      const currentMinute = now.getMinutes();
      const currentTime = currentHour * 60 + currentMinute;

      // Parse jam operasional (format: "08.00-18.00" atau "08:00-18:00")
      const match = jamOperasional.match(/(\d{2})[\.:](\d{2})\s*-\s*(\d{2})[\.:](\d{2})/);
      
      if (match) {
        const openHour = parseInt(match[1]);
        const openMinute = parseInt(match[2]);
        const closeHour = parseInt(match[3]);
        const closeMinute = parseInt(match[4]);

        const openTime = openHour * 60 + openMinute;
        const closeTime = closeHour * 60 + closeMinute;

        if (currentTime >= openTime && currentTime < closeTime) {
          // Check if closing soon (within 1 hour)
          if (closeTime - currentTime <= 60) {
            return { status: 'closing-soon', text: 'Segera Tutup', class: 'status-closing-soon' };
          }
          return { status: 'open', text: 'Buka', class: 'status-open' };
        } else {
          return { status: 'closed', text: 'Tutup', class: 'status-closed' };
        }
      }

      return { status: 'unknown', text: 'Tidak diketahui', class: 'status-closed' };
    }

    function createMarker(showroom) {
      const nama = showroom.nama?.value || '';
      const merek = showroom.merek?.value || '';
      const rating = showroom.rating?.value || '-';
      const status = showroom.status || {};

      // Marker color based on status
      let markerIcon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
      if (status.status === 'open') {
        markerIcon = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
      } else if (status.status === 'closing-soon') {
        markerIcon = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
      }

      const marker = new google.maps.Marker({
        position: showroom.coordinates,
        map: map,
        title: nama,
        icon: {
          url: markerIcon,
          scaledSize: new google.maps.Size(40, 40)
        }
      });

      const infoWindow = new google.maps.InfoWindow({
        content: `
          <div style="padding: 12px; max-width: 280px; font-family: 'Poppins', sans-serif;">
            <h3 style="font-weight: 700; color: #DC2626; margin-bottom: 8px; font-size: 16px;">${nama}</h3>
            <p style="color: #6B7280; margin-bottom: 6px; font-size: 13px;">
              <i class="fas fa-tag" style="color: #DC2626; margin-right: 6px;"></i>${merek}
            </p>
            <p style="color: #6B7280; margin-bottom: 6px; font-size: 13px;">
              <i class="fas fa-star" style="color: #FBBF24; margin-right: 6px;"></i>${rating} / 5.0
            </p>
            <div style="margin: 8px 0;">
              <span style="padding: 4px 10px; background: ${status.status === 'open' ? '#DEF7EC' : status.status === 'closing-soon' ? '#FEF3C7' : '#FDE8E8'}; color: ${status.status === 'open' ? '#03543F' : status.status === 'closing-soon' ? '#92400E' : '#991B1B'}; border-radius: 12px; font-size: 11px; font-weight: 600;">
                ${status.text}
              </span>
            </div>
            ${showroom.distance ? `<p style="color: #059669; font-weight: 600; margin-top: 8px; font-size: 13px;">
              <i class="fas fa-location-arrow" style="margin-right: 6px;"></i>${showroom.distance.toFixed(2)} km dari Anda
            </p>` : ''}
            <a href="{{ url('/maps/showroom') }}?nama=${encodeURIComponent(nama)}" 
               style="display: inline-block; margin-top: 10px; padding: 8px 16px; background: linear-gradient(to right, #DC2626, #991B1B); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 13px;">
              <i class="fas fa-route" style="margin-right: 6px;"></i>Lihat Rute
            </a>
          </div>
        `
      });

      marker.addListener('click', () => {
        // Close all other info windows
        infoWindows.forEach(iw => iw.close());
        infoWindow.open(map, marker);
      });

      markers.push(marker);
      infoWindows.push(infoWindow);
    }

    function updateShowroomList(showrooms) {
      const listDiv = document.getElementById('showroomList');
      listDiv.innerHTML = '';

      if (showrooms.length === 0) {
        document.getElementById('listLoading').style.display = 'none';
        document.getElementById('listEmpty').style.display = 'block';
        document.getElementById('showroomList').style.display = 'none';
        return;
      }

      document.getElementById('listLoading').style.display = 'none';
      document.getElementById('listEmpty').style.display = 'none';
      document.getElementById('showroomList').style.display = 'block';

      showrooms.forEach((showroom, index) => {
        const nama = showroom.nama?.value || '';
        const merek = showroom.merek?.value || '';
        const lokasi = showroom.lokasi?.value || '';
        const rating = showroom.rating?.value || '-';
        const status = showroom.status || {};
        
        const card = document.createElement('div');
        card.className = 'showroom-card bg-white border-2 border-gray-200 rounded-xl p-4 hover:border-red-400';
        card.onclick = () => {
          map.setCenter(showroom.coordinates);
          map.setZoom(16);
          // Open info window
          infoWindows[index].open(map, markers[index]);
        };

        card.innerHTML = `
          <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-store text-red-600 text-xl"></i>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-bold text-gray-900 text-sm mb-1 truncate">${nama}</h3>
              <p class="text-xs text-gray-600 mb-2">${merek} • ${lokasi}</p>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1">
                  <i class="fas fa-star text-yellow-500 text-xs"></i>
                  <span class="text-xs font-semibold text-gray-700">${rating}</span>
                </div>
                <span class="status-badge ${status.class}">${status.text}</span>
              </div>
              ${showroom.distance ? `
                <p class="text-xs text-green-600 font-semibold mt-2">
                  <i class="fas fa-location-arrow mr-1"></i>${showroom.distance.toFixed(2)} km
                </p>
              ` : ''}
            </div>
          </div>
        `;

        listDiv.appendChild(card);
      });
    }

    // Filter & Sort Functions
    function applyFilters() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const locationFilter = document.getElementById('locationFilter').value;
      const statusFilter = document.getElementById('statusFilter').value;

      filteredShowrooms = allShowrooms.filter(showroom => {
        const nama = (showroom.nama?.value || '').toLowerCase();
        const merek = (showroom.merek?.value || '').toLowerCase();
        const lokasi = showroom.lokasi?.value || '';
        const status = showroom.status?.status || '';

        const matchSearch = !searchTerm || nama.includes(searchTerm) || merek.includes(searchTerm);
        const matchLocation = !locationFilter || lokasi === locationFilter;
        const matchStatus = !statusFilter || status === statusFilter;

        return matchSearch && matchLocation && matchStatus && showroom.coordinates;
      });

      updateShowroomList(filteredShowrooms);
      updateMapMarkers(filteredShowrooms);
      document.getElementById('mapCounter').textContent = `${filteredShowrooms.length} Showroom`;
    }

    function updateMapMarkers(showrooms) {
      // Hide all markers
      markers.forEach(marker => marker.setVisible(false));
      infoWindows.forEach(iw => iw.close());

      // Show only filtered markers
      showrooms.forEach((showroom) => {
        const index = allShowrooms.findIndex(s => s.nama?.value === showroom.nama?.value);
        if (index !== -1 && markers[index]) {
          markers[index].setVisible(true);
        }
      });

      // Fit bounds to visible markers
      if (showrooms.length > 0) {
        const bounds = new google.maps.LatLngBounds();
        showrooms.forEach(showroom => {
          if (showroom.coordinates) {
            bounds.extend(showroom.coordinates);
          }
        });
        map.fitBounds(bounds);
      }
    }

    function sortShowrooms(type) {
      // Remove active class from all sort buttons
      document.querySelectorAll('.filter-chip').forEach(btn => btn.classList.remove('active'));

      if (type === 'nearest') {
        if (!userLocation) {
          alert('Lokasi Anda belum tersedia. Mohon izinkan akses lokasi.');
          return;
        }
        document.getElementById('sortNearest').classList.add('active');
        filteredShowrooms.sort((a, b) => (a.distance || Infinity) - (b.distance || Infinity));
      } else if (type === 'name') {
        document.getElementById('sortName').classList.add('active');
        filteredShowrooms.sort((a, b) => {
          const nameA = a.nama?.value || '';
          const nameB = b.nama?.value || '';
          return nameA.localeCompare(nameB);
        });
      } else if (type === 'rating') {
        document.getElementById('sortRating').classList.add('active');
        filteredShowrooms.sort((a, b) => {
          const ratingA = parseFloat(a.rating?.value || 0);
          const ratingB = parseFloat(b.rating?.value || 0);
          return ratingB - ratingA;
        });
      }

      updateShowroomList(filteredShowrooms);
    }

    // Event Listeners
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('locationFilter').addEventListener('change', applyFilters);
    document.getElementById('statusFilter').addEventListener('change', applyFilters);

    document.getElementById('sortNearest').addEventListener('click', () => sortShowrooms('nearest'));
    document.getElementById('sortName').addEventListener('click', () => sortShowrooms('name'));
    document.getElementById('sortRating').addEventListener('click', () => sortShowrooms('rating'));

    document.getElementById('findNearestBtn').addEventListener('click', () => {
      if (!userLocation) {
        // Try to get user location first
        getUserLocation();
        
        setTimeout(() => {
          if (!userLocation) {
            alert('⚠️ Lokasi Anda belum tersedia.\n\nMohon izinkan akses lokasi di browser Anda untuk menggunakan fitur ini.');
          } else {
            // Find and show nearest
            findAndShowNearest();
          }
        }, 2000);
        return;
      }
      
      findAndShowNearest();
    });

    function findAndShowNearest() {
      // Find nearest showroom
      const nearest = filteredShowrooms.reduce((prev, curr) => {
        return (curr.distance || Infinity) < (prev.distance || Infinity) ? curr : prev;
      });

      if (nearest && nearest.coordinates) {
        map.setCenter(nearest.coordinates);
        map.setZoom(16);
        
        // Open info window
        const index = allShowrooms.findIndex(s => s.nama?.value === nearest.nama?.value);
        if (index !== -1) {
          infoWindows[index].open(map, markers[index]);
        }

        // Scroll to card in list
        const listDiv = document.getElementById('showroomList');
        const nearestIndex = filteredShowrooms.findIndex(s => s.nama?.value === nearest.nama?.value);
        if (nearestIndex !== -1) {
          const cards = listDiv.children;
          cards[nearestIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          cards[nearestIndex].classList.add('ring-4', 'ring-green-500');
          setTimeout(() => {
            cards[nearestIndex].classList.remove('ring-4', 'ring-green-500');
          }, 2000);
        }
      }
    }
  </script>

</body>
</html>
