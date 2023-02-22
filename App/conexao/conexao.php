<?php
class Conexao
{
    private $nomeservidor = "localhost";
    private $usuario = "root";
    private $senha = "1234";
    private $banco = "bisa_teste_2";
    public function getConnection()
    {
        $conn =  new mysqli($this->nomeservidor, $this->usuario, $this->senha, $this->banco);
        if ($conn->connect_error) {
            die("Failed to connect");
        }
        return $conn;
    }
}
