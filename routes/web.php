<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseOrder\PurchaseOrderController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/purchase_orders', [PurchaseOrderController::class, 'index'])->name('purchase_orders.index');
    Route::post('/purchase_orders/approve', [PurchaseOrderController::class, 'approve'])->name('purchase_orders.approve');
    Route::post('/purchase_orders/create', [PurchaseOrderController::class, 'store'])->name('purchase_orders.store');
    Route::get('/purchase_orders/create', [PurchaseOrderController::class, 'create'])->name('purchase_orders.create');
    Route::get('/purchase_orders/{purchase_order}', [PurchaseOrderController::class, 'show'])->name('purchase_orders.show');
    Route::post('/purchase_orders/{purchase_order}', [PurchaseOrderController::class, 'update'])->name('purchase_orders.update');

    //attachments routes
    Route::post('/attachments/upload', [AttachmentController::class, 'upload'])->name('attachments.upload');
    Route::get('/attachments/download/{attachment}', [AttachmentController::class, 'download'])->name('attachments.download');
    Route::get('/attachments/view/{attachment}', [AttachmentController::class, 'view'])->name('attachments.view');
    Route::delete('/attachments/delete/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');

    //interactions routes
    Route::post('/interactions/create', [InteractionController::class, 'store'])->name('interactions.store');
});

require __DIR__.'/auth.php';
