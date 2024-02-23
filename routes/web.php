<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
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
    Route::post('/purchase_orders', [PurchaseOrderController::class, 'index'])->name('purchase_orders.index');
    Route::post('/purchase_orders/approve', [PurchaseOrderController::class, 'approve'])->name('purchase_orders.approve');
    Route::post('/purchase_orders/create', [PurchaseOrderController::class, 'store'])->name('purchase_orders.store');
    Route::get('/purchase_orders/create', [PurchaseOrderController::class, 'create'])->name('purchase_orders.create');
    Route::get('/purchase_orders/{hashedId}', [PurchaseOrderController::class, 'show'])->name('purchase_orders.show');
    Route::post('/purchase_orders/{hashedId}', [PurchaseOrderController::class, 'update'])->name('purchase_orders.update');

    //attachments routes
    Route::post('/attachments/upload', [AttachmentController::class, 'upload'])->name('attachments.upload');
    Route::get('/attachments/download/{hashedId}', [AttachmentController::class, 'download'])->name('attachments.download');
    Route::get('/attachments/view/{hashedId}', [AttachmentController::class, 'view'])->name('attachments.view');
    Route::delete('/attachments/delete/{hashedId}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');

    //interactions routes
    Route::post('/interactions/create', [InteractionController::class, 'store'])->name('interactions.store');

    //budget routes
    Route::get('/budgets/{hashedId}', [BudgetController::class, 'index'])->name('budgets.index');//listar
    Route::get('/budgets/create/{hashedId}', [BudgetController::class, 'show'])->name('budgets.create'); //criar novo
    Route::post('/budgets/create', [BudgetController::class, 'store'])->name('budget.create'); //salvar novo
    Route::get('/budgets/products/{hashedId}', [BudgetController::class, 'products'])->name('budgets.products');
    Route::post('/budgets/products', [BudgetController::class, 'storeProducts'])->name('budgets.storeProducts');
    Route::get('/budgets/details/{hashedId}', [BudgetController::class, 'details'])->name('budgets.details');
    Route::post('/budgets/products/delete', [BudgetController::class, 'deleteProduct'])->name('budgets.deleteProduct');
    Route::get('/budget/value/{id}', [BudgetController::class, 'getValue'])->name('budget.value');


    //supplier routes
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers/create', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/edit/{hashedId}', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::get('/suppliers/show/{hashedId}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::patch('/suppliers/update/{hashedId}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::get('/suppliers/getAll/{cnpj}', [SupplierController::class, 'getAllByCnpj'])->name('suppliers.getAll');

    //product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{hashedId}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/update/{hashedId}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/show/{hashedId}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/getAll/{name}', [ProductController::class, 'getAllByName'])->name('products.getAll');
    Route::delete('/products/delete/{hashedId}', [ProductController::class, 'destroy'])->name('products.destroy');

    //payments routes
    Route::post('/payments/create', [PaymentController::class, 'store'])->name('payments.store');
    Route::post('/payments/delete', [PaymentController::class, 'delete'])->name('payments.delete');

});

require __DIR__.'/auth.php';
