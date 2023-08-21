<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\CursoDisciplina;
use App\Models\Disciplina;
use App\Utils\UserUtil;
use Illuminate\Http\Request;

class LancarNotaController extends Controller
{
    public function cursos(){
        if(!UserUtil::isProfessor()) return redirect()->back();
        $user_id = auth()->user()->id;
        $cursos = Curso::join('curso_disciplina','curso_id','cursos.id')
                ->join('disciplinas','disciplina_id','disciplinas.id')
                ->join('professores','curso_disciplina_id','curso_disciplina.id')
                ->where('professores.user_id',$user_id)
                ->select('cursos.*','disciplina.nome as disciplina','disciplina_id','curso_disciplina_id')
                ->orderBy('curso_disciplina.id','desc')
                ->paginate();
        return view('professor.curso', ["panel"=>"lancar","cursos"=>$cursos]);
    }

    public function curso_disciplina($id){
        if(!UserUtil::isProfessor()) return redirect()->back();
        $cursoDisciplina = CursoDisciplina::find($id);
        $disciplina = Disciplina::find($cursoDisciplina->id);
        $alunos = Aluno::join('users','user_id','users.id')
                    ->leftjoin('notas','notas.aluno_id','alunos.id')
                    ->where('alunos.curso_id',$cursoDisciplina->curso_id)
                    ->where('notas.curso_disciplina_id',$cursoDisciplina->id)
                    ->select("users.name as aluno","nota_primeira","nota_segunda","nota_terceira","nota_final")
                    ->paginate();
        return view('professor.lancar_nota', ["panel"=>"lancar","disciplina" => $disciplina,"cursoDisciplina"=>$cursoDisciplina, "alunos" => $alunos]);
    }

}
