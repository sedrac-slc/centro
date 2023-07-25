<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserUtil{

    public static function isAdministrador(){
        return Auth::user()->tipo == 'ADNIBISTRADOR';
    }

    public static function genders(){
        return ['MALE' => 'Masculino','FEMALE' => 'Femenino'];
    }

    public static function tipos(){
        return ['PROFESSOR' => 'Professor','ALUNO' => 'Alunos','ADNIBISTRADOR' => 'Administrador'];
    }
    public static function keysGenders(){
        return array_keys(UserUtil::genders());
    }

    public static function keysTipos(){
        return array_keys(UserUtil::tipos());
    }

    private static function indexRandom($array){
        return rand(0, sizeof($array) - 1);
    }

    public static function generatorFaker(){
        $genders = UserUtil::keysGenders();
        $indexGender = UserUtil::indexRandom($genders);
        $gender = $genders[$indexGender];

        $tipos = UserUtil::keysTipos();
        $indexTipo = UserUtil::indexRandom($tipos);

        return [
            'name'  => fake()->name($gender),
            'email'  => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'gender' => $genders[$indexGender],
            'tipo' => $tipos[$indexTipo],
            'birthday' => fake()->date(),
            'password' => Hash::make("password")
        ];

    }

}
