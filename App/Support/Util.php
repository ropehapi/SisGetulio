<?php

namespace App\Support;

class Util
{
    public static function SetarFusoHorario()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public static function getDataHora()
    {
        self::SetarFusoHorario();
        return date('Y-m-d H:i:s');
    }

    public static function RetornaCriptografado($palavra)
    {
        return password_hash($palavra, PASSWORD_DEFAULT);
    }
}