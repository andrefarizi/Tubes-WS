<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailShowroomController extends Controller
{
    // Menampilkan halaman detail showroom
    public function showDetail()
    {
        return view('showroom-detail');
    }

    // API untuk mendapatkan detail showroom berdasarkan nama
    public function getDetail(Request $request)
    {
        $nama = $request->query('nama');
        
        if (!$nama) {
            return response()->json(['error' => 'Nama showroom tidak ditemukan'], 400);
        }

        $endpoint = "http://localhost:3030/showroomWS/sparql";
        
                // Ambil semua data showroom (pakai predicate yang sama dengan ShowroomController)
                $query = "
                PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
                PREFIX ex:  <http://www.example.org/showroom#>

                SELECT ?nama ?merek ?lokasi ?alamat ?noTelepon ?jamOperasional ?rating
                WHERE {
                    ?s rdf:type ex:Showroom ;
                         ex:namaShowroom ?nama ;
                         ex:merek ?merek ;
                         ex:alamat ?alamat ;
                         ex:berlokasiDi ?lokasi .
                    OPTIONAL { ?s ex:noTelepon ?noTelepon . }
                    OPTIONAL { ?s ex:jamOperasional ?jamOperasional . }
                    OPTIONAL { ?s ex:rating ?rating . }
                }
                ";

        $response = Http::withHeaders([
            'Accept' => 'application/sparql-results+json'
        ])->get($endpoint, ['query' => $query]);

        if ($response->failed()) {
            return response()->json(['error' => 'Gagal terhubung ke Fuseki'], 500);
        }

        $results = $response->json();
        $bindings = $results['results']['bindings'] ?? [];
        
        // Filter di PHP untuk mencari nama yang cocok (case-insensitive dan trim)
        $found = null;
        $searchNama = trim(strtolower($nama));
        
        foreach ($bindings as $item) {
            if (isset($item['nama']['value'])) {
                $itemNama = trim(strtolower($item['nama']['value']));
                if ($itemNama === $searchNama) {
                    $found = $item;
                    break;
                }
            }
        }
        
        // Jika tidak ketemu exact match, coba partial match
        if (!$found) {
            foreach ($bindings as $item) {
                if (isset($item['nama']['value'])) {
                    $itemNama = trim(strtolower($item['nama']['value']));
                    if (strpos($itemNama, $searchNama) !== false || strpos($searchNama, $itemNama) !== false) {
                        $found = $item;
                        break;
                    }
                }
            }
        }
        
        if (!$found) {
            return response()->json([
                'error' => 'Showroom tidak ditemukan',
                'searched' => $nama,
                'available' => array_map(function($item) {
                    return $item['nama']['value'] ?? '';
                }, array_slice($bindings, 0, 5))
            ], 404);
        }

        return response()->json($found);
    }
}
