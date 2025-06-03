<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ImageDescController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderExportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function() {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::resource('products', ProductController::class);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // arahkan ke halaman home setelah logout
})->name('logout');

Route::get('/admin/profile/edit', function () {
    return view('admin.edit-profile');
})->name('admin.profile.edit');

Route::resource('/admin/products', ProductController::class)->only([
    'index', 'store', 'update', 'destroy'
])->names([
    'index' => 'products.index',
    'store' => 'products.store',
    'update' => 'products.update',
    'destroy' => 'products.destroy',
]);

Route::resource('/admin/services', ServiceController::class)->only([
    'index', 'store', 'update', 'destroy'
])->names([
    'index' => 'services.index',
    'store' => 'services.store',
    'update' => 'services.update',
    'destroy' => 'services.destroy',
]);

Route::get('/admin/images', [ImageDescController::class, 'index'])->name('images.index');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/admin/orders/export', [OrderExportController::class, 'export'])->name('export.excel');
Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/admin/images', [ImageDescController::class, 'index'])->name('dashboard.images.index');
Route::delete('/dashboard/images/{id}', [ImagedescController::class, 'destroy'])->name('dashboard.images.destroy');

// Route update deskripsi (PUT)
Route::put('/admin/images/description', [ImageDescController::class, 'updateDescription'])->name('dashboard.description.update');

// Route simpan gambar (POST)
Route::post('/admin/images', [ImageDescController::class, 'storeImage'])->name('dashboard.images.store');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
Route::post('/orders/{id}/validate-payment', [OrderController::class, 'validatePayment'])->name('orders.validatePayment');

Route::post('/orders/manage', [OrderController::class, 'manage'])->name('orders.manage');

Route::patch('/orders/update-payment', [OrderController::class, 'updatePayment'])->name('orders.updatePayment');


