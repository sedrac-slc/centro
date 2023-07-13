<?php

namespace App\Utils;

class UserUtil{

    public static function genders(){
        return ['MALE' => 'Masculino','FEMALE' => 'Femenino'];
    }

    public static function tipos(){
        return ['MEDICO' => 'Médico','FARMACEUTICO' => 'Farmacêutico'];
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
        $gender = $genders[UserUtil::indexRandom($genders)];

        $tipos = UserUtil::keysTipos();
        $tipo = $genders[UserUtil::indexRandom($tipos)];

        return [
            'name'  => fake()->name($gender),
            'email'  => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'gender' => $genders[$gender],
            'tipo' => $tipos[$tipo],
            'birthday' => fake()->date(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];

    }

}
