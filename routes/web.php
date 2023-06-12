<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkirTransaction;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::middleware('user')->group(function() {
    Route::get('/state', [ParkirTransaction::class, 'getTransPerParkirGate'])->name('state');
    Route::get('/parkinghistory', [ParkirTransaction::class, 'getHistoryParkir'])->name('history');
    Route::get('/myqr', [ParkirTransaction::class, 'indexMyQR'])->name('myqr');
});
Route::middleware('gate')->group(function() {
    Route::get('/scanqr', [ParkirTransaction::class, 'indexScanQR'])->name('scanqr');
    Route::post('/scanqr', [ParkirTransaction::class, 'processQrScanned']);
});
Route::middleware('admin')->group(function() {
    Route::get('/home', [AdminController::class , 'indexPage'])->name('admin.home');
    Route::get('/gates', [AdminController::class , 'indexGates'])->name('admin.gates');
    Route::post('/gates', [AdminController::class , 'saveGate'])->name('admin.gates.save');
    Route::get('/gates/{gate}/edit', [AdminController::class , 'indexGates'])->name('admin.gates.edit');
    Route::delete('/gates/{gate}', [AdminController::class , 'deleteGate'])->name('admin.gates.delete');
    Route::put('/gates/{gate}', [AdminController::class , 'updateGate'])->name('admin.gates.update');

    Route::get('/gatespace', [AdminController::class , 'indexGatespace'])->name('admin.gatespace');
    Route::post('/gatespace', [AdminController::class , 'saveGatespace'])->name('admin.gatespace.save');
    Route::get('/gatespace/{gateSpace}/edit', [AdminController::class , 'indexGatespace'])->name('admin.gatespace.edit');
    Route::delete('/gatespace/{gate}', [AdminController::class , 'deleteGatespace'])->name('admin.gatespace.delete');
    Route::put('/gatespace/{gate}', [AdminController::class , 'updateGatespace'])->name('admin.gatespace.update');

    Route::get('/users', [AdminController::class , 'indexUsers'])->name('admin.user');
    Route::get('/users/tambah', [AdminController::class , 'tambahUser'])->name('admin.user.tambah');
    Route::post('/users', [AdminController::class , 'saveUser'])->name('admin.user.save');
    Route::get('/users/{user}/edit', [AdminController::class , 'editUser'])->name('admin.user.edit');
    Route::delete('/users/{user}', [AdminController::class , 'deleteUser'])->name('admin.user.delete');
    Route::put('/users/{user}', [AdminController::class , 'updateUser'])->name('admin.user.update');

    Route::get('/history', [AdminController::class , 'historyPage'])->name('admin.history');

});

Route::get('/', [AuthController::class, 'loginPage'])->name('home');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('login.process');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'actionRegister'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
