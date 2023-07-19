<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetiradaRequest;
use App\Models\Item;
use App\Models\ItemRetirada;
use App\Models\Medicamento;
use App\Models\Retirada;
use App\Utils\UserUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RetiradaController extends Controller
{

    public function index()
    {
        $retiradas = Retirada::orderBy('id', 'desc')->paginate();
        return view('pages.retirada', ["panel" => "retiradas", "retiradas" => $retiradas]);
    }

    public function medicamento($id)
    {
        $retiradas = Retirada::where('medicamento_id',$id)->orderBy('id', 'desc')->paginate();
        return view('pages.retirada', ["panel" => "retiradas", "retiradas" => $retiradas, "back" => route('medicamentos.index')]);
    }

    public function store(RetiradaRequest $request)
    {
        try {
            if (!UserUtil::isFarmaceutico()) {
                toastr()->warning("Não tens permissão", "Permissão");
                return redirect()->back();
            }

            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['user_id'] = Auth::user()->id;
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;

                $medicamento = Medicamento::with(['items' => function ($q) use ($data) {
                    $q->where('data_validade', '>', Carbon::now());
                    $q->limit($data['quantidade_desejada']);
                }])->find($data['medicamento_id']);

                $quantidade_inicial = Item::where('medicamento_id',$medicamento->id)->count();
                $quantidade_stock = $quantidade_inicial >  $data['quantidade_desejada'] ? $quantidade_inicial - $data['quantidade_desejada'] : 0;

                $data['medicamento_id'] = $medicamento->id;
                $data['quantidade_inicial'] = $quantidade_inicial;
                $data['quantidade_retirada'] = $data['quantidade_desejada'];
                $data['quantidade_stock'] = $quantidade_stock;

                if (sizeof($medicamento->items) > 0 && $quantidade_inicial > 0) {
                    $retirada = Retirada::create($data);
                    $data['retirada_id'] = $retirada->id;
                    foreach ($medicamento->items as $item) {
                        $data['codigo'] = $item->codigo;
                        $data['data_validade'] = $item->data_validade;
                        ItemRetirada::create($data);
                        $item->delete();
                    }
                  toastr()->success("Operação de criação realizada com sucesso", "Successo");
                }else{
                  toastr()->warning("Não foi encontrado nenhum item com válidade para ser retirado", "Aviso");
                }
            });
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->back();
        }
    }

    public function items($id){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        $items = ItemRetirada::where('retirada_id',$id)->orderBy('id','desc')->paginate();
        return view('pages.item_retirados', ["panel"=>"items","items"=>$items]);
    }


}
