<?php

namespace App\Controller;

use App\Model\Movimento as ModelMovimento;

class Movimento{
    public function inserirMovimento($post){
        $dao = new ModelMovimento;

        $dao->setTipo($post['tipo']);
        $dao->setCategoria($post['categoria']);
        $dao->setData($post['data']);
        $dao->setEmpresa($post['empresa']);
        $dao->setValor($post['valor']);
        $dao->setConta($post['conta']);

        if(isset($post['observacao'])){
            $dao->setObservacao($post['observacao']);
        }

        return $dao->InserirMovimento();
    }   
}