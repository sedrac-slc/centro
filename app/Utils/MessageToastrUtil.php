<?php

namespace App\Utils;

class MessageToastrUtil{

    static function error($msg = "Não possível a realização desta acção"){
        toastr()->error($msg, "Erro");
    }

    static function warning($msg = "Não foi possível válidar a acção"){
        toastr()->warning($msg, "Aviso");
    }

    static function success($msg = "A acção foi executada com successo"){
        toastr()->success($msg, "Successo");
    }

}
