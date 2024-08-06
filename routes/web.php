<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

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

Route::controller(WebController::class)->prefix('/')->as('./')->group(function(){
    Route::get('/', 'index')->name('index');
});

Route::controller(DashboardController::class)->prefix('/escritorio')->as('/escritorio.')->group(function(){
    Route::get('/' , 'index')->name('index');

    Route::controller(UserController::class)->prefix('/users')->as('/users.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(PessoasController::class)->prefix('/pessoas')->as('/pessoas.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(EnderecoController::class)->prefix('/enderecos')->as('/enderecos.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(TelefoneController::class)->prefix('/telefones')->as('/telefones.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(VeiculosController::class)->prefix('/veiculos')->as('/veiculos.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

});
// Route::get('/', function () {
//     return view('home');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
