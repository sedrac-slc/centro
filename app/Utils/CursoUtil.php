<?php

namespace App\Utils;

class CursoUtil{


    public static function generatorFaker($user = null){
        return [
            'nome' => fake()->name(),
            'descricao' => fake()->text(),
            'preco' => fake()->randomFloat(null,10000,85000),
            'data_inicio' => fake()->date(),
            'data_termino'=> fake()->date(),
            'hora_entrada'=> fake()->time(),
            'hora_termino'=> fake()->time(),
            'sala' => fake()->randomDigitNotZero(),
            'created_by' => $user->id ?? null,
            'updated_by' => $user->id ?? null
        ];

    }

}
