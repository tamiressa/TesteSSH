<?php

require '../models/saidas_model.php';

date_default_timezone_set('America/Sao_Paulo');

class Saida{

    private $saidaModel;

    public function __construct()
    {
        $this->saidaModel = new SaidasModel();
    }
    public function salvarSaida()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo 'Metodo invalido';
            return;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $id_tipo = $data['id_tipo_saida'];
        $date = date("Y-m-d H:i:s");
        $descricao = $data['descricao'];
        $valor = $data['valor'];

              //Condição de ifs
              if (trim($id_tipo == null)) {
                echo 'O id_tipo e nulo';
                return;
            } else if (is_string($id_tipo)) {
                echo 'O id_tipo não pode ser string';
                return;
            } else if (trim($descricao) == null) {
                echo 'error nulo';
                return;
            } else if (is_numeric($descricao)) {
                echo 'Não pode ser um numero';
                return;
            } else if (strlen($descricao) > 90) {
                echo 'Limite Ultrapassado';
                return;
            } else if ($valor == null) {
                echo 'o valor não pode ser nulo';
                return;
            } else if (is_string($valor)) {
                echo 'o valor não pode ser string';
                return;
            }

            $resposta = $this->saidaModel->salvar_dados_saidas($id_tipo, $descricao, $date, $valor);
            $arrayz['descricao'] = $data['descricao'];
            $arrayz['date'] = date("Y/m/d");
            $arrayz['id'] =  $resposta;
            $arrayz['id_tipo_saida'] =  $data['id_tipo_saida'];
            $arrayz['valor'] =  $data['valor'];
            echo json_encode($arrayz);
        

        
    }
    public function listarSaidas()
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            echo 'Metodo invalido';
            return;
        }
        $saidas = $this->saidaModel->listar_dados_saidas();
        $total = $this->saidaModel->pegar_soma_total_saidas();
        $resultado['saidas'] = $saidas;
        $resultado['total'] = $total[0]['total'];
        echo json_encode($resultado);
    }
    public function deletSaida()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo 'Metodo invalido';
            return;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        if(trim($id == null)){
            echo 'O id_tipo e nulo';
            return;
        }
        else if (is_string($id)){
            echo 'O id_tipo não pode ser string';
            return;
        }

        $del = $this->saidaModel->deletar_dados_saidas($data['id']);
        $arrayz['id'] = $data['id'];
        $arrayz['status'] = $del;
        $arrayz['msg'] = "DELETEI";
        echo json_encode($arrayz);
    }
    public function editarSaida()
    {
        if($_SERVER['REQUEST_METHOD'] != 'PUT'){
            echo 'Metodo invalido';
            return;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $id_tipo_saida = $data['id_tipo_saida'];
        $descricao = $data['descricao'];
        $valor = $data['valor'];

        if(trim($id == null)){
            echo 'O id_tipo e nulo';
            return;
        }
        else if (is_string($id)){
            echo 'O id_tipo não pode ser string';
            return;
        }
        else if(trim($id_tipo_saida == null)){
            echo 'O id_tipo e nulo';
            return;
        }
        else if (is_string($id_tipo_saida)){
            echo 'O id_tipo não pode ser string';
            return;
        }
        else if (trim($descricao) == null) {
            echo 'error nulo';
            return;
        } else if (is_numeric($descricao)) {
            echo 'Não pode ser um numero';
            return;
        } else if (strlen($descricao) > 90) {
            echo 'Limite Ultrapassado';
            return;
        } else if ($valor == null){
            echo 'o valor não pode ser nulo';
            return;
        }else if (is_string($valor)){
            echo 'o valor não pode ser string';
            return;
        }
        
        $resposta = $this->saidaModel->editar_dados_saidas($id, $id_tipo_saida, $descricao, $valor);
        $arrayz['id'] = $id;
        $arrayz['descricao'] = $data['descricao'];
        $arrayz['status'] =  $resposta;
        $arrayz['valor'] =  $valor;
        echo json_encode($arrayz);
    }
}
$funcao = $_GET['funcao'];
$classe = new Saida();

$classe->$funcao();