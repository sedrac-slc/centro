<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $alunos = Aluno::with('user')->orderBy('id','desc')->paginate();
        return view('pages.aluno', ["panel"=>"alunos","alunos"=>$alunos]);
    }

    public function store(AlunoRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Aluno::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function update(AlunoRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $aluno = Aluno::find($id);
                $aluno->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->back();
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
                $aluno = Aluno::find($id);
                $aluno->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

}
