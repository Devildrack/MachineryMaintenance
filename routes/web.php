<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UnlockAccountController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipoMaquinariaEquipoController;
use App\Http\Controllers\FrenteTrabajoController;
use App\Http\Controllers\MaquinariaEquipoController;
use App\Http\Controllers\ProductoController;

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
    return view('auth/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('signed');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/unlock-account', [UnlockAccountController::class, 'index'])->name('unlock.form');
Route::post('/unlock-account/send', [UnlockAccountController::class, 'sendUnlockLink'])->name('unlock.send');
Route::get('/unlock-account/verify/{id}/{hash}', [UnlockAccountController::class, 'verifyUnlock'])->name('unlock.verify');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('usuarios', UserController::class)->only(['index', 'store', 'update']);
    Route::resource('roles', RoleController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('tipomaquinarias', TipoMaquinariaEquipoController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('frentesTrabajo', FrenteTrabajoController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('maquinarias', MaquinariaEquipoController::class)->only(['index','store','update','destroy']);
    Route::resource('productos', ProductoController::class)->only(['index','store','update','destroy']);
});
