<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Utils\MessageToastrUtil;
use Illuminate\Http\Request;
use App\Models\Inscricao;
use App\Utils\UserUtil;
use App\Models\Curso;
use App\Models\Aluno;
use App\Models\User;
use DB;

class InscricaoController extends Controller
{
    public function index_public(){
        $cursos = Curso::where('hora_termino','>=', now()->format('Y-md-d'))->orderBy('id','desc')->paginate();
        return view('inscricao', ["panel"=>"cursos","cursos"=>$cursos]);
    }

    public function store_public(Request $request){
        $request->validate([
            'curso' => 'required', 'email' => 'required', 'phone' => 'required', 'name' => 'required',
            'birthday' => 'required', 'gender' => 'required'
        ]);

        if(Inscricao::where(['curso_id' => $request->curso, "email" => $request->email ])->exists()){
            MessageToastrUtil::error("Já foi realizado uma inscrição neste curso por este email");
            return redirect()->back();
        }

        Inscricao::create([
            'curso_id' => $request->curso, "email" => $request->email, 'phone' => $request->phone,
            'nome' => $request->name, 'birthday' => $request->birthday, 'gender' => $request->gender
         ]);
        MessageToastrUtil::success("A inscrição foi realizada com successo");
        return redirect()->back();
    }

    public function index(){
        $inscricoes = Inscricao::orderBy('id','desc')->paginate();
        return view('pages.inscricao', ["panel"=>"inscricoes","inscricoes"=>$inscricoes]);
    }

    public function delete($id){
        try {
            $inscricao = Inscricao::find($id);
            $inscricao->delete();
            MessageToastrUtil::success();
        } catch (\Exception) {
            MessageToastrUtil::error();
        }
        return redirect()->back();
    }

    public function confirm(Request $request){
        $request->validate(['inscricao' => 'required', 'password' => 'required', 'confirm' => 'required']);

        if($request->password != $request->confirm){
            MessageToastrUtil::error("Confirma novamente a senha");
            return redirect()->back();
        }

        $inscricao = Inscricao::find($request->inscricao);
        $user = User::where('email', $inscricao->email)->first();

        if(!isset($user->id)){
            DB::transaction(function () use ($inscricao, $request) {
                $user = User::create([
                    'tipo' => 'ALUNO',
                    'name' => $inscricao->nome,
                    'email' => $inscricao->email,
                    'phone' => $inscricao->phone,
                    'gender' => $inscricao->gender,
                    'birthday' => $inscricao->birthday,
                    'password' => bcrypt($request->confirm),
                ]);
                Aluno::create(["user_id" => $user->id, "curso_id" => $inscricao->curso_id ]);
                $inscricao->delete();
            });

            MessageToastrUtil::success("A Confirmação da inscrição foi realizada com successo");
            return redirect()->back();
        }else{
            if(!Aluno::where(["user_id" => $user->id, "curso_id" => $inscricao->curso_id ])->exists()){
                Aluno::create(["user_id" => $user->id, "curso_id" => $inscricao->curso_id ]);
                $inscricao->delete();
                MessageToastrUtil::success("A Confirmação da inscrição foi realizada com successo");
                return redirect()->back();
            }else{
                MessageToastrUtil::warning("Já foi realiza a confirmação da inscrição");
                return redirect()->back();
            }
        }
    }

}
