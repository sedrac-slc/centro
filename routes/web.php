<?php

use App\Http\Controllers\{
    HomeController,
    NotaController,
    CursoController,
    AlunoController,
    ProfessorController,
    DisciplinaController,
    UtilizadorController,
    CursoDisciplinaController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(isset(Auth::user()->id) ? 'home' : 'login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(["auth"])->group(function(){

    Route::resource('curso-disciplina',CursoDisciplinaController::class);
    Route::resource('utilizadores',UtilizadorController::class);
    Route::resource('disciplinas',DisciplinaController::class);
    Route::resource('professores',ProfessorController::class);
    Route::resource('alunos', AlunoController::class);
    Route::resource('cursos',CursoController::class);
    Route::resource('notas',NotaController::class);

    Route::put('conta/foto-perfil/{id}', [HomeController::class, 'photo'])->name('account.photo');
    Route::post('conta/palavra-passe', [HomeController::class, 'password'])->name('account.pass');
    Route::post('conta/actualizar', [HomeController::class, 'update'])->name('account.update');

});
