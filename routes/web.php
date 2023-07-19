<?php

use App\Http\Controllers\{
    HomeController,
    ItemController,
    RetiradaController,
    RelatorioController,
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

    Route::get('retiradas/{id}/items',[RetiradaController::class,'items'])->name('retiradas.items');
    Route::get('retiradas/{id}/medicamento', [RetiradaController::class, 'medicamento'])->name('retiradas.medicamento');
    Route::get('items/{id}/medicamento', [ItemController::class, 'medicamento'])->name('items.medicamento');
    Route::get('medicamentos/json', [MedicamentoController::class, 'json'])->name('medicamentos.json');

    Route::get('medicamentos/search', [MedicamentoController::class, 'search'])->name('medicamentos.search');
    Route::get('utilizadores/search', [UtilizadorController::class, 'search'])->name('utilizadores.search');
    Route::get('items/search', [ItemController::class, 'search'])->name('items.search');

    Route::resource('utilizadores',UtilizadorController::class);
    Route::resource('medicamentos',MedicamentoController::class);
    Route::resource('retiradas',RetiradaController::class);
    Route::resource('items',ItemController::class);

    Route::put('account/photo/{id}', [HomeController::class, 'photo'])->name('account.photo');
    Route::post('password', [HomeController::class, 'password'])->name('account.pass');
    Route::post('account', [HomeController::class, 'update'])->name('account.update');

    Route::post('relatorio',[RelatorioController::class,'renderPdf'])->name('relatoria');
});
