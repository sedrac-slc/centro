<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisciplinaRequest;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Utils\UserUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $disciplinas = Curso::orderBy('id','desc')->paginate();
        return view('pages.curso', ["panel"=>"disciplinas","disciplinas"=>$disciplinas]);
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
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->back();
        }
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
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
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
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->back();
        }
    }

}
