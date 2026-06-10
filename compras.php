<?php
include("conexao.php");

// Apagar histórico
if (isset($_POST['apagar_historico'])) {
  $conn->query("DELETE FROM compras");
  header("Location: compras.php");
  exit();
}

$sql = "SELECT * FROM compras ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Compras realizadas</title>
  <link rel="stylesheet" href="styles/livros.css">
</head>

<body>

  <div class="carrinho-container">

    <h1>📦 Compras realizadas</h1>

    <?php if ($resultado->num_rows > 0) { ?>

      <?php while($compra = $resultado->fetch_assoc()) { ?>

        <div class="card" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ccc; border-radius: 10px;">

          <h3>🧾 Compra #<?php echo $compra['id']; ?></h3>

          <p><strong>Itens:</strong> <?php echo $compra['itens']; ?></p>

          <p><strong>Total:</strong> R$ <?php echo number_format($compra['total'], 2, ',', '.'); ?></p>

          <p><small>Data: <?php echo $compra['data']; ?></small></p>

        </div>

      <?php } ?>

      <br>

      <form method="POST" onsubmit="return confirm('Tem certeza que deseja apagar todo o histórico de compras?')">
        <button type="submit" name="apagar_historico" style="
          width: 100%;
          padding: 12px;
          background: #e63946;
          color: white;
          border: none;
          border-radius: 8px;
          font-size: 15px;
          font-weight: 600;
          cursor: pointer;
          margin-bottom: 12px;
        ">
          🗑️ Apagar histórico de compras
        </button>
      </form>

    <?php } else { ?>

      <p>Nenhuma compra realizada ainda.</p>

    <?php } ?>

    <br>

    <a href="index.php">← Voltar ao catálogo</a>

  </div>

</body>
</html>
