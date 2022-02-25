<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OptionsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('Estados/{id}', [OptionsController::class, 'Buscar_Estados']);//->name("BEstados");
Route::get('Ciudades/{id}', [OptionsController::class, 'Buscar_Ciudades']);//->name("BEstados");

Route::get('/EditarUser/{id}', [ AdminUsersController::class, 'Users'])->middleware('auth');
Route::post('/EditarUser/{id}', [ AdminUsersController::class, 'Users'])->middleware('auth');
Route::get('/DeleteUser/{id}', [ AdminUsersController::class, 'DeleteUser'])->middleware('auth');
Route::get('/Buscar/{id}', [ AdminUsersController::class, 'Buscar'])->middleware('auth');
//Route::get('/Emailusuario/{id}', [ AdminUsersController::class, 'Mailusuarios']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'SendMailLog'])->name('home');
Route::get('/Emailusuario/{id}', [ HomeController::class, 'Mailusuarios']);
Route::get('/Emailsall', [ HomeController::class, 'Emailsall']);