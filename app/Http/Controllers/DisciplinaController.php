<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisciplinaRequest;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $disciplinas = Disciplina::orderBy('id','desc')->paginate();
        return view('pages.disciplina', ["panel"=>"disciplinas","disciplinas"=>$disciplinas]);
    }

    public function jsonCurso(Request $request){
        $search = $request->get('curso');
        if(!UserUtil::isAdministrador()) return [];
        if(empty($search)) return [];
        $disciplinas = Disciplina::join('curso_disciplina','disciplinas.id','disciplina_id')
                    ->where('curso_id',$search)
                    ->select('disciplinas.*')
                    ->get();
        return $disciplinas;
    }

    public function json(Request $request){
        $search = $request->get('search');
        if(!UserUtil::isAdministrador()) return [];
        if(empty($search)) return [];
        $disciplinas = Disciplina::where('nome','like',"%{$search}%")->orderBy('id','desc')->get();
        return $disciplinas;
    }

    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.disciplina', ["panel"=>"disciplinas","action"=>route('disciplinas.store')]);
    }

    public function store(DisciplinaRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Disciplina::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('disciplinas.index');
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $disciplina = Disciplina::find($id);
        return view('form.disciplina', ["panel"=>"disciplinas","disciplina"=>$disciplina,"action"=>route('disciplinas.update',$id)]);
    }

    public function update(DisciplinaRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $disciplina = Disciplina::find($id);
                $disciplina->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('disciplinas.index');
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
                $disciplina = Disciplina::find($id);
                $disciplina->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function curso_list($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $disciplina = Disciplina::find($id);
        $cursos = Curso::join('curso_disciplina','cursos.id','curso_id')
                    ->where('disciplina_id',$id)
                    ->select('cursos.*','curso_disciplina.id as curso_disciplina_id')
                    ->paginate();
        return view('pages.disciplina_join_curso.curso_list', [
            "panel"=>"disciplinas","cursos"=>$cursos, "cumb"=>$disciplina->nome,'disciplina'=>$disciplina
        ]);
    }

    public function curso_add($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $disciplina = Disciplina::find($id);
        return view('pages.disciplina_join_curso.curso_add', [
            "panel"=>"disciplinas", "cumb"=>$disciplina->nome,'disciplina'=>$disciplina
        ]);
    }

}
