<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicamentoRequest;
use App\Models\Medicamento;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicamentoController extends Controller
{
    public function index(){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        $medicamentos = Medicamento::orderBy('id','desc')->paginate();
        return view('pages.medicamento', ["panel"=>"medicamentos","medicamentos"=>$medicamentos]);
    }


    public function store(MedicamentoRequest $request)
    {
        try {
            if(!UserUtil::isFarmaceutico()){
                toastr()->warning("Não tens permissão", "Permissão");
                return redirect()->back();
            }
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Medicamento::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->back();
        }
    }

    public function update(MedicamentoRequest $request, $id)
    {
        try {
            if(!UserUtil::isFarmaceutico()){
                toastr()->warning("Não tens permissão", "Permissão");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $medicamento = Medicamento::find($id);
                $medicamento->update($data);
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
            if(!UserUtil::isFarmaceutico()){
                toastr()->warning("Não tens permissão", "Permissão");
                return redirect()->back();
            }
            DB::transaction(function () use ($id) {
                $medicamento = Medicamento::find($id);
                $medicamento->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function json(Request $request){
        if(!UserUtil::isFarmaceutico() || !isset($request->search)) return [];
        return Medicamento::with('items')
                        ->where('nome','like',"%{$request->search}%")
                        ->select('id','nome')
                        ->get();
    }

}
