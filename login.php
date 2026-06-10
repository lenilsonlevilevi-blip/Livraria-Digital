<?php

session_start();

include("conexao.php");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE usuario = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $usuario);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $dados = $result->fetch_assoc();

    if (password_verify($senha, $dados['senha'])) {

        $_SESSION['usuario'] = $usuario;

        header("Location: index.php");
        exit();

    } else {

        echo "<script>
                alert('Senha incorreta!');
                window.location.href='login.html';
              </script>";
        exit();

    }

} else {

    echo "<script>
            alert('Usuário não encontrado!');
            window.location.href='login.html';
          </script>";
    exit();

}

?>