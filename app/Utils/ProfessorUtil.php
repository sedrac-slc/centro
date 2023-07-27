<?php

namespace App\Utils;

class ProfessorUtil{


    public static function generatorFaker($user, $curso, $admin = null){
        return [
            'user_id' => $user->id,
            'curso_disciplina_id' => $curso->id,
            'created_by' => $admin->id ?? null,
            'updated_by' => $admin->id ?? null
        ];

    }

}
