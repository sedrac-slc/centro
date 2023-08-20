<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorRequest;
use App\Models\CursoDisciplina;
use App\Models\Professor;
use App\Models\User;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $professores = Professor::with('user')->join('curso_disciplina','curso_disciplina_id','curso_disciplina.id')
                            ->join('cursos','curso_disciplina.curso_id','cursos.id')
                            ->join('disciplinas','curso_disciplina.disciplina_id','disciplinas.id')
                            ->orderBy('professores.id','desc')
                            ->select('professores.*','cursos.nome as curso','disciplinas.nome as disciplina')
                            ->paginate();
        return view('pages.professor', ["panel"=>"professores","professores"=>$professores]);
    }

    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.professor', ["panel"=>"professores","action"=>route('professores.store')]);
    }

    public function store(ProfessorRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            $request->validate(['curso_id' => "required","disciplina_id" => "required"]);
            DB::transaction(function () use ($request) {
                $cursoDisciplina = CursoDisciplina::where([
                    "curso_id"=>$request->curso_id, "disciplina_id"=>$request->disciplina_id
                ])->first();
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $data['tipo'] = "PROFESSOR";
                $user = User::create($data);
                $data['user_id'] = $user->id;
                $data['curso_disciplina_id'] = $cursoDisciplina->id;
                Professor::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('professores.index');
        } catch (\Exception $e) {
            dd($e);
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $professor = Professor::with('user')->find($id);
        return view('form.professor', ["panel"=>"professores","professor"=>$professor,"action"=>route('professores.update',$id)]);
    }

    public function update(ProfessorRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $professor = Professor::find($id);
                $professor->user->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('professores.index');
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
                $professor = Professor::find($id);
                $professor->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

}
