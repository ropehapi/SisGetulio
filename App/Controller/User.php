<?php 

namespace App\Controller;

use App\Model\User as ModelUser;
use App\Support\Sessions;
use App\Support\Util;

class User{
    public function InserirUsuario($post){
        $dao = new ModelUser;

        $dao->setNome($post['nome']);
        $dao->setEmail($post['email']);
        $dao->setSenha(Util::RetornaCriptografado($post['password']));
        $dao->setSecretaria($post['secretaria']);
        $dao->setHospitalaria($post['hospitalaria']);
        $dao->setTesouraria($post['tesouraria']);
        $dao->setControladoria($post['controladoria']);
        $dao->setMateriais($post['materiais']);
        $dao->setStatus($post['status']);
        $dao->setDataHora(Util::getDataHora());

        return $dao->InserirUsuario();
    }

    public function ConfereEmail($email){
        $dao = new ModelUser;

        if(count($dao->ConfereEmail($email))>=1){
            return false;
        }else{
            return true;
        }
    }

    public function ValidarLogin($email, $senha)
    {
        $dao = new ModelUser;
        $user = $dao->ConsultarEmail($email)[0];

        //Verifica se encontrou o usuário
        if (count($user) == 0) {
            return -5;
        }

        $senha_hash = $user['senha'];

        //Verifica se a senha bate
        if (password_verify($senha, $senha_hash)) {

            //Cria a sessão
            Sessions::CriarSessao($user['id_usuario']);
            header('location: http://localhost/SoftwareDM/App/View/index.php');

        } else {
            return -5;
        }
    }

    public function ValidarSenha($senha){
        $dao = new ModelUser;
        $senhaHash = $dao->DetalharUsuario(Sessions::CodigoUserLogado())[0]['senha'];

        if(password_verify($senha, $senhaHash)){
            return true;
        }else{
            return false;
        }

    }

    public function CompararSenhas($senha, $rSenha)
    {
        if ($senha == $rSenha) {
            return true;
        } else {
            return false;
        }
    }

    public function AlterarUsuario($post,$idUser){
        $dao = new ModelUser;

        $dao->setNome($post['nome']);
        $dao->setEmail($post['email']);
        $dao->setSecretaria($post['secretaria']);
        $dao->setHospitalaria($post['hospitalaria']);
        $dao->setTesouraria($post['tesouraria']);
        $dao->setControladoria($post['controladoria']);
        $dao->setMateriais($post['materiais']);
        $dao->setStatus($post['status']);

        return $dao->AlterarUsuario($idUser);
    }

}