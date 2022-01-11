<?php

namespace App\Model;

use App\Config\Conexao;
use PDOStatement;

class File
{
    private $nome;
    private $data_hora_arquivo;
    private $data_hora_envio;
    private $id_categoria;
    private $observacao;

    public function InserirArquivo(){
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_arquivo (nome,data_hora_envio,data_hora_arquivo,id_categoria,observacao) values (:nome,:data_hora_envio,:data_hora_arquivo,:id_categoria,:observacao)";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome',$this->nome);
        $sql->bindParam(':data_hora_arquivo',$this->data_hora_arquivo);
        $sql->bindParam(':data_hora_envio',$this->data_hora_envio);
        $sql->bindParam(':id_categoria',$this->id_categoria);
        $sql->bindParam(':observacao',$this->observacao);

        try {
            $sql->execute();
            return 1;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return -1;
        }

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

    public function getData_hora_arquivo()
    {
        return $this->data_hora_arquivo;
    }

    public function setData_hora_arquivo($data_hora_arquivo)
    {
        $this->data_hora_arquivo = $data_hora_arquivo;

        return $this;
    }

    public function getData_hora_envio()
    {
        return $this->data_hora_envio;
    }

    public function setData_hora_envio($data_hora_envio)
    {
        $this->data_hora_envio = $data_hora_envio;

        return $this;
    }

    public function getObservacao()
    {
        return $this->observacao;
    }

    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    public function setId_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }
}
