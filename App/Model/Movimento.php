<?php

namespace App\Model;

use App\Config\Conexao;
use PDOStatement;

class Movimento{
    private $tipo;
    private $categoria;
    private $data;
    private $empresa;
    private $valor;
    private $conta;
    private $observacao;

    public function InserirMovimento(){
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_movimento (tipo,id_categoria,data_hora_movimento,id_empresa,valor,id_conta,observacao) VALUES (:tipo, :categoria, :data, :empresa, :valor, :conta, :observacao)";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':tipo',$this->tipo);
        $sql->bindParam(':categoria',$this->categoria);
        $sql->bindParam(':data',$this->data);
        $sql->bindParam(':empresa',$this->empresa);
        $sql->bindParam(':valor',$this->valor);
        $sql->bindParam(':conta',$this->conta);
        $sql->bindParam(':observacao',$this->observacao);

        $conexao->beginTransaction();

        try {
            $sql->execute();

            if($this->tipo==0){
                $comando = "UPDATE tb_caixa_conta SET saldo = saldo + :valor WHERE id_conta = :conta ";
            }else{
                $comando = "UPDATE tb_caixa_conta SET saldo = saldo - :valor WHERE id_conta = :conta ";
            }

            $sql = $conexao->prepare($comando);
            $sql->bindParam(':valor', $this->valor);
            $sql->bindParam(':conta', $this->conta);

            $sql->execute();
            $conexao->commit();

            return 1;
        } catch (\Throwable $th) {
            $conexao->rollBack();
            var_dump($th->getMessage());
            die;
            return -1;
        }
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of empresa
     */ 
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set the value of empresa
     *
     * @return  self
     */ 
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of conta
     */ 
    public function getConta()
    {
        return $this->conta;
    }

    /**
     * Set the value of conta
     *
     * @return  self
     */ 
    public function setConta($conta)
    {
        $this->conta = $conta;

        return $this;
    }

    /**
     * Get the value of observacao
     */ 
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set the value of observacao
     *
     * @return  self
     */ 
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }
}