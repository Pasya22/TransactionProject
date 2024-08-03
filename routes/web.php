<?php

// use App\Models\TransactionRetail;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataProduct;
use App\Http\Controllers\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataCustomer;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [Dashboard::class, 'Dashboard'])->name('Dashboard');

// ----------------------------------- Customer ---------------------------------- //
Route::get('/DataCustomer', [DataCustomer::class, 'DataCustomer'])->name('DataCustomer');

Route::post('/customer/add', [DataCustomer::class, 'store'])->name('customer.store');
Route::post('/customer/update/{id}', [DataCustomer::class, 'update'])->name('update');
Route::delete('/customer/delete/{id}', [DataCustomer::class, 'destroy'])->name('destroy');


// ----------------------------------------- Product --------------------------------------- //
Route::get('/DataProduct', [DataProduct::class, 'DataProduct'])->name('DataProduct');
Route::post('/product/add', [DataProduct::class, 'store'])->name('Productstore');
Route::post('/product/update/{id}', [DataProduct::class, 'update'])->name('update');
Route::delete('/product/delete/{id}', [DataProduct::class, 'destroy'])->name('destroy');


// ---------------------------------------- Transaction ----------------- //
Route::get('/Transaction', [Transaction::class,'Transaction'])->name('Transaction');
Route::get('/ListTransaction', [Transaction::class, 'ListTransaction'])->name('ListTransaction');
Route::post('/Transaction-sales', [Transaction::class,'store'])->name('t_sales');
Route::get('customers/{kode}', [Transaction::class, 'getCustomerByKode']);
Route::get('barangs/{id}', [Transaction::class, 'getBarangById']);

