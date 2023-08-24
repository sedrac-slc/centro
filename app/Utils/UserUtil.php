<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserUtil{

    public static function isAdministrador($alert = true){
        if(Auth::user()->tipo != 'ADMINISTRADOR' && $alert){
            toastr()->error("Permissão negada apenas os administradores tenhem permissão", "Aviso");
            return false;
        }
        return true;
    }

    public static function isProfessor($alert = true){
        if(Auth::user()->tipo != 'PROFESSOR' && $alert){
            toastr()->error("Permissão negada apenas os professores tenhem permissão", "Aviso");
            return false;
        }
        return true;
    }

    public static function isAluno($alert = true){
        if(Auth::user()->tipo != 'ALUNO' && $alert){
            toastr()->error("Permissão negada apenas os alunos tenhem permissão", "Aviso");
            return false;
        }
        return true;
    }

    public static function genders(){
        return ['MALE' => 'Masculino','FEMALE' => 'Femenino'];
    }

    public static function tipos(){
        return ['PROFESSOR' => 'Professor','ALUNO' => 'Alunos','ADMINISTRADOR' => 'Administrador'];
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

    public static function generatorFaker($tipo=null){
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
            'tipo' => $tipo ?? $tipos[$indexTipo],
            'birthday' => fake()->date(),
            'password' => Hash::make("password")
        ];

    }

}
