<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\DetailShowroomController;
use App\Http\Controllers\MapsController;

Route::get('/', function () {
    return view('showroom');
});

Route::get('/cara-kerja', function () {
    return view('cara-kerja');
});

// API-like routes for the showroom page
Route::get('/showroom/locations', [ShowroomController::class, 'getLocations'])->name('showroom.locations');
Route::get('/search', [ShowroomController::class, 'search'])->name('showroom.search');

// Detail showroom routes - menggunakan DetailShowroomController
Route::get('/showroom/detail-page', [DetailShowroomController::class, 'showDetail'])->name('showroom.detail.page');
Route::get('/showroom/detail', [DetailShowroomController::class, 'getDetail'])->name('showroom.detail.api');

// Maps routes - menggunakan MapsController
Route::get('/maps', [MapsController::class, 'index'])->name('maps.index');
Route::get('/maps/showroom', [MapsController::class, 'showroomDetail'])->name('maps.showroom');

// Test route untuk debug Google Maps API
Route::get('/test-maps', function () {
    return view('test-maps');
})->name('test.maps');

// Helper untuk extract dan verify koordinat showroom
Route::get('/koordinat-helper', function () {
    return view('koordinat-helper');
})->name('koordinat.helper');
