<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilizadorRequest;
use App\Models\User;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilizadorController extends Controller
{
    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $utilizadores = User::orderBy('id','desc')->paginate();
        return view('pages.utilizador', ["panel"=>"utilizadores","utilizadores"=>$utilizadores]);
    }

    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.utilizador', ["panel"=>"utilizadores","action"=>route('utilizadores.store')]);
    }

    public function store(UtilizadorRequest $request){
        $request->validate([
            "tipo" => "required",
            "password" => "required",
            "password_confirmation" => "required"
        ]);
        if(!UserUtil::isAdministrador()) return redirect()->back();
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
            MessageToastrUtil::success();
            return redirect()->route('utilizadores.index');
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $user = User::find($id);
        return view('form.utilizador', ["panel"=>"utilizadores","user"=>$user,"action"=>route('utilizadores.update',$id)]);
    }

    public function update(UtilizadorRequest $request, $id){
        $request->validate(["tipo" => "required"]);
        if(!UserUtil::isAdministrador()) return redirect()->back();
        try {
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $utilizador = User::find($id);
                $utilizador->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('utilizadores.index');
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function destroy($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        try {
            DB::transaction(function () use ($id) {
                $utilizador = User::find($id);
                $utilizador->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

}
