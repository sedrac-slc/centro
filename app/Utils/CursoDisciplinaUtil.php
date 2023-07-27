<?php

namespace App\Utils;

class CursoDisciplinaUtil{


    public static function generatorFaker($curso, $disciplina, $user = null){
        return [
            'curso_id' => $curso->id,
            'disciplina_id' => $disciplina->id,
            'created_by' => $user->id ?? null,
            'updated_by' => $user->id ?? null
        ];

    }

}
