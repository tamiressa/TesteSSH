<?php
require '../conexao/conexao.php';

class SaidasModel{
    private $conexao;
    private $conexaoNova;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexaoNova = $this->conexao->getConnection();
    }

    public function salvar_dados_saidas($id_tipo, $descricao, $date, $valor){

        $sql = "INSERT INTO Saidas (id_tipo_saida, descricao, data_hora_saida, valor_saida) VALUES($id_tipo, $descricao, $date, $valor)";
        mysqli_query($this->conexaoNova, $sql);
        $id = mysqli_insert_id($this->conexaoNova);
        return $id;
    }


    public function listar_dados_saidas()
    {
        $sql = "SELECT Saidas.id_saida,Tipos_Saidas.id_tipo_saida, Tipos_Saidas.nome, Saidas.descricao, Saidas.data_hora_saida,Saidas.valor_saida,(SELECT SUM(valor_saida) FROM saidas) as 'total'
        FROM Saidas
        INNER JOIN Tipos_Saidas
        ON Saidas.id_tipo_saidas = Tipos_Saidas.id_tipo_saida
        GROUP BY Saidas.id_saida, Tipos_saidas.nome";
        $result = mysqli_query($this->conexaoNova, $sql);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }

    public function pegar_soma_total_saidas()
    {
        $sql = "SELECT SUM(valor_saida) as total FROM saidas";
        $result = mysqli_query($this->conexaoNova, $sql);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deletar_dados_saidas($id)
    {
        $query = "DELETE FROM saidas WHERE id_saida = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }

    public function editar_dados_saidas($id, $id_tipo_saida, $descricao, $valor)
    {
        $query = "UPDATE saidas SET id_tipo_saida = '$id_tipo_saida',descricao = '$descricao', valor_saida = $valor WHERE id_saida = $id";
        mysqli_query($this->conexaoNova, $query);
        return true;
    }




}

