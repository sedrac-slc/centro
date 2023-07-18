<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilizadorRequest;
use App\Models\User;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilizadorController extends Controller
{
    public function index(){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        $utilizadores = User::orderBy('id','desc')->paginate();
        return view('pages.utilizador', ["panel"=>"utilizadores","utilizadores"=>$utilizadores]);
    }

    public function store(UtilizadorRequest $request){
        $request->validate([
            "tipo" => "required",
            "password" => "required",
            "password_confirmation" => "required"
        ]);
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        if($request->password != $request->password_confirmation){
            toastr()->warning("As senhas são diferntes", "Aviso");
            return redirect()->back();
        }
        try {
            DB::transaction(function () use ($request) {
               $data = $request->all();
               $data['created_by'] = Auth::user()->id;
               $data['updated_by'] = Auth::user()->id;
               $data['password'] = Hash::make($data['password']);
               User::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->back();
        }
    }

    public function update(UtilizadorRequest $request, $id){
        $request->validate(["tipo" => "required"]);
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        try {
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $utilizador = User::find($id);
                $utilizador->update($data);
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function destroy($id){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        try {
            DB::transaction(function () use ($id) {
                $utilizador = User::find($id);
                $utilizador->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function search(Request $request){
        $request->validate(["field" => "required", "search" => "required"]);
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        $utilizadores = User::orderBy('id','desc');
        switch($request->field){
            case "name":
            case "email":
            case "phone":
            case "tipo":
            case "birthday":
                    $utilizadores->where($request->field,'like',"%{$request->search}%");
                break;
            case "gender":
                    $utilizadores->where($request->field,$request->search);
                break;
        }
        $utilizadores = $utilizadores->paginate();
        return view('pages.utilizador', ["panel"=>"utilizadores", "utilizadores"=>$utilizadores, "search" => true]);
    }

}
