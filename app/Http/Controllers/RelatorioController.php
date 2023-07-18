<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Retirada;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    public function renderPdf(Request $request){
        $request->validate([
            "tipo_impressao"=>"required",
            "periodo"=>"required",
            "value"=>"required"
        ]);
        $retiradas = Retirada::with('medicamento','items')->orderBy('id','desc')->get();
        $pdf = Pdf::loadView('pages.relatorio',[
            "retiradas"=>$retiradas,
            "value"=>$request->value,
            "periodo"=>$request->periodo,
            "tipo_impressao"=>$request->tipo_impressao,
        ]);
        return $pdf->stream('retirada1.pdf');
    }

}
