<?php

use App\Http\Controllers\{
    HomeController,
    ItemController,
    RetiradaController,
    UtilizadorController,
    MedicamentoController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(isset(Auth::user()->id) ? 'home' : 'login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(["auth"])->group(function(){

    Route::get('/medicamentos/json', [MedicamentoController::class, 'json'])->name('medicamentos.json');
    Route::get('/items/{id}/medicamento', [ItemController::class, 'medicamento'])->name('items.medicamento');

    Route::resource('utilizadores',UtilizadorController::class);
    Route::resource('medicamentos',MedicamentoController::class);
    Route::resource('retiradas',RetiradaController::class);
    Route::resource('items',ItemController::class);

    Route::post('/account', [HomeController::class, 'update'])->name('account.update');
    Route::post('/password', [HomeController::class, 'password'])->name('account.pass');
    Route::put('/account/photo/{id}', [HomeController::class, 'photo'])->name('account.photo');
});
