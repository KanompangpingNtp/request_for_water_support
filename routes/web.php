<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersRequestController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [UsersRequestController::class, 'UserIndex'])->name('UserIndex');
Route::post('/user/request', [UsersRequestController::class, 'FormCreate'])->name('user.request.submit');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/requests', [AdminRequestController::class, 'showRequests'])->name('admin.requests');
//     Route::post('/forms/reply/{id}', [AdminRequestController::class, 'reply'])->name('forms.reply');
//     Route::get('admin/water-support-requests/{id}/edit', [AdminRequestController::class, 'ShowFormEdit'])->name('ShowFormEdit');
//     Route::post('admin/water-support-requests/{id}', [AdminRequestController::class, 'FormUpdate'])->name('FormUpdate');
//     Route::post('/requests/update-status/{id}', [AdminRequestController::class, 'updateStatus'])->name('updateStatus');
//     Route::get('/requests/export/{id}', [AdminRequestController::class, 'exportPDF'])->name('exportPDF');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/users', [UsersRequestController::class, 'userAccount'])->name('userAccount');
// });

// Route สำหรับ admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/requests', [AdminRequestController::class, 'showRequests'])->name('admin.requests');
    Route::post('/forms/reply/{id}', [AdminRequestController::class, 'reply'])->name('forms.reply');
    Route::get('admin/water-support-requests/{id}/edit', [AdminRequestController::class, 'ShowFormEdit'])->name('ShowFormEdit');
    Route::post('admin/water-support-requests/{id}', [AdminRequestController::class, 'AdminFormUpdate'])->name('AdminFormUpdate');
    Route::post('/requests/update-status/{id}', [AdminRequestController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/requests/export/{id}', [AdminRequestController::class, 'adminexportPDF'])->name('adminexportPDF');
});

// Route สำหรับ users
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/users', [UsersRequestController::class, 'userAccount'])->name('userAccount');
    Route::get('/users/follw', [UsersRequestController::class, 'showUserRequest'])->name('showUserRequest');
    Route::get('/user/requests/export/{id}', [UsersRequestController::class, 'exportPDF'])->name('exportPDF');
    Route::get('user/water-support-requests/{id}/edit', [UsersRequestController::class, 'ShowFormUserEdit'])->name('ShowFormUserEdit');
    Route::post('user/water-support-requests/{id}', [UsersRequestController::class, 'FormUpdate'])->name('FormUpdate');
    Route::post('/user/forms/reply/{id}', [UsersRequestController::class, 'userreply'])->name('userreply');
});

