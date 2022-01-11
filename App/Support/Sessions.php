<?php

namespace App\Support;

class Sessions
{
    public static function IniciarSessao()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function CriarSessao($id)
    {
        self::IniciarSessao();
        $_SESSION['id_usuario'] = $id;
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    public static function Deslogar()
    {
        self::IniciarSessao();

        unset($_SESSION['id_usuario']);

        self::VoltarPaginaLogin();
    }

    public static function VerificarLogado()
    {
        if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] == '') {
            self::VoltarPaginaLogin();
        }
    }

    public static function VerificarAtividade(){
        //Verifica se a sessão está setada e se há atividade a pelo menos 30 min
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_unset();
            session_destroy();
            self::VoltarPaginaLogin();
        }
    }

    public static function RegistrarAtividade(){
        self::IniciarSessao();
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    }

    public static function VoltarPaginaLogin()
    {
        header('location: http://localhost/SoftwareDM/App/View/Auth/login.php');
        exit;
    }

    public static function CodigoUserLogado()
    {
        self::IniciarSessao();
        return $_SESSION['id_usuario'];
    }
}