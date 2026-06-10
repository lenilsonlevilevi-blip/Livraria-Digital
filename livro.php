<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM livro WHERE id = $id";
$resultado = $conn->query($sql);

$livro = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $livro['titulo']; ?></title>
  <link rel="stylesheet" href="styles/livros.css">
  <style>
    .detalhe-container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 36px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      display: flex;
      gap: 36px;
      align-items: flex-start;
    }

    .detalhe-container img {
      width: 260px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      flex-shrink: 0;
    }

    .detalhe-info h1 {
      font-size: 28px;
      color: #1a1a2e;
      margin-bottom: 10px;
    }

    .detalhe-disponivel {
      color: #22c55e;
      font-weight: 700;
      font-size: 15px;
      margin-bottom: 12px;
    }

    .detalhe-preco {
      font-size: 34px;
      font-weight: 800;
      color: #e63946;
      margin-bottom: 20px;
    }

    .detalhe-info hr {
      border: none;
      border-top: 1px solid #e2e8f0;
      margin-bottom: 16px;
    }

    .detalhe-info h3 {
      font-size: 16px;
      color: #1a1a2e;
      margin-bottom: 8px;
    }

    .detalhe-info p {
      color: #475569;
      line-height: 1.8;
      text-align: justify;
      font-size: 15px;
      margin-bottom: 24px;
    }

    .btn-voltar {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #2563eb;
      color: white;
      padding: 12px 22px;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 15px;
      transition: background 0.2s;
    }

    .btn-voltar:hover {
      background: #1d4ed8;
    }

    @media (max-width: 640px) {
      .detalhe-container {
        flex-direction: column;
        align-items: center;
        margin: 20px 16px;
      }
      .detalhe-container img {
        width: 100%;
        max-width: 260px;
      }
    }
  </style>
</head>

<body>

  <header>
    <nav>
      <h2 class="logo">📚 Livraria Digital</h2>
      <div class="nav-links">
        <a href="index.php">Início</a>
        <a href="index.php">Catálogo</a>
        <a href="compras.php">Minhas Compras</a>
      </div>
    </nav>
  </header>

  <div class="detalhe-container">

    <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo']; ?>">

    <div class="detalhe-info">

      <h1><?php echo $livro['titulo']; ?></h1>

      <p class="detalhe-disponivel">✅ Disponível</p>

      <p class="detalhe-preco">
        R$ <?php echo number_format($livro['valor'], 2, ',', '.'); ?>
      </p>

      <hr>

      <h3>Descrição</h3>

      <p><?php echo $livro['descricao']; ?></p>

      <a href="index.php" class="btn-voltar">⬅ Voltar ao Catálogo</a>

    </div>

  </div>

  <footer>
    <p>© 2024 Livraria Digital. Todos os direitos reservados.</p>
  </footer>

</body>
</html>
