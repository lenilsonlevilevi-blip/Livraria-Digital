<?php
include("conexao.php");

if (!isset($_POST['carrinho'])) {
    die("Carrinho não recebido");
}

$carrinho = json_decode($_POST['carrinho'], true);

if (!$carrinho) {
    die("Erro ao decodificar carrinho");
}

$itens = [];
$total = 0;

foreach ($carrinho as $item) {
    $itens[] = $item['nome'];
    $total += $item['preco'];
}

$itensString = implode(", ", $itens);

$sql = "INSERT INTO compras (itens, total) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro no prepare: " . $conn->error);
}

$stmt->bind_param("sd", $itensString, $total);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Erro ao salvar: " . $stmt->error;
}
?>