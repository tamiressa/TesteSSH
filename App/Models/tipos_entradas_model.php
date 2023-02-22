<?php
require '../conexao/conexao.php';

class TipoEntradasModel{
    private $conexao;
    private $conexaoNova;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexaoNova = $this->conexao->getConnection();
    }
    
    public function salvar_dados_entradas($nome){
        $sql = "INSERT INTO tipos_entradas (nome) VALUES ('$nome')";
        mysqli_query($this->conexaoNova, $sql);
        $id = mysqli_insert_id($this->conexaoNova);
        return $id;
    }

    public function listar_dados_entradas(){
        $sql = "SELECT * FROM tipos_entradas";
        $result = mysqli_query($this->conexaoNova, $sql);
        return  mysqli_fetch_all($result);
    }

    public function deletar_dados_entradas($id){
        $query = "DELETE FROM tipos_entradas WHERE id_tipo_entrada = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }

    public function editar_dados_entradas($nomeEditar,$id){
        $query = "UPDATE tipos_entradas SET nome = '$nomeEditar' WHERE id_tipo_entrada = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }


    
}