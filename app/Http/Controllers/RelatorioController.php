<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Retirada;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{

    public function renderPdf(Request $request){
        $request->validate([
            "tipo_impressao"=>"required",
            "periodo"=>"required",
            "value"=>"required"
        ]);
        $retiradas = Retirada::with('medicamento','items')->orderBy('id','desc');
        switch($request->periodo){
            case "diario":
                $retiradas->where(DB::raw('date(created_at)'),$request->value);
            break;
            case "mensal":
                $params = explode("-",$request->value);
                $retiradas->where(DB::raw('year(created_at)'), trim($params[0]))
                          ->where(DB::raw('month(created_at)'), trim($params[1]));
            break;
            case "anual":
                $retiradas->where(DB::raw('year(created_at)'),$request->value);
            break;
        }
        $pdf = Pdf::loadView('pages.relatorio',[
            "retiradas"=>$retiradas->get(),
            "value"=>$request->value,
            "periodo"=>$request->periodo,
            "tipo_impressao"=>$request->tipo_impressao,
        ]);
        return $pdf->stream('retirada.pdf');
    }

}
