<?php

namespace App\Utils;

class MedicamentoUtil{

    public static function generatorFaker($user){
        return [
            'nome' => fake()->unique()->name(),
            'user_id' => $user->id,
            'descricao' => fake()->realText(),
            'quantidade_stock' => fake()->random_int(),
            'quantidade_minino_stock' => fake()->random_int(),
            'data_validade' => fake()->date(),
            'created_by' => $user->id,
            'updated_by' => $user->id
        ];
    }

}
