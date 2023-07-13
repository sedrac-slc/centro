<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilizadorController extends Controller
{
    public function index(){


    }

    public function update(Request $request, $id)
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

    public function destroy(Request $request, $id)
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
