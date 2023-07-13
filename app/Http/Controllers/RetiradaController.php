<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetiradaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetiradaController extends Controller
{

    public function index(){


    }

    public function update(RetiradaRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {

            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }

    public function destroy(RetiradaRequest $request, $id)
    {
        try {


            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('servicos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->route('servicos.index');
        }
    }
}
