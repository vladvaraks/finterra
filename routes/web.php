<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ajax\GetUsersController;
use App\Http\Controllers\ajax\GetWalletController;
use App\Http\Controllers\HomeController;

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

Route::middleware('guest')->group(function (){
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Для работы с кошельками
    Route::get('/wallets', [WalletsController::class, 'index'])->name('wallets');
    Route::post('/wallets', [WalletsController::class, 'store'])->name('create_wallet');
    Route::get('/wallets/{wallet}/edit', [WalletsController::class, 'edit'])->name('edit_wallet');
    Route::patch('/wallets/{wallet}', [WalletsController::class, 'update'])->name('update_wallet');

    //Для переводов
    Route::get('/transfer', [TransferController::class, 'index'])->name('transfer');
    Route::post('/transfer', [TransferController::class, 'store']);

    //выборка кошельков в ajax
    Route::get('ajax/wallets', [GetWalletController::class, 'index'])->name('ajax_wallets');
    Route::get('ajax/wallets/{wallet}', [GetWalletController::class, 'show']);

    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

});

