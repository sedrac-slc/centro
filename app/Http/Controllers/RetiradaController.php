<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetiradaRequest;
use App\Models\Retirada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetiradaController extends Controller
{

    public function index(){
        $retiradas = Retirada::paginate();
        return view('pages.retirada', ["panel"=>"retiradas","retiradas"=>$retiradas]);
    }


    public function store(RetiradaRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Retirada::create($request->all());
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->route('retiradas.index');
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->route('retiradas.index');
        }
    }

    public function update(RetiradaRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $retirada = Retirada::find($id);
                $retirada->update($request->all());
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
                $retirada = Retirada::find($id);
                $retirada->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

}
