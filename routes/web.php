<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\SettingController;

Route::get('/404', [LoginController::class, 'denegado'])->middleware('auth')->name('denegado');
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::get('/login', [LoginController ::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);

Route::get('/salir', [LoginController::class, 'salir'])->name('salir');
Route::get('/dashboard',[LoginController::class,'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/movimientos',[LoginController::class,'movimientos'])->middleware('auth')->name('movimientos');
Route::get('/configuracion',[LoginController::class,'setting'])->middleware('auth')->name('setting');

Route::post('/search',[SettingController::class, 'search'])->name('search');
Route::get('/result_query/{ced}',[SettingController::class, 'result_query'])->name('result_query');

Route::get('/users/list',[UserController::class,'create'])->middleware('auth')->name('users');
Route::get('/registro',[UserController::class,'usuariosAdd'])->name('usuariosAdd');
Route::post('/registro',[UserController::class,'store'])->name('agregarUsuario');
Route::get('/users/edit/{id}',[UserController::class,'editarUser'])->middleware('auth')->name('usuarioX');
Route::post('/users/edit/{id}',[UserController::class,'updateUser'])->middleware('auth')->name('updateUser');
Route::post('/users/delete/{id}',[UserController::class,'destroy'])->middleware('auth')->name('usersDelete');

Route::get('/changePassword', [UserController::class, 'showChangePasswordGet'])->middleware('auth')->name('changePasswordGet');
Route::post('/changePassword',[UserController::class, 'changePasswordPost'])->middleware('auth')->name('changePasswordPost');

// rutas vue
Route::post('/cajas-vue', [MovimientoController::class, 'Cajas']);
Route::post('/opcion-vue', [MovimientoController::class, 'MovimientoOpcion']);
Route::post('/get_saldo-vue', [MovimientoController::class, 'getSaldo']);

Route::post('/registrarMovimiento-vue', [MovimientoController::class, 'registrarMovimiento']);
Route::post('/movimientos-vue', [MovimientoController::class, 'Movimientos']);
Route::post('/saldo_cajas-vue', [MovimientoController::class, 'saldoCajas']);
Route::post('/agregar_caja-vue', [MovimientoController::class, 'agregar_caja']);
Route::post('/eliminar_caja-vue', [MovimientoController::class, 'eliminar_caja']);
Route::post('/agregar_opcion-vue', [MovimientoController::class, 'agregar_opcion']);
Route::post('/eliminar_opcion-vue', [MovimientoController::class, 'eliminar_opcion']);
Route::post('/eliminar_movimiento-vue', [MovimientoController::class, 'eliminar_movimiento']);

// DashBoard principa setting
Route::post('/nivelar_caja-vue', [MovimientoController::class, 'nivelar_caja']);
Route::post('/getSetting-vue', [SettingController::class, 'getSetting']);
Route::post('/update_setting-vue', [SettingController::class, 'updateSetting']);
Route::post('/trasladar_dinero-vue', [MovimientoController::class, 'trasladarDinero']);








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


