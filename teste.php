<?php

include("conexao.php");

echo "Conexão realizada com sucesso!";
$resultado = $conn->query($sql);

while($livro = $resultado->fetch_assoc()){
    echo $livro['titulo'] . "<br>";