<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicamentoRequest;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentoController extends Controller
{
    public function index(){
        $medicamentos = Medicamento::paginate();
        return view('pages.medicamento', ["panel"=>"medicamentos","medicamentos"=>$medicamentos]);
    }


    public function store(MedicamentoRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Medicamento::create($request->all());
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->route('medicamentos.index');
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->route('medicamentos.index');
        }
    }

    public function update(MedicamentoRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $medicamento = Medicamento::find($id);
                $medicamento->update($request->all());
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $medicamento = Medicamento::find($id);
                $medicamento->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

}
