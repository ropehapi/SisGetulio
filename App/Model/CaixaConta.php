<?php

namespace App\Model;

use App\Config\Conexao;
use PDO;
use PDOStatement;

class CaixaConta{
    private $banco;
    private $agencia;
    private $numero;
    private $saldo;

    public function InserirConta(){
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_caixa_conta (banco,agencia,numero,saldo) values(:banco, :agencia, :numero, :saldo)";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':banco',$this->banco);
        $sql->bindParam(':agencia',$this->agencia);
        $sql->bindParam(':numero',$this->numero);
        $sql->bindParam(':saldo',$this->saldo);

        try {
            $sql->execute();
            return 1;
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            die;
            return -1;
        }
    }

    public function DevolverContas(){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_caixa_conta";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ExcluirConta($idConta){
        $conexao = Conexao::retornaConexao();
        $comando = "DELETE FROM tb_caixa_conta WHERE id_conta = :id_conta";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_conta',$idConta);

        try {
            $sql->execute();
            return 4;
        } catch (\Throwable $th) {
            echo '<hr>';
            echo '<hr>';
            echo '<hr>';
            echo $th->getMessage();
            //return -1;
        }
    }

    public function TraduzirConta($id){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT nome FROM tb_caixa_conta WHERE id_conta = :id_conta";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_conta',$id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DetalharConta($id)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_caixa_conta WHERE id_conta = :id_conta";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_conta', $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AlterarConta($idConta)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "UPDATE tb_caixa_conta SET banco = :banco,
                                              agencia = :agencia,
                                              numero = :numero,
                                              saldo = :saldo
                                    WHERE id_conta = :id_conta";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':banco',$this->banco);
        $sql->bindParam(':agencia',$this->agencia);
        $sql->bindParam(':numero',$this->numero);
        $sql->bindParam(':saldo',$this->saldo);
        $sql->bindParam(':id_conta',$idConta);

        try {
            $sql->execute();
            return 2;
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            die;
            return -1;
        }
    }

    public function getBanco()
    {
        return $this->banco;
    }

    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    public function getAgencia()
    {
        return $this->agencia;
    } 

    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;

        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }
}