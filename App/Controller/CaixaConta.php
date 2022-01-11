<?php

namespace App\Controller;

use App\Model\CaixaConta as ModelCaixaConta;

class CaixaConta{
    public function AlterarConta($post,$idConta){
        $dao = new ModelCaixaConta;

        $dao->setBanco($post['banco']);
        $dao->setAgencia($post['agencia']);
        $dao->setNumero($post['numero']);
        $dao->setSaldo($post['saldo']);

        return $dao->AlterarConta($idConta);
    }
}
