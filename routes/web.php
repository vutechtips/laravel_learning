<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ImageUploadController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Danh sách BĐS
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

// Tìm kiếm BĐS
Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
// Trang chi tiết BĐS
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');
// Upload ảnh
Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');
Route::get('/upload-test', function () {
    return view('upload-test');
});
