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

class LancarNotaController extends Controller
{
    public function cursos(){
        if(!UserUtil::isProfessor()) return redirect()->back();
        $user_id = auth()->user()->id;
        $cursos = Curso::join('curso_disciplina','curso_id','cursos.id')
                ->join('disciplinas','disciplina_id','disciplinas.id')
                ->join('professores','curso_disciplina_id','curso_disciplina.id')
                ->where('professores.user_id',$user_id)
                ->select('cursos.*','disciplinas.nome as disciplina','disciplina_id','curso_disciplina_id')
                ->orderBy('curso_disciplina.id','desc')
                ->paginate();
        return view('professor.curso', ["panel"=>"lancar","cursos"=>$cursos]);
    }

    public function curso_disciplina($id){
        if(!UserUtil::isProfessor()) return redirect()->back();
        $cursoDisciplina = CursoDisciplina::find($id);
        $disciplina = Disciplina::find($cursoDisciplina->id);
        $alunos = Aluno::with('user')->where('curso_id',$cursoDisciplina->curso_id)->paginate();
        return view('professor.lancar_nota', ["panel"=>"lancar","disciplina" => $disciplina,"cursoDisciplina"=>$cursoDisciplina, "alunos" => $alunos]);
    }

    public function lancar_store(Request $request,$id){
        try{
            if(!UserUtil::isProfessor()) return redirect()->back();
            $alunos = $request->alunos ?? [];
            $nota_primeiro = $request->nota_primeiro ?? [];
            $nota_segunda = $request->nota_segunda ?? [];
            $nota_terceiro = $request->nota_terceiro ?? [];
            $tam = sizeof($alunos);
            for($i=0; $i < $tam; $i++){
                $data = ["curso_disciplina_id" => $id, "aluno_id" => $alunos[$i] ];
                $this->insertOrUpdate($data,$nota_primeiro[$i] ?? 0,$nota_segunda[$i] ?? 0,$nota_terceiro[$i] ?? 0);
            }
            MessageToastrUtil::success();
        }catch(\Exception $e){
            dd($e);
            MessageToastrUtil::error();
        }
        return redirect()->back();
    }

    private function insertOrUpdate($data,$nota_primeiro,$nota_segunda,$nota_terceiro){
        $nota = Nota::where($data)->first();
        $data["nota_primeira"]=$nota_primeiro;
        $data["nota_segunda"]=$nota_segunda;
        $data["nota_terceira"]=$nota_terceiro;
        $data["nota_final"] = ($data["nota_primeira"]+$data["nota_segunda"]+$data["nota_terceira"])/3;
        if(isset($nota->id)){
            $data['updated_by'] = Auth::user()->id;
            $nota->update($data);
        }else{
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            $nota = Nota::create($data);
        }
        return $nota;
    }

}
