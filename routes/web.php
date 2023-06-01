<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::resource('cars', CarController::class);
Route::post('/cars', [CarController::class, 'store'])->name('car_store')->middleware(['auth', 'is_admin']);
Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('cars.comments', CommentController::class)->shallow()->middleware('auth');
Route::post('/cars/{car}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::delete('/cars/{car}/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chat', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat', [ChatController::class, 'message'])->name('chat.message');
    Route::get('order/confirm/{car}', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::post('/order/store/{car}', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/thankyou', function () {return view('order.thankyou');})->name('order.thankyou');   
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/cars/{car}/configure', [CarController::class, 'configure'])->name('cars.configure');
    Route::post('/order/{car}/configure', [OrderController::class, 'configure'])->name('order.configure');


});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/cars/edit/{car}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/admin/cars/update/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/admin/cars/delete/{car}', [CarController::class, 'destroy'])->name('admin.delete_car');
    Route::get('/admin/cars/list', [CarController::class, 'list'])->name('admin.cars_list');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('car_create');
    Route::post('/admin/orders/updateStatus', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/orders', [OrderController::class, 'list'])->name('admin.orders');
    Route::get('/admin/cars/{car}/options', [CarController::class, 'options'])->name('admin.cars.options');
    Route::post('/admin/cars/{car}/options', [CarController::class, 'storeOption']);


});

require __DIR__ . '/auth.php';
