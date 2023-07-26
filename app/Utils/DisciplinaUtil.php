<?php

namespace App\Utils;

class DisciplinaUtil{


    public static function generatorFaker($user = null){
        return [
            'nome' => fake()->name(),
            'descricao' => fake()->text(),
            'created_by' => $user->id ?? null,
            'updated_by' => $user->id ?? null
        ];

    }

}
