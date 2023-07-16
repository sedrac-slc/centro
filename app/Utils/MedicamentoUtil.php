<?php

namespace App\Utils;

class MedicamentoUtil{

    public static function generatorFaker($user){
        return [
            'nome' => fake()->unique()->name(),
            'descricao' => fake()->realText(),
            'quantidade_minino_stock' => fake()->randomNumber(),
            'created_by' => $user->id,
            'updated_by' => $user->id
        ];
    }

}
