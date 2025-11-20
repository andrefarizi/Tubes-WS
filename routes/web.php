<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\DetailShowroomController;

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
