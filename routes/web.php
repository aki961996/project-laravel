<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

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

//new route

Route::get('/invoice', function () {
    return view('invoice.invoice');
})->middleware(['auth', 'verified'])->name('invoice');

//new start
Route::middleware('auth')->group(
    function () {

        Route::get('/invoice', [InvoiceController::class, 'list'])->name('invoice');
        Route::get('/customer', [InvoiceController::class, 'add'])->name('customer.add');
        Route::post('/customer', [InvoiceController::class, 'store'])->name('customer.store');

        //edit
        Route::get('/customer/edit/{id}', [InvoiceController::class, 'edit'])->name('customer.edit');
        Route::post('/customer/update', [InvoiceController::class, 'customer_update'])->name('customer.update');
        Route::get('/customer/delete/{id}', [InvoiceController::class, 'customer_delete'])->name('customer.delete');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
