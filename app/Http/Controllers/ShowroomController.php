<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShowroomController extends Controller
{
    public function index()
    {
        $endpoint = "http://localhost:3030/WheelTrack/sparql";
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX ex:  <http://www.example.org/showroom#>

        SELECT ?nama ?lokasi
        WHERE {
          ?s rdf:type ex:Showroom ;
             ex:namaShowroom ?nama ;
             ex:berlokasiDi ?lokasi .
        }
        ORDER BY ?lokasi
        ";

        $response = Http::withHeaders([
            'Accept' => 'application/sparql-results+json'
        ])->get($endpoint, ['query' => $query]);

        $results = $response->json();
        \Log::info('Semua lokasi showroom:', $results['results']['bindings'] ?? []);

        return view('showroom');
    }

    // Dropdown lokasi
    public function getLocations()
    {
        $endpoint = "http://localhost:3030/WheelTrack/sparql";
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX ex:  <http://www.example.org/showroom#>

        SELECT DISTINCT ?lokasi
        WHERE {
          ?s rdf:type ex:Showroom ;
             ex:berlokasiDi ?lokasi .
          FILTER (STRLEN(STR(?lokasi)) > 0)
        }
        ORDER BY ASC (?lokasi)
        ";

        $response = Http::withHeaders([
            'Accept' => 'application/sparql-results+json'
        ])->get($endpoint, ['query' => $query]);

        if ($response->failed()) {
            return response()->json(['error' => 'Gagal mengambil lokasi']);
        }

        $results = $response->json();
        $locations = array_map(
            fn($item) => $item['lokasi']['value'],
            $results['results']['bindings'] ?? []
        );

        return response()->json($locations);
    }

   
   
public function search(Request $request)
{
    $endpoint   = "http://localhost:3030/WheelTrack/sparql";

   
    // --- NORMALISASI KEYWORD (dukung leet & huruf berulang) ---
    $keywordRaw = strtolower($request->input('q', ''));
    $lokasi     = strtolower($request->query('lokasi', ''));
    $sort       = strtolower($request->query('sort', '')); // '', 'asc', 'desc'

   $keywordLeet = $keywordRaw;


    // buang selain huruf/angka/spasi/tanda minus, lalu rapikan spasi
    $keyword      = preg_replace('/[^a-z0-9\s\-]/', ' ', $keywordLeet);
    $keyword      = preg_replace('/\s+/', ' ', trim($keyword));

    // kompres huruf berulang (≥2 jadi 1) → toyotaaaaaaaa -> toyota
    $keyword      = preg_replace('/([a-z])\1{1,}/', '$1', $keyword);

    // normalisasi singkatan jalan
    $keyword      = preg_replace('/\b(jl|jln)\b/', 'jalan', $keyword);

    // tokenisasi (untuk filter AND per-kata)
    $tokens       = $keyword === '' ? [] : explode(' ', $keyword);

    $brandMap = [
      'avanza' => 'toyota',
        'inova' => 'Toyota',
        'fortuner' => 'Toyota',
        'yaris' => 'Toyota',
        'rush' => 'Toyota',
        'voxy' => 'Toyota',
        'kijang' => 'Toyota',
        'calya' => 'Toyota',
        'alphard' => 'Toyota',
        'velfire' => 'Toyota',
        'veloz' => 'Toyota',
        'Raize' => 'Toyota',
        'corola cros' => 'Toyota',
        'land cruiser' => 'Toyota',
        'corola' => 'Toyota',
        'agya' => 'Toyota',
        'gr 86' => 'Toyota',
        'camry' => 'Toyota',
        'vios' => 'Toyota',
        'dynam' => 'Toyota',
        'hilux' => 'Toyota',
        'hiace' => 'Toyota',
        'supra' => 'Toyota',
        'terios' => 'Daihatsu',
        'xenia' => 'Daihatsu',
        'ayla' => 'Daihatsu',
        'sigra' => 'Daihatsu',
        'rocky' => 'Daihatsu',
        'sirion' => 'Daihatsu',
        'luxio' => 'Daihatsu',
        'grand max' => 'Daihatsu',
        'brio' => 'Honda',
        'civic' => 'Honda',
        'jazz' => 'Honda',
        'hr-v' => 'Honda',
        'cr-v' => 'Honda',
        'hrv' => 'Honda',
        'crv' => 'Honda',
        'city' => 'Honda',
        'accord' => 'Honda',
        'mobilio' => 'Honda',
        'br-v' => 'Honda',
        'brv' => 'Honda',
        'wrv' => 'Honda',
        'w-rv' => 'Honda',
        'xpander' => 'Mitsubishi',
        'x-pander' => 'Mitsubishi',
        'pajero' => 'Mitsubishi',
        'pajero-sport' => 'Mitsubishi',
        'outlander' => 'Mitsubishi',
        'outlander-sport' => 'Mitsubishi',
        'l1000' => 'Mitsubishi',
        'l300' => 'Mitsubishi',
        'triton' => 'Mitsubishi',
        'destinator' => 'Mitsubishi',
        'xforce' => 'Mitsubishi',
        'fronx' => 'Suzuki',
        'ertiga' => 'Suzuki',
        'xl7' => 'Suzuki',
        'apv' => 'Suzuki',
        'jimny' => 'Suzuki',
        'ignis' => 'Suzuki',
        's-cros' => 'Suzuki',
        'grand vitara' => 'Suzuki',
        'spresso' => 'Suzuki',
        'carry' => 'Suzuki',
        '218i' => 'BMW',
        '220i' => 'BMW',
        '320i' => 'BMW',
        '330i' => 'BMW',
        '430i' => 'BMW',
        '520i' => 'BMW',
        '735i' => 'BMW',
        '840i' => 'BMW',
        'x1' => 'BMW',
        'x3' => 'BMW',
        'x4' => 'BMW',
        'x5' => 'BMW',
        'x6' => 'BMW',
        'x7' => 'BMW',
        'z4' => 'BMW',
        'm135i' => 'BMW',
        'm235i' => 'BMW',
        'm3' => 'BMW',
        'm4' => 'BMW',
        'm5' => 'BMW',
        'm8' => 'BMW',
        'BYD SEAL' => 'BYD',
        'BYD ATTO 3' => 'BYD',
        'BYD DOLPHIN' => 'BYD',
        'BYD M6' => 'BYD',
        'BYD SEALION 7' => 'BYD',
        'BYD ATTO 1' => 'BYD',
        'Tigo 9' => 'Chery',
        'Tigo 8' => 'Chery',
        'Chery j6' => 'Chery',
        'tigo' => 'Chery',
        'omoda' => 'Chery',
        'chery c5' => 'Chery',
        'captiva' => 'Chevrolet',
        'aveo' => 'Chevrolet',
        'spin' => 'Chevrolet',
        'acitv' => 'Chevrolet',
        'orlando' => 'Chevrolet',
        'everest' => 'Ford',
        'explorer' => 'Ford',
        'ranger' => 'Ford',
        'mustang' => 'Ford',
        'x-trail' => 'Nissan',
        'livina' => 'Nissan',
        'tera' => 'Nissan',
        'leaf' => 'Nissan',
        'maginite' => 'Nissan',
        'kicks' => 'Nissan',
        'cx-3' => 'Mazda',
        'cx-30' => 'Mazda',
        'cx-5' => 'Mazda',
        'cx-8' => 'Mazda',
        'cx-9' => 'Mazda',
        'cx-80' => 'Mazda',
        'cx-60' => 'Mazda',
        'mazda2' => 'Mazda',
        'mazda3' => 'Mazda',
        'mazda6' => 'Mazda',
        'mx-30' => 'Mazda',
        'mx-5' => 'Mazda',
        'zs' => 'MG',
        'cyberster' => 'MG',
        'VS' => 'MG',
        'MG5' => 'MG',
        'MG HS' => 'MG',
        'panca' => 'dastun',
        'mitra ev' => 'wuling',
        'binguo' => 'wuling',
        'cloud ev' => 'wuling',
        'air ev' => 'wuling',
        'almaz' => 'wuling',
        'cortez' => 'wuling',
        'confero' => 'wuling',
        'formo' => 'wuling',
        'alvez' => 'wuling',
        'mu-X' => 'Isuzu',
        'mercy' => 'Mercedes-Benz',
        's 450' => 'Mercedes-Benz',
        'glc' => 'Mercedes-Benz',
        'gls' => 'Mercedes-Benz',
    ];

    // Check for multi-word brand names first
    foreach ($brandMap as $key => $value) {
        if (strpos($keyword, $key) !== false) {
            $keyword = str_replace($key, $value, $keyword);
        }
    }

    
    // tokenisasi (untuk filter AND per-kata)
    $tokens = $keyword === '' ? [] : explode(' ', $keyword);
    
    if (count($tokens) === 1) {
        $t0 = $tokens[0];
        if (isset($brandMap[$t0])) $tokens[0] = $brandMap[$t0];
    }

    // ORDER BY saat mode pencarian
    $orderBy = "ORDER BY ?nama";
    if ($sort === 'desc') $orderBy = "ORDER BY DESC(?ratingNum) ?nama";
    if ($sort === 'asc')  $orderBy = "ORDER BY ASC(?ratingNum) ?nama";

    // Siapkan filter token (pakai field yang SUDAH dinormalisasi di SPARQL: *_norm)
    $tokenFilters = [];
    foreach ($tokens as $tok) {
        $t = addslashes($tok);
        if ($t === '') continue;
        $tokenFilters[] =
            "( regex(?alamat_norm, \"$t\", \"i\") || " .
            "  regex(?lokasi_norm, \"$t\", \"i\") || " .
            "  regex(?nama_norm,   \"$t\", \"i\") || " .
            "  regex(?merek_norm,  \"$t\", \"i\") )";
    }
    $filterAND = count($tokenFilters) ? "FILTER ( " . implode(" && ", $tokenFilters) . " )" : "";

    // Filter lokasi dropdown (pakai lokasi_norm)
    $lokEsc    = addslashes($lokasi);
    $lokFilter = ($lokEsc !== '') ? "FILTER (regex(?lokasi_norm, \"$lokEsc\", \"i\"))" : "";

    // MODE AWAL: 25 showroom acak
    $isInitial = (empty($tokens) && $lokEsc === '' && $sort === '');
    if ($isInitial) {
        $query = "
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX ex:  <http://www.example.org/showroom#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

SELECT ?nama ?rating ?merek ?alamat ?noTelepon ?jamOperasional ?website ?lokasi
WHERE {
  ?s rdf:type ex:Showroom ;
     ex:namaShowroom ?nama ;
     ex:merek ?merek ;
     ex:alamat ?alamat ;
     ex:berlokasiDi ?lokasi .
  OPTIONAL { ?s ex:noTelepon ?noTelepon . }
  OPTIONAL { ?s ex:jamOperasional ?jamOperasional . }
  OPTIONAL { ?s ex:website ?website . }
  OPTIONAL { ?s ex:rating ?rating . }

  BIND(
    IF(BOUND(?rating),
       xsd:decimal(REPLACE(STR(?rating), \",\", \".\")),
       xsd:decimal(0)
    ) AS ?ratingNum
  )
}
ORDER BY RAND()

";
    } else {
        // MODE PENCARIAN: normalisasi data → ganti "jl", "jl.", "jln", "jln." menjadi "jalan" di setiap field
        $query = "
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX ex:  <http://www.example.org/showroom#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

SELECT DISTINCT ?nama ?rating ?merek ?alamat ?noTelepon ?jamOperasional ?website ?lokasi
WHERE {
  ?s rdf:type ex:Showroom ;
     ex:namaShowroom ?nama ;
     ex:merek ?merek ;
     ex:alamat ?alamat ;
     ex:berlokasiDi ?lokasi .
  OPTIONAL { ?s ex:noTelepon ?noTelepon . }
  OPTIONAL { ?s ex:jamOperasional ?jamOperasional . }
  OPTIONAL { ?s ex:website ?website . }
  OPTIONAL { ?s ex:rating ?rating . }

  # rating numerik untuk sorting
  BIND(
    IF(BOUND(?rating),
       xsd:decimal(REPLACE(STR(?rating), \",\", \".\")),
       xsd:decimal(0)
    ) AS ?ratingNum
  )

  # lower-case semua field textual
  BIND(lcase(str(?alamat)) AS ?alamat_l)
  BIND(lcase(str(?lokasi)) AS ?lokasi_l)
  BIND(lcase(str(?nama))   AS ?nama_l)
  BIND(lcase(str(?merek))  AS ?merek_l)

  # normalisasi jl/jln → jalan pada data (alamat/lokasi/nama/merek)
  BIND(REPLACE(REPLACE(?alamat_l, \"\\\\bjl\\\\.?\\\\s*\", \"jalan \"), \"\\\\bjln\\\\.?\\\\s*\", \"jalan \") AS ?alamat_norm)
  BIND(REPLACE(REPLACE(?lokasi_l, \"\\\\bjl\\\\.?\\\\s*\", \"jalan \"), \"\\\\bjln\\\\.?\\\\s*\", \"jalan \") AS ?lokasi_norm)
  BIND(REPLACE(REPLACE(?nama_l,   \"\\\\bjl\\\\.?\\\\s*\", \"jalan \"), \"\\\\bjln\\\\.?\\\\s*\", \"jalan \") AS ?nama_norm)
  BIND(REPLACE(REPLACE(?merek_l,  \"\\\\bjl\\\\.?\\\\s*\", \"jalan \"), \"\\\\bjln\\\\.?\\\\s*\", \"jalan \") AS ?merek_norm)

  $filterAND
  $lokFilter
}
$orderBy
";
    }

    \Log::info('SPARQL search query:', [$query]);

    $response = Http::withHeaders([
        'Accept' => 'application/sparql-results+json'
    ])->get($endpoint, ['query' => $query]);

    if ($response->failed()) {
        return response()->json(['error' => 'Gagal terhubung ke Fuseki']);
    }

    $results = $response->json();
    return response()->json($results['results']['bindings'] ?? []);
}
}