<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Medicamento;
use App\Utils\UserUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        $items = Item::orderBy('id','desc')->paginate();
        return view('pages.item', ["panel"=>"items","items"=>$items]);
    }

    public function store(ItemRequest $request){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        try {
            DB::transaction(function () use ($request) {
               $data = $request->all();
               $data['created_by'] = Auth::user()->id;
               $data['updated_by'] = Auth::user()->id;
               Item::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Operação não foi realizada", "Erro");
            return redirect()->back();
        }
    }

    public function update(ItemRequest $request, $id){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        try {
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $item = Item::find($id);
                $item->update($data);
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
                $item = Item::find($id);
                $item->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a eliminação desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function medicamento($id){
        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }
        $medicamento = Medicamento::find($id);
        if(!isset($medicamento->id)){
            toastr()->warning("Medicamento não encontrado", "Aviso");
            return redirect()->back();
        }
        $items = Item::where('medicamento_id', $id)->orderBy('id','desc')->paginate();
        return view('pages.item', ["panel"=>"items","medicamento"=>$medicamento,"items"=>$items]);
    }

    public function search(Request $request){
        $request->validate(["field" => "required", "search" => "required"]);

        if(!UserUtil::isFarmaceutico()){
            toastr()->warning("Não tens permissão", "Permissão");
            return redirect()->back();
        }

        $items = Item::orderBy('id','desc');
        switch($request->field){
            case "codigo":
            case "data_validade":
                    $items->where($request->field,'like',"%{$request->search}%");
                break;
            case "medicamento":
                    $items->join('medicamentos','medicamento_id','medicamentos.id')
                       ->where('medicamentos.nome','like',"%{$request->search}%")
                       ->select("items.*");
                break;
            case "ano_validade":
                    $items->where(DB::raw("year(data_validade)"),$request->search);
                break;
            case "mes_validade":
                    $date =  new \DateTime($request->search);
                    $items->where(DB::raw("month(data_validade)"), $date->format("m"))
                          ->where(DB::raw("year(data_validade)"),$date->format("Y"));
                break;
            case "fora_do_prazo":
                    $items->where('data_validade','<',Carbon::now());
                break;
            case "fora_do_prazo_elim":
                    $items->where('data_validade','<',Carbon::now())->delete();
                break;
        }

        $items = $items->paginate();
        return view('pages.item', ["panel"=>"items","items"=>$items,"search"=>true]);
    }

}
