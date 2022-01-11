<?php

namespace App\Model;

use App\Config\Conexao;
use PDO;
use PDOStatement;

class FolhaPagamento
{
    private $janeiro;
    private $fevereiro;
    private $marco;
    private $abril;
    private $maio;
    private $junho;
    private $julho;
    private $agosto;
    private $setembro;
    private $outubro;
    private $novembro;
    private $dezembro;
    private $ano;

    public function consultarFolhaPagamento($id,$ano)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_folha_pagamento WHERE id_membro = :id_membro AND ano = :ano";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_membro', $id);
        $sql->bindParam(':ano', $ano);

        try {
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return -1;
        }
    }

    public function salvarFolhaPagamento($idMembro)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "UPDATE tb_folha_pagamento SET janeiro = :janeiro,
                                                  fevereiro = :fevereiro,
                                                  marco = :marco,
                                                  abril = :abril,
                                                  maio = :maio,
                                                  junho = :junho,
                                                  julho = :julho,
                                                  agosto = :agosto,
                                                  setembro = :setembro,
                                                  outubro = :outubro,
                                                  novembro = :novembro,
                                                  dezembro = :dezembro
                                            WHERE id_membro = :id_membro
                                              AND ano = :ano";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':janeiro',$this->janeiro);
        $sql->bindParam(':fevereiro',$this->fevereiro);
        $sql->bindParam(':marco',$this->marco);
        $sql->bindParam(':abril',$this->abril);
        $sql->bindParam(':maio',$this->maio);
        $sql->bindParam(':junho',$this->junho);
        $sql->bindParam(':julho',$this->julho);
        $sql->bindParam(':agosto',$this->agosto);
        $sql->bindParam(':setembro',$this->setembro);
        $sql->bindParam(':outubro',$this->outubro);
        $sql->bindParam(':novembro',$this->novembro);
        $sql->bindParam(':dezembro',$this->dezembro);
        $sql->bindParam(':id_membro',$idMembro);
        $sql->bindParam(':ano',$this->ano);

        try {
            $sql->execute();
            return 5;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return -1;
        }
    }

    /**
     * Get the value of janeiro
     */
    public function getJaneiro()
    {
        return $this->janeiro;
    }

    /**
     * Set the value of janeiro
     *
     * @return  self
     */
    public function setJaneiro($janeiro)
    {
        $this->janeiro = $janeiro;

        return $this;
    }

    /**
     * Get the value of fevereiro
     */
    public function getFevereiro()
    {
        return $this->fevereiro;
    }

    /**
     * Set the value of fevereiro
     *
     * @return  self
     */
    public function setFevereiro($fevereiro)
    {
        $this->fevereiro = $fevereiro;

        return $this;
    }

    /**
     * Get the value of marco
     */
    public function getMarco()
    {
        return $this->marco;
    }

    /**
     * Set the value of marco
     *
     * @return  self
     */
    public function setMarco($marco)
    {
        $this->marco = $marco;

        return $this;
    }

    /**
     * Get the value of abril
     */
    public function getAbril()
    {
        return $this->abril;
    }

    /**
     * Set the value of abril
     *
     * @return  self
     */
    public function setAbril($abril)
    {
        $this->abril = $abril;

        return $this;
    }

    /**
     * Get the value of maio
     */
    public function getMaio()
    {
        return $this->maio;
    }

    /**
     * Set the value of maio
     *
     * @return  self
     */
    public function setMaio($maio)
    {
        $this->maio = $maio;

        return $this;
    }

    /**
     * Get the value of junho
     */
    public function getJunho()
    {
        return $this->junho;
    }

    /**
     * Set the value of junho
     *
     * @return  self
     */
    public function setJunho($junho)
    {
        $this->junho = $junho;

        return $this;
    }

    /**
     * Get the value of julho
     */
    public function getJulho()
    {
        return $this->julho;
    }

    /**
     * Set the value of julho
     *
     * @return  self
     */
    public function setJulho($julho)
    {
        $this->julho = $julho;

        return $this;
    }

    /**
     * Get the value of agosto
     */
    public function getAgosto()
    {
        return $this->agosto;
    }

    /**
     * Set the value of agosto
     *
     * @return  self
     */
    public function setAgosto($agosto)
    {
        $this->agosto = $agosto;

        return $this;
    }

    /**
     * Get the value of setembro
     */
    public function getSetembro()
    {
        return $this->setembro;
    }

    /**
     * Set the value of setembro
     *
     * @return  self
     */
    public function setSetembro($setembro)
    {
        $this->setembro = $setembro;

        return $this;
    }

    /**
     * Get the value of outubro
     */
    public function getOutubro()
    {
        return $this->outubro;
    }

    /**
     * Set the value of outubro
     *
     * @return  self
     */
    public function setOutubro($outubro)
    {
        $this->outubro = $outubro;

        return $this;
    }

    /**
     * Get the value of novembro
     */
    public function getNovembro()
    {
        return $this->novembro;
    }

    /**
     * Set the value of novembro
     *
     * @return  self
     */
    public function setNovembro($novembro)
    {
        $this->novembro = $novembro;

        return $this;
    }

    /**
     * Get the value of dezembro
     */
    public function getDezembro()
    {
        return $this->dezembro;
    }

    /**
     * Set the value of dezembro
     *
     * @return  self
     */
    public function setDezembro($dezembro)
    {
        $this->dezembro = $dezembro;

        return $this;
    }

    /**
     * Get the value of ano
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set the value of ano
     *
     * @return  self
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }
}
