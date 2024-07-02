<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'homepage'])->name('homepage');
Route::post('/refund', [MainController::class, 'postRefund'])->name('create_refund');
Route::get('/refund/{id}', [MainController::class, 'editRefund'])->name('edit_refund');
Route::put('/refund/{id}', [MainController::class, 'updateRefund'])->name('update_refund');
Route::delete('/refund/{id}', [MainController::class, 'deleteRefund'])->name('delete_refund');

Route::get('/user', [MainController::class, 'userHomepage'])->name('user_homepage');
Route::post('/user', [MainController::class, 'postUser'])->name('create_user');
Route::get('/user/{id}', [MainController::class, 'editUser'])->name('edit_user');
Route::put('/user/{id}', [MainController::class, 'updateUser'])->name('update_user');
Route::delete('/user/{id}', [MainController::class, 'deleteUser'])->name('delete_user');
