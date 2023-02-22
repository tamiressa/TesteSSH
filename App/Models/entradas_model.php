<?php
require '../conexao/conexao.php';

class EntradasModel{
    private $conexao;
    private $conexaoNova;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexaoNova = $this->conexao->getConnection();
    }
    

    public function salvar_dados_entradas($id_tipo, $descricao, $date, $valor){

        $sql = "INSERT INTO Entradas (id_tipo_entrada, descricao, data_hora_entrada, valor_entrada) VALUES($id_tipo, $descricao, $date, $valor)";
        mysqli_query($this->conexaoNova, $sql);
        $id = mysqli_insert_id($this->conexaoNova);
        return $id;
    }

    

    public function listar_dados_entradas()
    {
        $sql = "SELECT Entradas.id_entrada,Tipos_Entradas.id_tipo_entrada, Tipos_Entradas.nome, Entradas.descricao, Entradas.data_hora_entrada,Entradas.valor_entrada,(SELECT SUM(valor_entrada) FROM entradas) as 'total'
        FROM Entradas
        INNER JOIN Tipos_Entradas
        ON Entradas.id_tipo_entrada = Tipos_Entradas.id_tipo_entrada
        GROUP BY Entradas.id_entrada, Tipos_entradas.nome";
        $result = mysqli_query($this->conexaoNova, $sql);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }

    public function pegar_soma_total_entradas()
    {
        $sql = "SELECT SUM(valor_entrada) as total FROM entradas";
        $result = mysqli_query($this->conexaoNova, $sql);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deletar_dados_entradas($id)
    {
        $query = "DELETE FROM entradas WHERE id_entrada = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }

    public function editar_dados_entradas($id, $id_tipo_entrada, $descricao, $valor)
    {
        $query = "UPDATE entradas SET id_tipo_entrada = '$id_tipo_entrada',descricao = '$descricao', valor_entrada = $valor WHERE id_entrada = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }




}

