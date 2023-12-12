<?php

use App\Http\Controllers\Api\v1\GetUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function (){
        //выборка пользователей в ajax
        Route::get('ajax/users', [GetUsersController::class, 'index'])->name('ajax_users');
        Route::get('ajax/users/{user}', [GetUsersController::class, 'show']);
});
