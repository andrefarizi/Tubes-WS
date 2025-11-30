<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koordinat Extractor - WheelTrack</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #DC2626;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .section {
            margin: 30px 0;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #DC2626;
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
        button.secondary {
            background: #059669;
        }
        button.secondary:hover {
            background: #047857;
        }
        textarea, input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            margin: 10px 0;
        }
        textarea {
            min-height: 150px;
        }
        .output {
            background: #1e293b;
            color: #e2e8f0;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            overflow-x: auto;
            max-height: 400px;
            overflow-y: auto;
        }
        .output pre {
            margin: 0;
            white-space: pre-wrap;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .input-group {
            margin: 15px 0;
        }
        label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #DEF7EC;
            color: #03543F;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        .badge.error {
            background: #FDE8E8;
            color: #991B1B;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        tr:hover {
            background: #f9fafb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📍 Koordinat Extractor & Verifier</h1>
        <p class="subtitle">Tool untuk extract, verify, dan convert koordinat showroom</p>

        <!-- Section 1: Get dari Google Maps URL -->
        <div class="section">
            <h2>1️⃣ Extract dari Google Maps URL</h2>
            <p>Paste URL Google Maps untuk extract koordinat otomatis</p>
            
            <div class="input-group">
                <label>Google Maps URL:</label>
                <input type="text" id="mapsUrl" placeholder="https://www.google.com/maps/@3.5909601,98.6484569,17z atau https://goo.gl/maps/...">
            </div>
            
            <div class="input-group">
                <label>Nama Showroom:</label>
                <input type="text" id="showroomName" placeholder="TOYOTA DELTAMAS BALAI KOTA">
            </div>
            
            <button onclick="extractFromUrl()">Extract Koordinat</button>
            
            <div id="urlResult" style="display: none;">
                <h3>✅ Hasil Extract:</h3>
                <div class="output" id="urlOutput"></div>
            </div>
        </div>

        <!-- Section 2: Manual Input -->
        <div class="section">
            <h2>2️⃣ Input Manual Koordinat</h2>
            <p>Input koordinat manual untuk generate code</p>
            
            <div class="grid">
                <div class="input-group">
                    <label>Latitude:</label>
                    <input type="text" id="manualLat" placeholder="3.5909601">
                </div>
                <div class="input-group">
                    <label>Longitude:</label>
                    <input type="text" id="manualLng" placeholder="98.6484569">
                </div>
            </div>
            
            <div class="input-group">
                <label>Nama Showroom:</label>
                <input type="text" id="manualName" placeholder="TOYOTA DELTAMAS BALAI KOTA">
            </div>
            
            <button onclick="generateCode()">Generate Code</button>
            <button class="secondary" onclick="verifyOnMaps()">🔍 Verify di Google Maps</button>
            
            <div id="manualResult" style="display: none;">
                <h3>✅ Generated Code:</h3>
                <div class="output" id="manualOutput"></div>
            </div>
        </div>

        <!-- Section 3: Bulk Input -->
        <div class="section">
            <h2>3️⃣ Bulk Input (CSV/Excel)</h2>
            <p>Input multiple showroom sekaligus dalam format CSV</p>
            
            <div class="input-group">
                <label>Format: Nama, Latitude, Longitude (satu per baris)</label>
                <textarea id="bulkInput" placeholder="TOYOTA DELTAMAS BALAI KOTA, 3.5909601, 98.6484569
ASTRA DAIHATSU MEDAN, 3.590960, 98.648457
HONDA AHMAD YANI, 3.595xxx, 98.672xxx"></textarea>
            </div>
            
            <button onclick="processBulk()">Process Bulk Data</button>
            <button class="secondary" onclick="downloadTemplate()">📥 Download Template CSV</button>
            
            <div id="bulkResult" style="display: none;">
                <h3>✅ Hasil Bulk Processing:</h3>
                <div id="bulkTable"></div>
                <div class="output" id="bulkOutput"></div>
            </div>
        </div>

        <!-- Section 4: Verify Existing -->
        <div class="section">
            <h2>4️⃣ Verify Koordinat yang Sudah Ada</h2>
            <p>Check koordinat yang sudah ada di database</p>
            
            <button onclick="showExisting()">Lihat Database Koordinat</button>
            <button class="secondary" onclick="testAllCoordinates()">🧪 Test Semua Koordinat</button>
            
            <div id="existingResult" style="display: none;">
                <h3>📊 Database Koordinat Saat Ini:</h3>
                <div id="existingTable"></div>
            </div>
        </div>
    </div>

    <script>
        // Database koordinat yang sudah ada (sync dengan maps-detail.blade.php)
        const existingCoordinates = {
            'TOYOTA DELTAMAS BALAI KOTA': { lat: 3.5909601, lng: 98.6484569 },
            'ASTRA DAIHATSU MEDAN': { lat: 3.590960, lng: 98.648457 },
        };

        function extractFromUrl() {
            const url = document.getElementById('mapsUrl').value;
            const name = document.getElementById('showroomName').value;
            
            if (!url || !name) {
                alert('Mohon isi URL dan Nama Showroom');
                return;
            }

            // Pattern 1: @lat,lng
            let match = url.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/);
            
            // Pattern 2: q=lat,lng
            if (!match) {
                match = url.match(/q=(-?\d+\.\d+),(-?\d+\.\d+)/);
            }
            
            // Pattern 3: !3d and !4d (from share link)
            if (!match) {
                const lat = url.match(/!3d(-?\d+\.\d+)/);
                const lng = url.match(/!4d(-?\d+\.\d+)/);
                if (lat && lng) {
                    match = [null, lat[1], lng[1]];
                }
            }

            if (match) {
                const lat = parseFloat(match[1]);
                const lng = parseFloat(match[2]);
                
                document.getElementById('manualLat').value = lat;
                document.getElementById('manualLng').value = lng;
                document.getElementById('manualName').value = name;
                
                const code = `'${name}': { lat: ${lat}, lng: ${lng} },`;
                
                document.getElementById('urlResult').style.display = 'block';
                document.getElementById('urlOutput').innerHTML = `
<pre>
<span style="color: #10b981">✅ Koordinat berhasil di-extract!</span>

<span style="color: #60a5fa">Latitude:</span>  ${lat}
<span style="color: #60a5fa">Longitude:</span> ${lng}

<span style="color: #fbbf24">JavaScript Code:</span>
${code}

<span style="color: #fbbf24">Verify Link:</span>
<a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank" style="color: #60a5fa">
https://www.google.com/maps?q=${lat},${lng}
</a>
</pre>`;
            } else {
                alert('❌ Koordinat tidak ditemukan di URL. Pastikan URL valid dari Google Maps.');
            }
        }

        function generateCode() {
            const lat = document.getElementById('manualLat').value;
            const lng = document.getElementById('manualLng').value;
            const name = document.getElementById('manualName').value;
            
            if (!lat || !lng || !name) {
                alert('Mohon isi semua field');
                return;
            }

            const code = `'${name}': { lat: ${lat}, lng: ${lng} },`;
            
            document.getElementById('manualResult').style.display = 'block';
            document.getElementById('manualOutput').innerHTML = `
<pre>
<span style="color: #10b981">✅ Code JavaScript:</span>

${code}

<span style="color: #fbbf24">Copy code di atas dan paste ke:</span>
<span style="color: #94a3b8">resources/views/maps-detail.blade.php</span>

Di dalam function <span style="color: #60a5fa">getKnownShowroomCoordinates()</span>:

<span style="color: #94a3b8">const coordinates = {
  'TOYOTA DELTAMAS BALAI KOTA': { lat: 3.5909601, lng: 98.6484569 },
  'ASTRA DAIHATSU MEDAN': { lat: 3.590960, lng: 98.648457 },</span>
  <span style="color: #10b981">${code}</span>  <span style="color: #f87171">← PASTE DI SINI</span>
<span style="color: #94a3b8">};</span>
</pre>`;
        }

        function verifyOnMaps() {
            const lat = document.getElementById('manualLat').value;
            const lng = document.getElementById('manualLng').value;
            
            if (!lat || !lng) {
                alert('Mohon isi Latitude dan Longitude');
                return;
            }

            const url = `https://www.google.com/maps?q=${lat},${lng}`;
            window.open(url, '_blank');
        }

        function processBulk() {
            const input = document.getElementById('bulkInput').value;
            
            if (!input.trim()) {
                alert('Mohon isi data bulk');
                return;
            }

            const lines = input.trim().split('\n');
            let code = '';
            let tableHtml = '<table><thead><tr><th>Nama</th><th>Latitude</th><th>Longitude</th><th>Action</th></tr></thead><tbody>';
            
            lines.forEach(line => {
                const parts = line.split(',').map(p => p.trim());
                if (parts.length === 3) {
                    const [name, lat, lng] = parts;
                    code += `  '${name}': { lat: ${lat}, lng: ${lng} },\n`;
                    tableHtml += `
                        <tr>
                            <td>${name}</td>
                            <td>${lat}</td>
                            <td>${lng}</td>
                            <td><a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank">🔍 Verify</a></td>
                        </tr>
                    `;
                }
            });
            
            tableHtml += '</tbody></table>';
            
            document.getElementById('bulkResult').style.display = 'block';
            document.getElementById('bulkTable').innerHTML = tableHtml;
            document.getElementById('bulkOutput').innerHTML = `
<pre>
<span style="color: #10b981">✅ Generated Code untuk ${lines.length} showroom:</span>

const coordinates = {
${code}};

<span style="color: #fbbf24">Copy dan paste ke maps-detail.blade.php</span>
</pre>`;
        }

        function downloadTemplate() {
            const csv = `Nama Showroom,Latitude,Longitude
TOYOTA DELTAMAS BALAI KOTA,3.5909601,98.6484569
ASTRA DAIHATSU MEDAN,3.590960,98.648457
CONTOH SHOWROOM 3,3.xxxxx,98.xxxxx`;
            
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'template_koordinat_showroom.csv';
            a.click();
        }

        function showExisting() {
            let tableHtml = '<table><thead><tr><th>Nama Showroom</th><th>Latitude</th><th>Longitude</th><th>Action</th></tr></thead><tbody>';
            
            for (const [name, coords] of Object.entries(existingCoordinates)) {
                tableHtml += `
                    <tr>
                        <td>${name}</td>
                        <td>${coords.lat}</td>
                        <td>${coords.lng}</td>
                        <td>
                            <a href="https://www.google.com/maps?q=${coords.lat},${coords.lng}" target="_blank">🔍 Verify</a> |
                            <a href="http://localhost:8000/maps/showroom?nama=${encodeURIComponent(name)}" target="_blank">🗺️ Test</a>
                        </td>
                    </tr>
                `;
            }
            
            tableHtml += '</tbody></table>';
            
            document.getElementById('existingResult').style.display = 'block';
            document.getElementById('existingTable').innerHTML = tableHtml;
        }

        function testAllCoordinates() {
            const results = [];
            
            for (const [name, coords] of Object.entries(existingCoordinates)) {
                // Test if coordinates are valid (basic check)
                const isValid = coords.lat >= -90 && coords.lat <= 90 && 
                               coords.lng >= -180 && coords.lng <= 180;
                
                // Check if in Medan area (rough bounds)
                const isInMedan = coords.lat >= 3.4 && coords.lat <= 3.7 &&
                                 coords.lng >= 98.5 && coords.lng <= 98.8;
                
                results.push({
                    name,
                    coords,
                    valid: isValid,
                    inMedan: isInMedan,
                    status: isValid && isInMedan ? '✅' : '⚠️'
                });
            }
            
            let tableHtml = '<table><thead><tr><th>Status</th><th>Nama</th><th>Lat, Lng</th><th>In Medan?</th></tr></thead><tbody>';
            
            results.forEach(r => {
                tableHtml += `
                    <tr>
                        <td>${r.status}</td>
                        <td>${r.name}</td>
                        <td>${r.coords.lat}, ${r.coords.lng}</td>
                        <td>${r.inMedan ? '✅ Yes' : '❌ No'}</td>
                    </tr>
                `;
            });
            
            tableHtml += '</tbody></table>';
            
            document.getElementById('existingResult').style.display = 'block';
            document.getElementById('existingTable').innerHTML = `
                <h3>🧪 Test Results:</h3>
                ${tableHtml}
                <p style="color: #10b981; margin-top: 15px;">
                    ✅ ${results.filter(r => r.valid && r.inMedan).length} koordinat valid di area Medan<br>
                    ⚠️ ${results.filter(r => !r.valid || !r.inMedan).length} koordinat perlu review
                </p>
            `;
        }
    </script>
</body>
</html>
