<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilizadorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilizadorController extends Controller
{
    public function index(){
        $utilizadores = User::paginate();
        return view('pages.utilizador', ["panel"=>"utilizadores","utilizadores"=>$utilizadores]);
    }

    public function store(UtilizadorRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
               User::create($request->all());
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->route('utilizadores.index');
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->route('utilizadores.index');
        }
    }

    public function update(UtilizadorRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $utlizador = User::find($id);
                $utlizador->update($request->all());
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('utilizadores.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('utilizadores.index');
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $utlizador = User::find($id);
                $utlizador->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('utilizadores.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->route('utilizadores.index');
        }
    }

}
