<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $cursos = Curso::orderBy('id','desc')->paginate();
        return view('pages.curso', ["panel"=>"cursos","cursos"=>$cursos]);
    }

    public function json(Request $request){
        $search = $request->get('search');
        if(!UserUtil::isAdministrador()) return [];
        if(empty($search)) return [];
        $cursos = Curso::where('nome','like',"%{$search}%")->orderBy('id','desc')->get();
        return $cursos;
    }

    public function jsonThenDiscipline(Request $request){
        $search = $request->get('search');
        if(!UserUtil::isAdministrador()) return [];
        if(empty($search)) return [];
        $array = collect(DB::select("SELECT DISTINCT curso_id FROM curso_disciplina"))->map(function($q){
            return $q->curso_id;
        })->all();
        $cursos = Curso::where('nome','like',"%{$search}%")
                        ->whereIn('id',$array)
                        ->orderBy('id','desc')
                        ->get();
        return $cursos;
    }

    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.curso', ["panel"=>"cursos","action"=>route('cursos.store')]);
    }

    public function store(CursoRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Curso::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('cursos.index');
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $curso = Curso::find($id);
        return view('form.curso', ["panel"=>"cursos","curso"=>$curso,"action"=>route('cursos.update',$id)]);
    }

    public function update(CursoRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $curso = Curso::find($id);
                $curso->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('cursos.index');
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
                $curso = Curso::find($id);
                $curso->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function disciplina_list($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $curso = Curso::find($id);
        $disciplinas = Disciplina::join('curso_disciplina','disciplinas.id','disciplina_id')
                    ->where('curso_id',$id)->select('disciplinas.*','curso_disciplina.id as curso_disciplina_id')
                    ->paginate();
        return view('pages.curso_join_disciplina.disciplina_list', [
            "panel"=>"cursos","disciplinas"=>$disciplinas, "cumb"=>$curso->nome,'curso'=>$curso
        ]);
    }

    public function disciplina_add($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $curso = Curso::find($id);
        return view('pages.curso_join_disciplina.disciplina_add', [
            "panel"=>"cursos", "cumb"=>$curso->nome,'curso'=>$curso
        ]);
    }

}
