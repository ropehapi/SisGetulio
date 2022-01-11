<?php

namespace App\Model;

use App\Config\Conexao;
use App\Support\Util;
use Exception;
use PDO;
use PDOStatement;

class User
{
    private $nome;
    private $email;
    private $senha;
    private $secretaria;
    private $hospitalaria;
    private $tesouraria;
    private $controladoria;
    private $materiais;
    private $status;
    private $dataHora;

    public function InserirUsuario()
    {
        $conexao = Conexao::retornaConexao();
        $comando = "INSERT INTO tb_usuario (nome,email,senha,secretaria,hospitalaria,tesouraria,controladoria,materiais,status,data_hora_cadastro)
                         VALUES (:nome,:email,:senha,:secretaria,:hospitalaria,:tesouraria,:controladoria,:materiais,:status,:data_hora_cadastro)";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome', $this->nome);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':senha', $this->senha);
        $sql->bindParam(':secretaria', $this->secretaria);
        $sql->bindParam(':hospitalaria', $this->hospitalaria);
        $sql->bindParam(':tesouraria', $this->tesouraria);
        $sql->bindParam(':controladoria', $this->controladoria);
        $sql->bindParam(':materiais', $this->materiais);
        $sql->bindParam(':status', $this->status);
        $sql->bindParam(':data_hora_cadastro', $this->dataHora);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function ConfereEmail($email)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_usuario where email = :email";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':email', $email);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function ConsultarEmail($email)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "Select * from tb_usuario where email = :email";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':email', $email);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DevolverUsuarios()
    {
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_usuario";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DetalharUsuario($id)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "SELECT * FROM tb_usuario WHERE id_usuario = :id_usuario";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_usuario', $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AlterarDadosMeuUsuario($id)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "UPDATE tb_usuario SET nome = :nome, email = :email WHERE id_usuario = :id_usuario";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome', $this->nome);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':id_usuario', $id);
        try {
            $sql->execute();
            return 2;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    public function AlterarUsuario($idUser)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "UPDATE tb_usuario SET nome = :nome,
                                          email = :email,
                                          secretaria = :secretaria,
                                          hospitalaria = :hospitalaria,
                                          tesouraria = :tesouraria,
                                          controladoria = :controladoria,
                                          materiais = :materiais,
                                          status = :status
                                    WHERE id_usuario = :id_usuario";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':nome',$this->nome);
        $sql->bindParam(':email',$this->email);
        $sql->bindParam(':secretaria',$this->secretaria);
        $sql->bindParam(':hospitalaria',$this->hospitalaria);
        $sql->bindParam(':tesouraria',$this->tesouraria);
        $sql->bindParam(':controladoria',$this->controladoria);
        $sql->bindParam(':materiais',$this->materiais);
        $sql->bindParam(':status',$this->status);
        $sql->bindParam(':id_usuario',$idUser);

        try {
            $sql->execute();
            return 2;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return -1;
        }
    }

    public function AlterarSenha($id)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "UPDATE tb_usuario SET senha = :senha WHERE id_usuario = :id_usuario";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':senha', $this->senha);
        $sql->bindParam(':id_usuario', $id);

        try {
            $sql->execute();
            return 3;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return -1;
        }
    }

    public function ExcluirUsuario($idUsuario)
    {
        $conexao = Conexao::retornaConexao();
        $comando = "DELETE FROM tb_usuario WHERE id_usuario = :id_usuario";
        $sql = new PDOStatement;
        $sql = $conexao->prepare($comando);
        $sql->bindParam(':id_usuario', $idUsuario);
        try {
            $sql->execute();
            return 4;
        } catch (\Throwable $th) {
            return -1;
        }
    }

    public function getControladoria()
    {
        return $this->controladoria;
    }

    public function setControladoria($controladoria)
    {
        $this->controladoria = $controladoria;

        return $this;
    }

    public function getMateriais()
    {
        return $this->materiais;
    }

    public function setMateriais($materiais)
    {
        $this->materiais = $materiais;

        return $this;
    }

    public function getTesouraria()
    {
        return $this->tesouraria;
    }

    public function setTesouraria($tesouraria)
    {
        $this->tesouraria = $tesouraria;

        return $this;
    }

    public function getHospitalaria()
    {
        return $this->hospitalaria;
    }

    public function setHospitalaria($hospitalaria)
    {
        $this->hospitalaria = $hospitalaria;

        return $this;
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

    public function getSecretaria()
    {
        return $this->secretaria;
    }

    public function setSecretaria($secretaria)
    {
        $this->secretaria = $secretaria;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

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

    public function getDataHora()
    {
        return $this->dataHora;
    }

    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;

        return $this;
    }
}
