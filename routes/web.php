<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FipeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PlanosController;
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

Route::controller(LoginController::class)->prefix('/log')->as('log.')->group(function(){
    Route::post('/', 'store')->name('log');
});

Route::controller(DashboardController::class)->prefix('/escritorio')->as('escritorio.')->group(function(){
    Route::get('/' , 'index')->name('index');

    Route::controller(ExportController::class)->prefix('export')->as('export.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/import' , 'import')->name('import');
        Route::get('/pessoas' , 'pessoas')->name('pessoas');
        Route::get('/enderecos' , 'enderecos')->name('enderecos');
        Route::get('/telefones' , 'telefones')->name('telefones');
        Route::get('/veiculos' , 'veiculos')->name('veiculos');
        Route::get('/obs' , 'obs')->name('obs');
    });

    Route::controller(UserController::class)->prefix('/users')->as('users.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::post('/store-cliente' , 'storeCliente')->name('storeCliente');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(PessoasController::class)->prefix('/clientes')->as('clientes.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(EnderecoController::class)->prefix('/enderecos')->as('enderecos.')->group(function(){
        Route::get('/{id}' , 'index')->name('index');
        Route::post('/store/{id}' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(TelefoneController::class)->prefix('/telefones')->as('telefones.')->group(function(){
        Route::get('/{id}' , 'index')->name('index');
        Route::post('/store/{id}' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(VeiculosController::class)->prefix('/veiculos')->as('veiculos.')->group(function(){
        Route::get('/{id}' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::delete('/delete/{id}' , 'destroy')->name('destroy');
    });

    Route::controller(FipeController::class)->prefix('/fipe')->as('fipe.')->group(function(){
        Route::post('/marca' , 'marca')->name('marca');
        Route::post('/modelo' , 'modelo')->name('modelo');
        Route::post('/ano' , 'ano')->name('ano');
       
    });

    Route::controller(PlanosController::class)->prefix('/planos')->as('planos.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });

});
// Route::get('/', function () {
//     return view('home');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
