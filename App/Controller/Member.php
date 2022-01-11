<?php 

namespace App\Controller;

use App\Model\Member as ModelMember;

class Member{
    public function InserirMembro($post){
        $dao = new ModelMember;

        $dao->setNome($post['nome']);
        $dao->setEmail($post['email']);
        $dao->setTelefone($post['telefone']);
        $dao->setEndereco($post['endereco']);
        $dao->setStatus($post['status']);

        return $dao->InserirMembro();
    }

    public function AlterarMembro($post,$idMember){
        $dao = new ModelMember;

        $dao->setNome($post['nome']);
        $dao->setEmail($post['email']);
        $dao->setTelefone($post['telefone']);
        $dao->setEndereco($post['endereco']);
        $dao->setStatus($post['status']);

        return $dao->AlterarMembro($idMember);
    }
}