<?php

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"]);
    $senha = $_POST["senha"];

    // Verifica se o usuário já existe
    $verifica = $conn->prepare(
        "SELECT id FROM usuario WHERE usuario = ?"
    );

    $verifica->bind_param("s", $usuario);
    $verifica->execute();

    $resultado = $verifica->get_result();

    if ($resultado->num_rows > 0) {

        echo "<script>
                alert('Este usuário já está cadastrado!');
                window.location.href='cadastro.html';
              </script>";
        exit();
    }

    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere usuário no banco
    $sql = "INSERT INTO usuario (usuario, senha)
            VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param(
        "ss",
        $usuario,
        $senhaHash
    );

    if ($stmt->execute()) {

        echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href='login.html';
              </script>";
        exit();

    } else {

        echo "Erro ao cadastrar usuário: " . $stmt->error;

    }

    $stmt->close();
}

$conn->close();

?>