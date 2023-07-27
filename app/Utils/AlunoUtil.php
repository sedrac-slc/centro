<?php

namespace App\Utils;

class AlunoUtil{


    public static function generatorFaker($user, $curso, $admin = null){
        return [
            'user_id' => $user->id,
            'curso_id' => $curso->id,
            'created_by' => $admin->id ?? null,
            'updated_by' => $admin->id ?? null
        ];

    }

}
