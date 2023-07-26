<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorRequest;
use App\Models\Professor;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $professores = Professor::with('user')->orderBy('id','desc')->paginate();
        return view('pages.professor', ["panel"=>"professores","professores"=>$professores]);
    }

    public function store(ProfessorRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Professor::create($data);
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function update(ProfessorRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $professor = Professor::find($id);
                $professor->update($data);
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
                $professor = Professor::find($id);
                $professor->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

}
