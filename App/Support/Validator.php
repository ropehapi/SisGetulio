<?php

namespace App\Support;

use App\Controller\User;

class Validator
{
    public static function ValidaCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/is', '', $cnpj);
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += (int)$cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += (int)$cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public static function ValidaEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function ValidaCEP($cep)
    {
        if (!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep)) {
            return false;
        } else {
            return true;
        }
    }

    public static function ValidaCelular($celular)
    {
        if (preg_match("/\(?\d{2}\)?\s?\d{5}\-?\d{4}/", $celular)) {
            return true;
        } else {
            return false;
        }
    }

    public static function ValidaCPF($cpf)
    {
        if (!preg_match("^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$", $cpf)) {
            return false;
        } else {
            return true;
        }
    }

    public static function ConfereSenhas($senha,$rSenha){
        if($senha==$rSenha){
            return true; 
        }else{
            return false;
        }
    }

    public static function ConfereEmail($email){
        $ctrl = new User;
        return $ctrl->ConfereEmail($email);
    }
}