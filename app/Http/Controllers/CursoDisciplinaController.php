<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CursoDisciplinaRequest;
use App\Models\CursoDisciplina;
use App\Models\Professor;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursoDisciplinaController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $curso_disciplinas = CursoDisciplina::orderBy('id','desc')->paginate();
        return view('pages.curso_disciplina', ["panel"=>"curso_disciplinas","curso_disciplinas"=>$curso_disciplinas]);
    }

    public function store(CursoDisciplinaRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                CursoDisciplina::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function update(CursoDisciplinaRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $curso_disciplina = CursoDisciplina::find($id);
                $curso_disciplina->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($id) {
                $curso_disciplina = CursoDisciplina::find($id);
                $curso_disciplina->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function professor_list($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $professor = Professor::find($id);
        $cursoDisciplina = CursoDisciplina::with('curso','disciplina')
                    ->join('professores','professores.curso_disciplina_id','curso_disciplina.id')
                    ->join('users','user_id','users.id')
                    ->where('users.id',$professor->user->id)
                    ->orderBy('professores.id','DESC')
                    ->select("curso_disciplina.*","professores.id as professor_id")
                    ->paginate();
        return view('pages.professor_join_cursoDisciplina.curso_disciplina_list', [
            "panel"=>"curso_disciplinas","cursoDisciplinas"=>$cursoDisciplina, "cumb"=>$professor->user->name,'professor'=>$professor
        ]);
    }

    public function professor_add($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $professor = Professor::find($id);
        return view('pages.professor_join_cursoDisciplina.curso_disciplina_add', [
            "panel"=>"curso_disciplinas", "cumb"=>$professor->user->name,'professor'=>$professor
        ]);
    }

    public function professor_add_store(Request $request, $id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $request->validate(["curso_id" => "required","disciplina_id" => "required"]);
        $data = ["curso_id" => $request->curso_id, "disciplina_id" => $request->disciplina_id];
        $cursoDisciplina = CursoDisciplina::where($data)->first();
        if(!isset($cursoDisciplina->id)){
            MessageToastrUtil::warning("A disciplina não esta associada no curso, faça este processo primeiro");
            return back();
        }
        $data=["curso_disciplina_id" => $cursoDisciplina->id, "user_id"=> $id];
        $aluno = Professor::where($data)->first();
        if(isset($aluno->id)){
            MessageToastrUtil::warning("O professor já pertence a este curso e leciona a disciplina");
        }else{
            MessageToastrUtil::success("O professor foi adicionado ao curso lecionando a disciplina");
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            Professor::create($data);
        }
        return back();
    }

}
