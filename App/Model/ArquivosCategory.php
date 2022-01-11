<?php

namespace App\Model;

use App\Config\Conexao;
use PDO;
use PDOStatement;

class ArquivosCategory{
    private $nome;

    public function InserirCategoria(){
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_arquivos_categoria (nome) values(:nome)";
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

    public function DevolverCategorias(){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_arquivos_categoria";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ExcluirCategoria($idCategory){
        $conexao = Conexao::retornaConexao();
        $comando = "DELETE FROM tb_arquivos_categoria WHERE id_categoria = :id_categoria";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_categoria',$idCategory);

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

    public function TraduzirCategoria($id){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT nome FROM tb_arquivos_categoria WHERE id_categoria = :id_categoria";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_categoria',$id);
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