<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CarController;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::resource('cars', CarController::class)->middleware('auth');
Route::post('/cars', [CarController::class, 'store'])->name('car_store')->middleware(['auth', 'is_admin']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/cars/edit/{car}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/admin/cars/update/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/admin/cars/delete/{car}', [CarController::class, 'destroy'])->name('admin.delete_car');
    Route::get('/admin/cars/list', [CarController::class, 'list'])->name('admin.cars_list');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('car_create');
});

require __DIR__ . '/auth.php';
