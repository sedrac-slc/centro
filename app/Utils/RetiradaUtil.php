<?php

namespace App\Utils;

class RetiradaUtil{

    public static function generatorFaker($medicamento){
        return [
            'user_id' => $medicamento->user_id,
            'medicamento_id' => $medicamento->medicamento_id,
            'quantidade_inicial' => $medicamento->quantidade_inicial,
            'quantidade_retirada' => $medicamento->quantidade_retirada,
            'quantidade_stock' => $medicamento->stock,
            'created_by' => $medicamento->user_id,
            'updated_by' => $medicamento->user_id
        ];
    }

}
