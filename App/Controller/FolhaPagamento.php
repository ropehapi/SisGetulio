<?php
namespace App\Controller;

use App\Model\FolhaPagamento as ModelFolhaPagamento;

class FolhaPagamento{
    public function salvarFolhaPagamento($post){
        $dao = new ModelFolhaPagamento;

        isset($post['janeiro'])?$dao->setJaneiro(1):$dao->setJaneiro(0);
        isset($post['fevereiro'])?$dao->setFevereiro(1):$dao->setFevereiro(0);
        isset($post['marco'])?$dao->setMarco(1):$dao->setMarco(0);
        isset($post['abril'])?$dao->setAbril(1):$dao->setAbril(0);
        isset($post['maio'])?$dao->setMaio(1):$dao->setMaio(0);
        isset($post['junho'])?$dao->setJunho(1):$dao->setJunho(0);
        isset($post['julho'])?$dao->setJulho(1):$dao->setJulho(0);
        isset($post['agosto'])?$dao->setAgosto(1):$dao->setAgosto(0);
        isset($post['setembro'])?$dao->setSetembro(1):$dao->setSetembro(0);
        isset($post['outubro'])?$dao->setOutubro(1):$dao->setOutubro(0);
        isset($post['novembro'])?$dao->setNovembro(1):$dao->setNovembro(0);
        isset($post['dezembro'])?$dao->setDezembro(1):$dao->setDezembro(0);
        $dao->setAno($post['ano']);

        return $dao->salvarFolhaPagamento($post['id_membro']);
    }
}