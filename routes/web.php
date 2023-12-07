<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PostulacionesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\TrabajosController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	Route::resource('users', UsersController::class)->names('users');
	Route::resource('empresas', EmpresasController::class)->names('empresas');
	Route::resource('trabajos', TrabajosController::class)->names('trabajos');
	Route::resource('personal', PersonalController::class)->names('personal');
	Route::resource('sucursales', SucursalesController::class)->names('sucursales');

	Route::get('showEmpresas', [TrabajosController::class, 'showEmpresas'])->name('showEmpresas');
	Route::delete('eliminarEmpresa/{id}', [TrabajosController::class, 'eliminarEmpresa'])->name('eliminarEmpresa');
	Route::get('gestionarUsuarios', [UsersController::class, 'gestionUsuarios'])->name('gestionarUsuarios');
	Route::get('agregarPersonal', [UsersController::class, 'agregarPersonal'])->name('agregarPersonal');
	Route::post('registrarPersonalDirecto', [UsersController::class, 'store'])->name('registrarPersonalDirecto');

	Route::get('showPostulacion/{id}', [PostulacionesController::class, 'showPostulaciones'])->name('showPostulaciones');
	Route::post('registrarPersonal', [PostulacionesController::class, 'registrarPersonal'])->name('registrarPersonal');

	Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/register-empresa', [RegisterController::class, 'createEmpresa']);
    Route::post('/register-empresa', [RegisterController::class, 'storeEmpresa']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
	
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');


