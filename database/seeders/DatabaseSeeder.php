<?php

namespace Database\Seeders;

use App\Models\Medicamento;
use App\Models\Retirada;
use App\Models\User;
use App\Utils\MedicamentoUtil;
use App\Utils\UserUtil;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $tam = 15;
        $users = [];
        for($i=0; $i < $tam; $i++){
            $users[] = User::create(UserUtil::generatorFaker());
        }

        $farmaceuticos = [];
        for($i=0; $i < $tam; $i++){
            if($users[$i]->tipo == "FARMACEUTICO"){
                $farmaceuticos[] = $users[$i];
            }
        }

        $medicamentos = [];
        $tam_fuc = sizeof($farmaceuticos);
        for($i=0; $i < $tam; $i++){
            $index = rand(0, $tam_fuc);
            $medicamentos[] = Medicamento::create(MedicamentoUtil::generatorFaker($farmaceuticos[$index]));
        }

        while($tam > 0){

            $index_medicamento = rand(0, $tam);
            $index_farmaceutico = rand(0, $tam_fuc);
            $medicamento = $medicamentos[$index_medicamento];
            $farmaceutico = $farmaceuticos[$index_farmaceutico];
            $quantidade_retirada = rand(0,$medicamento->stock);

            if($quantidade_retirada < $medicamento->stock){
                $quantidade_inicial = $medicamento->stock;
                $quantidade_stock = $quantidade_inicial - $quantidade_retirada;
                $medicamento->stock = $quantidade_stock;
                if($medicamento->stock != $quantidade_inicial){
                    $medicamento->update($medicamento->all());
                    Retirada::create((object)[
                        'user_id' => $farmaceutico->user_id,
                        'medicamento_id' => $medicamento->id,
                        'quantidade_inicial' => $quantidade_inicial,
                        'quantidade_retirada' => $quantidade_retirada,
                        'quantidade_stock' => $medicamento->stock,
                        'created_by' => $farmaceutico->user_id,
                        'updated_by' => $farmaceutico->user_id
                    ]);
                 $tam--;
                }
            }

        }

    }

}
