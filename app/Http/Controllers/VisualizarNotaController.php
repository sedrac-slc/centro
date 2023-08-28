<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\CursoDisciplina;
use App\Models\Disciplina;
use App\Models\Nota;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualizarNotaController extends Controller
{
    public function cursos(){
        if(!UserUtil::isAluno()) return redirect()->back();
        $user_id = auth()->user()->id;
        $cursos = Curso::join('alunos','curso_id','cursos.id')
                        ->where('user_id',$user_id)
                        ->select('cursos.*')
                        ->orderBy('cursos.id','desc')
                        ->paginate();;
        return view('aluno.curso', ["panel"=>"visualizar","cursos"=>$cursos]);
    }

    public function nota($id){
        if(!UserUtil::isAluno()) return redirect()->back();
        $user_id = auth()->user()->id;
        $notas = Nota::join('curso_disciplina','curso_disciplina_id','curso_disciplina.id')
                    ->join('alunos','notas.aluno_id','alunos.id')
                    ->join('disciplinas','disciplina_id','disciplinas.id')
                    ->where('alunos.user_id',$user_id)
                    ->where('curso_disciplina.curso_id',$id)
                    ->select('notas.*','disciplinas.nome as disciplina')
                    ->paginate();
        return view('aluno.nota', ["panel"=>"visualizar","notas"=>$notas]);
    }

    public function disciplina($id){
        if(!UserUtil::isAluno()) return redirect()->back();
        $disciplinas = Disciplina::join('curso_disciplina','disciplina_id','disciplinas.id')
                            ->where('curso_id',$id)
                            ->paginate();
        return view('aluno.disciplina', ["panel"=>"visualizar","disciplinas"=>$disciplinas]);
    }


}
