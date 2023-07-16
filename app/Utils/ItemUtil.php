<?php

namespace App\Utils;

class ItemUtil{

    public static function generatorFaker($obj){
        return [
            'codigo' => fake()->unique()->name(),
            'medicamento_id' => $obj->medicamento_id,
            'data_validade' => fake()->date(),
            'created_by' => $obj->user_id,
            'updated_by' => $obj->user_id
        ];
    }

}
