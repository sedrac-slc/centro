<?php

use App\Models\Aluno;
use App\Models\Professor;

if(!function_exists('short_name')){
    function short_name(String $name){
        $names = explode(" ",$name);
        $tam = sizeof($names);
        $short = strtoupper($names[0][0]).".".$names[$tam-1];
        return $short;
    }
}

if(!function_exists('count_aluno')){
    function count_aluno($user_id){
        return Aluno::where('user_id',$user_id)->count();
    }
}

if(!function_exists('count_professor')){
    function count_professor($user_id){
        return Professor::where('user_id',$user_id)->count();
    }
}
