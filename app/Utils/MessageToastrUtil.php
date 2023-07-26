<?php

namespace App\Utils;

class MessageToastrUtil{

    static function error(){
        toastr()->error("Não possível a realização desta acção", "Erro");
    }

    static function warning(){
        toastr()->warning("Não foi possível válidar a acção", "Aviso");
    }

    static function success(){
        toastr()->success("A acção foi executada com successo", "Successo");
    }

}
