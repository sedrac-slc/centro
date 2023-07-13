<?php

use App\Http\Controllers\{
    HomeController,
    RetiradaController,
    UtilizadorController,
    MedicamentoController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(["auth"])->group(function(){

    Route::resource('utilizadores',UtilizadorController::class);
    Route::resource('medicamentos',MedicamentoController::class);
    Route::resource('retiradas',RetiradaController::class);

    Route::post('/account', [HomeController::class, 'update'])->name('account.update');
    Route::post('/password', [HomeController::class, 'password'])->name('account.pass');
    Route::put('/account/photo/{id}', [HomeController::class, 'photo'])->name('account.photo');

});
