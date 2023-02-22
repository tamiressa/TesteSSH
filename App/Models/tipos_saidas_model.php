<?php
require '../conexao/conexao.php';

class TipoSaidasModel{
    private $conexao;
    private $conexaoNova;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexaoNova = $this->conexao->getConnection();
    }
    
    public function salvar_dados_saidas($nome){
        $sql = "INSERT INTO tipos_saidas (nome) VALUES ('$nome')";
        mysqli_query($this->conexaoNova, $sql);
        $id = mysqli_insert_id($this->conexaoNova);
        return $id;
    }

    public function listar_dados_saidas(){
        $sql = "SELECT * FROM tipos_saidas";
        $result = mysqli_query($this->conexaoNova, $sql);
        return  mysqli_fetch_all($result);
    }

    public function deletar_dados_saidas($id){
        $query = "DELETE FROM tipos_saidas WHERE id_tipo_saida = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }

    public function editar_dados_saidas($nomeEditar,$id){
        $query = "UPDATE tipos_saidas SET nome = '$nomeEditar' WHERE id_tipo_saida = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }


    
}