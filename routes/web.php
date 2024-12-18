<?php

use App\Http\Controllers\{
    HomeController,
    NotaController,
    CursoController,
    AlunoController,
    InscricaoController,
    ProfessorController,
    PagamentoController,
    DisciplinaController,
    UtilizadorController,
    LancarNotaController,
    VisualizarNotaController,
    CursoDisciplinaController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/incricoes-public', [InscricaoController::class, 'index_public'])->name('inscricao.public');
Route::post('/incricoes-public', [InscricaoController::class, 'store_public'])->name('inscricao.store.public');

Route::middleware(["auth"])->group(function(){

    Route::get('curso-aluno/disciplinas/{id}',[VisualizarNotaController::class,'disciplina'])->name('view.disciplinas');
    Route::get('curso-aluno/notas/{id}',[VisualizarNotaController::class,'nota'])->name('view.notas');
    Route::get('curso-aluno',[VisualizarNotaController::class,'cursos'])->name('view.index');

    Route::post('lancar_store/{id}',[LancarNotaController::class,'lancar_store'])->name('lancar.store');
    Route::get('lancar',[LancarNotaController::class,'cursos'])->name('lancar.index');
    Route::get('lancar-nota-curso/{id}',[LancarNotaController::class,'curso_disciplina'])->name('lancar.curso.disciplina');

    Route::get('alunos/{id}/pagamentos/add',[PagamentoController::class,'pagamento_add'])->name('alunos.pagamento.add');
    Route::get('alunos/{id}/pagamentos/list',[PagamentoController::class,'pagamento_list'])->name('alunos.pagamento.list');

    Route::post('professores/{id}/curso-disciplina/adicionar',[CursoDisciplinaController::class,'professor_add_store'])->name('professores.curso_disciplina.store');
    Route::get('professores/{id}/curso-disciplina/listar',[CursoDisciplinaController::class,'professor_list'])->name('professores.curso_disciplina.list');
    Route::get('professores/{id}/curso-disciplina/adicionar',[CursoDisciplinaController::class,'professor_add'])->name('professores.curso_disciplina.add');

    Route::post('alunos/{id}/cursos/adicionar',[AlunoController::class,'curso_add_store'])->name('aluno-curso.store');
    Route::get('alunos/{id}/cursos/listar',[AlunoController::class,'curso_list'])->name('alunos.curso.list');
    Route::get('alunos/{id}/cursos/adicionar',[AlunoController::class,'curso_add'])->name('alunos.curso.add');
    Route::get('alunos/json',[AlunoController::class,'json'])->name('alunos.ajax');

    Route::get('disciplinas/jsonCurso',[DisciplinaController::class, 'jsonCurso'])->name('disciplinas.ajax.jsonCurso');
    Route::get('disciplinas/json',[DisciplinaController::class,'json'])->name('disciplinas.ajax');

    Route::get('cursos/jsonThenDiscipline',[CursoController::class,'jsonThenDiscipline'])->name('cursos.ajax.thenDisciplina');
    Route::get('cursos/json',[CursoController::class,'json'])->name('cursos.ajax');
    Route::get('cursos/{id}/disciplinas/listar',[CursoController::class,'disciplina_list'])->name('cursos.disciplina.list');
    Route::get('cursos/{id}/disciplinas/adicionar',[CursoController::class,'disciplina_add'])->name('cursos.disciplina.add');

    Route::get('disciplinas/{id}/cursos/listar',[DisciplinaController::class,'curso_list'])->name('disciplinas.curso.list');
    Route::get('disciplinas/{id}/cursos/adicionar',[DisciplinaController::class,'curso_add'])->name('disciplinas.curso.add');

    Route::resource('curso-disciplina',CursoDisciplinaController::class);
    Route::resource('utilizadores',UtilizadorController::class);
    Route::resource('inscricaoes', InscricaoController::class);
    Route::resource('disciplinas',DisciplinaController::class);
    Route::resource('professores',ProfessorController::class);
    Route::resource('pagamentos',PagamentoController::class);
    Route::resource('alunos', AlunoController::class);
    Route::resource('cursos',CursoController::class);
    Route::resource('notas',NotaController::class);

    Route::put('conta/foto-perfil/{id}', [HomeController::class, 'photo'])->name('account.photo');
    Route::post('conta/palavra-passe', [HomeController::class, 'password'])->name('account.pass');
    Route::post('conta/actualizar', [HomeController::class, 'update'])->name('account.update');

    Route::get('/incricoes', [InscricaoController::class, 'index'])->name('inscricoes.index');
    Route::post('/incricoao-confirm', [InscricaoController::class, 'confirm'])->name('inscricoes.confirm');
    Route::delete('/incricoao-delete/{id}', [InscricaoController::class, 'delete'])->name('inscricoes.delete');

});
