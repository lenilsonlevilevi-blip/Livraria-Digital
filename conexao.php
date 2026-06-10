<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "biblioteca.online";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
} else {
    
}

$conn->set_charset("utf8");

?>