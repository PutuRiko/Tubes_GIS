<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RuasJalanController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/layout', [UserController::class, 'showLayout'])->name('layout');

Route::get('/provinsi', [RegionController::class, 'fetchProvinsi'])->name('provinsi.fetch');
Route::get('/kabupaten/{provinceId}', [RegionController::class, 'fetchKabupaten'])->name('kabupaten.fetch');
Route::get('/kecamatan/{kabupatenId}', [RegionController::class, 'fetchKecamatan'])->name('kecamatan.fetch');
Route::get('/desa/{kecamatanId}', [RegionController::class, 'fetchDesa'])->name('desa.fetch');

Route::get('/ruasjalan', [RuasJalanController::class, 'index'])->name('ruasjalan.index');
