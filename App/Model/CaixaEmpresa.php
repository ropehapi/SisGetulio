<?php

namespace App\Model;

use App\Config\Conexao;
use PDO;
use PDOStatement;

class CaixaEmpresa{
    private $nome;

    public function InserirEmpresa(){
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_caixa_empresa (nome) values(:nome)";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome',$this->nome);

        try {
            $sql->execute();
            return 1;
        } catch (\Throwable $th) {
            return -1;
        }
    }

    public function DevolverEmpresas(){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_caixa_empresa";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ExcluirEmpresa($idCategory){
        $conexao = Conexao::retornaConexao();
        $comando = "DELETE FROM tb_caixa_empresa WHERE id_empresa = :id_empresa";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_empresa',$idCategory);

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

    public function TraduzirEmpresa($id){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT nome FROM tb_caixa_empresa WHERE id_empresa = :id_empresa";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_empresa',$id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}