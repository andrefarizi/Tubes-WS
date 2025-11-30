<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index()
    {
        return view('maps');
    }

    public function showroomDetail(Request $request)
    {
        $nama = $request->input('nama');
        return view('maps-detail', ['showroomName' => $nama]);
    }
}
