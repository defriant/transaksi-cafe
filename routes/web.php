<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/check-this-user-role', [WebController::class, 'check_role']);

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('index');
    Route::post('/login-attempt', [WebController::class, 'login_attempt']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [WebController::class, 'logout']);

    Route::get('/dashboard/get', [WebController::class, 'get_dashboard']);

    Route::get('/produk/get', [WebController::class, 'get_produk']);
    Route::post('/produk/search', [WebController::class, 'search_produk']);
    Route::post('/produk/input', [WebController::class, 'input_produk']);
    Route::post('/produk/update', [WebController::class, 'update_produk']);
    Route::post('/produk/delete', [WebController::class, 'delete_produk']);

    Route::get('/transaksi', function () {
        return view('transaksi');
    });
    Route::post('/transaksi/get', [WebController::class, 'get_transaksi']);
    Route::post('/transaksi/input', [WebController::class, 'input_transaksi']);
    Route::post('/transaksi/detail', [WebController::class, 'detail_transaksi']);
});

Route::middleware(['auth', 'adminRole'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    });
    Route::get('/admin/produk', function () {
        return view('produk');
    });
    Route::get('/admin/history-transaksi', function () {
        return view('transaksi');
    });
});

Route::middleware(['auth', 'kasirRole'])->group(function () {
    Route::get('/dashboard', function () {
        return view('produk');
    });
    Route::get('/transaksi', function () {
        return view('transaksi');
    });
});
