<?php

namespace App\Model;

use App\Config\Conexao;
use App\Support\Util;
use PDO;
use PDOStatement;

class Member
{
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $status;

    public function InserirMembro()
    {
        //Cria um membro
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_membro (nome,email,telefone,endereco,status,data_hora_cadastro) VALUES (:nome,:email,:telefone,:endereco,:status,:data_hora_cadastro)";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome',$this->nome);
        $sql->bindParam(':email',$this->email);
        $sql->bindParam(':telefone',$this->telefone);
        $sql->bindParam(':endereco',$this->endereco);
        $sql->bindParam(':status',$this->status);
        $sql->bindParam(':data_hora_cadastro',Util::getDataHora());
        
        try {
            $conexao->beginTransaction();
            $sql->execute();

            //Cria duas folhas de pagamento pro membro
            $id_membro = $conexao->lastInsertId();
            $comando = "INSERT INTO tb_folha_pagamento (id_membro,ano,nome_membro) VALUES (".$id_membro.",'2021','".$this->nome."'),(".$id_membro.",'2022','".$this->nome."'),(".$id_membro.",'2023','".$this->nome."')";
            $sql = $conexao->prepare($comando);
            $sql->execute();

            $conexao->commit();
            return 1;
        } catch (\Throwable $th) {
            echo $th->getMessage();

            $conexao->rollBack();
            return -1;
        }
    }

    public function DevolverMembros(){
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_membro";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ExcluirMembro($idMembro)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "DELETE FROM tb_membro WHERE id_membro = :id_membro";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_membro', $idMembro);
        try {
            $sql->execute();
            return 4;
        } catch (\Throwable $th) {
            return -1;
        }
    }

    public function DetalharMembro($id)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_membro WHERE id_membro = :id_membro";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_membro', $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AlterarMembro($idMember)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "UPDATE tb_membro SET nome = :nome,
                                          email = :email,
                                          telefone = :telefone,
                                          endereco = :endereco,
                                          status = :status
                                    WHERE id_membro = :id_membro";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome',$this->nome);
        $sql->bindParam(':email',$this->email);
        $sql->bindParam(':telefone',$this->telefone);
        $sql->bindParam(':endereco',$this->endereco);
        $sql->bindParam(':status',$this->status);
        $sql->bindParam(':id_membro',$idMember);

        try {
            $sql->execute();
            return 2;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            echo '<hr>';
            echo 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa';
            echo '<hr>';
            echo 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa';
            echo '<hr>';
            echo 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa';
            echo '<hr>';
            echo 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa';
            

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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
