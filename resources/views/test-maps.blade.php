<!DOCTYPE html>
<html>
<head>
    <title>Google Maps API Test - WheelTrack</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        .status {
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }
        #map {
            height: 500px;
            width: 100%;
            margin: 20px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        button {
            background: #DC2626;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }
        button:hover {
            background: #991B1B;
        }
        pre {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <h1>🗺️ Google Maps API Connection Test</h1>
    
    <div id="status" class="status warning">
        <strong>⏳ Testing API Connection...</strong>
        <p>Loading Google Maps JavaScript API...</p>
    </div>

    <div id="info" style="display: none;">
        <h3>✅ API Information</h3>
        <pre id="apiInfo"></pre>
    </div>

    <div id="map"></div>

    <div id="actions" style="display: none;">
        <h3>🧪 Test Actions</h3>
        <button onclick="testGeocoding()">Test Geocoding API</button>
        <button onclick="testDirections()">Test Directions API</button>
        <button onclick="testUserLocation()">Test User GPS</button>
        <button onclick="window.location.href='/maps'">Go to Maps Page</button>
    </div>

    <div id="results" style="margin-top: 20px;"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('maps.google_api_key') }}&callback=initMap&libraries=places,geometry" async defer></script>

    <script>
        let map;
        let geocoder;
        let directionsService;

        function initMap() {
            try {
                // Create map
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: { lat: 3.5952, lng: 98.6722 } // Medan
                });

                geocoder = new google.maps.Geocoder();
                directionsService = new google.maps.DirectionsService();

                // Add test marker
                new google.maps.Marker({
                    position: { lat: 3.5952, lng: 98.6722 },
                    map: map,
                    title: 'Test Marker - Medan',
                    animation: google.maps.Animation.DROP
                });

                // Update status
                document.getElementById('status').className = 'status success';
                document.getElementById('status').innerHTML = `
                    <strong>✅ SUCCESS!</strong>
                    <p>Google Maps API loaded successfully!</p>
                    <p>Map is displayed below with a marker in Medan.</p>
                `;

                // Show API info
                const apiInfo = {
                    'API Key': '{{ config("maps.google_api_key") }}',
                    'Map Center': '3.5952, 98.6722 (Medan)',
                    'Libraries': 'places, geometry',
                    'Status': 'Connected ✅'
                };
                
                document.getElementById('apiInfo').textContent = JSON.stringify(apiInfo, null, 2);
                document.getElementById('info').style.display = 'block';
                document.getElementById('actions').style.display = 'block';

            } catch (error) {
                document.getElementById('status').className = 'status error';
                document.getElementById('status').innerHTML = `
                    <strong>❌ ERROR!</strong>
                    <p>Failed to initialize map: ${error.message}</p>
                `;
            }
        }

        function testGeocoding() {
            addResult('⏳ Testing Geocoding API...', 'warning');
            
            const address = "Jl. Balai Kota No.2a, Medan, Sumatera Utara, Indonesia";
            
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === 'OK') {
                    const location = results[0].geometry.location;
                    
                    new google.maps.Marker({
                        position: location,
                        map: map,
                        title: 'Geocoded Location',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                    });
                    
                    map.setCenter(location);
                    map.setZoom(16);
                    
                    addResult(`✅ Geocoding Success!\nAddress: ${address}\nCoordinates: ${location.lat()}, ${location.lng()}`, 'success');
                } else {
                    addResult(`❌ Geocoding Failed: ${status}`, 'error');
                }
            });
        }

        function testDirections() {
            addResult('⏳ Testing Directions API...', 'warning');
            
            const request = {
                origin: { lat: 3.5688, lng: 98.6566 }, // USU
                destination: { lat: 3.5952, lng: 98.6722 }, // Medan Center
                travelMode: google.maps.TravelMode.DRIVING
            };
            
            directionsService.route(request, (result, status) => {
                if (status === 'OK') {
                    const route = result.routes[0].legs[0];
                    addResult(`✅ Directions Success!\nDistance: ${route.distance.text}\nDuration: ${route.duration.text}\nFrom USU to Medan Center`, 'success');
                    
                    // Draw route
                    const directionsRenderer = new google.maps.DirectionsRenderer({
                        map: map,
                        polylineOptions: {
                            strokeColor: '#DC2626',
                            strokeWeight: 5
                        }
                    });
                    directionsRenderer.setDirections(result);
                } else {
                    addResult(`❌ Directions Failed: ${status}`, 'error');
                }
            });
        }

        function testUserLocation() {
            addResult('⏳ Testing User GPS...', 'warning');
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        
                        new google.maps.Marker({
                            position: pos,
                            map: map,
                            title: 'Your Location',
                            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                        });
                        
                        map.setCenter(pos);
                        map.setZoom(14);
                        
                        addResult(`✅ GPS Success!\nYour Location: ${pos.lat}, ${pos.lng}`, 'success');
                    },
                    (error) => {
                        addResult(`❌ GPS Failed: ${error.message}`, 'error');
                    }
                );
            } else {
                addResult('❌ Browser doesn\'t support Geolocation', 'error');
            }
        }

        function addResult(message, type) {
            const div = document.createElement('div');
            div.className = `status ${type}`;
            div.innerHTML = `<pre>${message}</pre>`;
            document.getElementById('results').appendChild(div);
        }

        // Error handler
        window.onerror = function(msg, url, line) {
            document.getElementById('status').className = 'status error';
            document.getElementById('status').innerHTML = `
                <strong>❌ JavaScript Error!</strong>
                <p>${msg}</p>
                <p>Line: ${line}</p>
            `;
        };
    </script>

    <footer style="margin-top: 40px; padding: 20px; background: #f4f4f4; border-radius: 8px;">
        <h3>📋 Troubleshooting Guide</h3>
        <ul>
            <li><strong>Gray box instead of map?</strong> → Check API key in .env file</li>
            <li><strong>"InvalidKeyMapError"?</strong> → API key not valid or APIs not enabled</li>
            <li><strong>"RefererNotAllowedMapError"?</strong> → Domain restriction issue</li>
            <li><strong>"ApiNotActivatedMapError"?</strong> → Enable the API in Google Cloud Console</li>
        </ul>
        <p><strong>Current API Key:</strong> <code>{{ config('maps.google_api_key') }}</code></p>
        <p><strong>Config File:</strong> <code>config/maps.php</code></p>
        <p><strong>Env File:</strong> <code>.env</code> (GOOGLE_MAPS_API_KEY)</p>
    </footer>
</body>
</html>
