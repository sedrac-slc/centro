<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotaRequest;
use App\Models\CursoDisciplina;
use App\Models\Nota;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{

    private function validateNotas($data){
        return $data['nota_primeira'] >= 0 && $data['nota_segunda'] >= 0 && $data['nota_terceira'] >= 0;
    }

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $notas = Nota::orderBy('id','desc')->paginate();
        return view('pages.notas', ["panel"=>"notas","notas"=>$notas]);
    }


    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.nota', ["panel"=>"notas","action"=>route('notas.store')]);
    }


    public function store(NotaRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            $request->validate(["curso_id"=>"required", "disciplina_id"=>"required"]);
            if(!$this->validateNotas($request->all())){
                MessageToastrUtil::error("Conflitos as notas não podem ter valores negativos");
                return redirect()->back();
            }
            DB::transaction(function () use ($request) {
                $cursoDisciplina = CursoDisciplina::where([
                    "curso_id"=>$request->curso_id, "disciplina_id"=>$request->disciplina_id
                ])->first();
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $data['curso_disciplina_id'] = $cursoDisciplina->id;
                $data['nota_final'] = ($data['nota_primeira']+$data['nota_segunda']+$data['nota_terceira'])/3;
                Nota::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('notas.index');
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $nota = Nota::find($id);
        return view('form.nota', ["panel"=>"notas","nota"=>$nota,"action"=>route('notas.update',$id)]);
    }

    public function update(NotaRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            if(!$this->validateNotas($request->all())){
                MessageToastrUtil::error("Conflitos as notas não podem ter valores negativos");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $data['nota_final'] = ($data['nota_primeira']+$data['nota_segunda']+$data['nota_terceira'])/3;
                $nota = Nota::find($id);
                $nota->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('notas.index');
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
                $nota = Nota::find($id);
                $nota->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

}
