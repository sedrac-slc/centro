<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function json(Request $request){
        $search = $request->get('search');
        if(!UserUtil::isAdministrador()) return [];
        if(empty($search)) return [];
        $alunos = Aluno::join("users","user_id","users.id")
                ->join('cursos','curso_id','cursos.id')
                ->where('name','like',"%{$search}%")
                ->where('alunos.is_terminado',0)
                ->select('users.*','alunos.id as aluno_id','cursos.preco','cursos.nome as curso','cursos.id as curso_id')
                ->get();
        return $alunos;
    }

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $alunos = Aluno::with('user')->orderBy('id','desc')->distinct('user_id')->paginate();
        return view('pages.aluno', ["panel"=>"alunos","alunos"=>$alunos]);
    }

    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.aluno', ["panel"=>"alunos","action"=>route('alunos.store')]);
    }

    public function store(AlunoRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            $request->validate(["curso_id"=>"required"]);
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $data['tipo'] = "ALUNO";
                $user = User::create($data);
                $data['user_id'] = $user->id;
                Aluno::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('alunos.index');
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $aluno = Aluno::with('user')->find($id);
        return view('form.aluno', ["panel"=>"alunos","aluno"=>$aluno,"action"=>route('alunos.update',$id)]);
    }

    public function update(AlunoRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $aluno = Aluno::find($id);
                $aluno->user->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('alunos.index');
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
                $aluno = Aluno::find($id);
                $aluno->delete();
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
        $aluno = Aluno::find($id);
        $cursos = Curso::join('alunos','curso_id','cursos.id')
                    ->join('users','user_id','users.id')
                    ->where('user_id',$aluno->user->id)
                    ->select("cursos.*","alunos.id as aluno_id")
                    ->paginate();
        return view('pages.aluno_join_curso.curso_list', [
            "panel"=>"alunos","cursos"=>$cursos, "cumb"=>$aluno->user->name,'aluno'=>$aluno
        ]);
    }

    public function curso_add($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $aluno = Aluno::find($id);
        return view('pages.aluno_join_curso.curso_add', [
            "panel"=>"alunos", "cumb"=>$aluno->user->name,'aluno'=>$aluno
        ]);
    }

    public function curso_add_store(Request $request, $id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $request->validate(["curso_id" => "required"]);
        $data = ["curso_id" => $request->curso_id, "user_id" => $id];
        $aluno = Aluno::where($data)->first();
        if(isset($aluno->id)){
            MessageToastrUtil::warning("O estudante já pertence a este curso");
        }else{
            MessageToastrUtil::success("O estudante foi adicionado no curso com successo");
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;
            Aluno::create($data);
        }
        return back();
    }

}
