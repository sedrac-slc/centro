<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PagamentoRequest;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Pagamento;
use App\Utils\MessageToastrUtil;
use App\Utils\UserUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagamentoController extends Controller
{

    public function index(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $pagamentos = Pagamento::orderBy('id','desc')->paginate();
        return view('pages.pagamento', ["panel"=>"pagamentos","pagamentos"=>$pagamentos]);
    }

    public function create(){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        return view('form.pagamento', ["panel"=>"pagamentos","action"=>route('pagamentos.store')]);
    }

    private function createStore($data,$prestacao,$preco,$aluno,$curso){
        $data['prestacao'] = $prestacao;
        if(($data['totalPago'] ?? 0) + $data['preco'] >= $curso->preco){
            $aluno->update(["is_pago" => true]);
            $data['is_pago_terminado'] = 1;
        }
        if($prestacao > 1){
            $data['troco'] = ($data['totalPago'] ?? 0) + $data['preco'] - $preco;
        }else{
            if($data['preco'] > $preco){
                $data['troco'] = $data['preco'] - $preco;
                $data['is_pago_terminado'] = 1;
            }
        }
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        return Pagamento::create($data);
    }

    public function store(PagamentoRequest $request)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            $aluno = Aluno::find($request->aluno_id);
            $curso = Curso::find($aluno->curso_id);
            $totalPago = array_sum($aluno->pagamentos->map(function($q){return $q->preco;})->all());
            if($totalPago >= $curso->preco){
                MessageToastrUtil::warning("O curso já foi pago na sua totalidade");
                return redirect()->back();
            }
            DB::transaction(function () use ($request,$curso,$aluno,$totalPago) {
                $data = $request->all();
                $data['totalPago'] = $totalPago;
                $pagamento = Pagamento::where('aluno_id',$request->aluno_id)->orderBy('id','DESC')->first();
                if(!isset($pagamento->id)){
                    if($request->preco >= ($curso->preco / 2)){
                        $this->createStore($data,1,$curso->preco,$aluno,$curso);
                        if($request->preco >= $curso->preco){
                            $aluno->update(['is_pago' => true]);
                        }
                    }else{
                        MessageToastrUtil::warning("O valor entrege deve ser a métade do valor do curso como primeira prestação");
                        return redirect()->back();
                    }
                }else{
                    $this->createStore($data,$pagamento->prestacao+1,$curso->preco,$aluno,$curso);
                }
            });
            MessageToastrUtil::success();
            return redirect()->route($request->back ?? 'pagamentos.index');
        } catch (\Exception $e) {
            dd($e);
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function edit($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $pagamento = Pagamento::find($id);
        return view('form.pagamento', ["panel"=>"pagamentos","pagamento"=>$pagamento,"action"=>route('pagamentos.update',$id)]);
    }

    public function update(PagamentoRequest $request, $id)
    {
        try {
            if(!UserUtil::isAdministrador()) return redirect()->back();
            $aluno = Aluno::find($request->aluno_id);
            $curso = Curso::find($aluno->curso_id);
            $totalPago = array_sum($aluno->pagamentos->map(function($q){return $q->preco;})->all());
            if($totalPago >= $curso->preco){
                MessageToastrUtil::warning("O curso já foi pago na sua totalidade");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $totalPago,$aluno, $curso, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $pagamento = Pagamento::find($id);
                $total = $totalPago + $data['preco'] - $pagamento->preco;
                if($total >= $curso->preco){
                    $data['troco'] = $total - $curso->preco;
                    $aluno->update(['is_pago' => true]);
                    $data['is_pago_terminado'] = 1;
                }
                $pagamento->update($data);
            });
            MessageToastrUtil::success();
            return redirect()->route('pagamentos.index');
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
                $pagamento = Pagamento::find($id);
                $pagamento->delete();
            });
            MessageToastrUtil::success();
            return redirect()->back();
        } catch (\Exception) {
            MessageToastrUtil::error();
            return redirect()->back();
        }
    }

    public function pagamento_add($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $aluno = Aluno::find($id);
        return view('form.pagamento', [
            "panel"=>"pagamentos",
            "aluno"=>$aluno,
            "action"=>route('pagamentos.store'),
            "operation"=>"store",
            "back" => 'alunos.index'
        ]);
    }

    public function pagamento_list($id){
        if(!UserUtil::isAdministrador()) return redirect()->back();
        $pagamentos = Pagamento::orderBy('id','desc')->where('aluno_id',$id)->paginate();
        return view('pages.pagamento', ["panel"=>"pagamentos","pagamentos"=>$pagamentos,"back" => route('alunos.index')]);
    }

}
