<?php
include("conexao.php");
$conn->set_charset("utf8");

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

if ($busca !== '') {
  $busca_safe = $conn->real_escape_string($busca);
  $sql = "SELECT * FROM livro WHERE
            titulo    LIKE '%$busca_safe%' COLLATE utf8_general_ci
         OR descricao LIKE '%$busca_safe%' COLLATE utf8_general_ci";
} else {
  $sql = "SELECT * FROM livro";
}

$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livraria Digital</title>
  <link rel="stylesheet" href="styles/livros.css" />
</head>

<body>

  <header>
    <nav>
      <h2 class="logo">📚 Livraria Digital</h2>

      <div class="nav-links">
        <a href="index.php">Início</a>
        <a href="#catalogo">Catálogo</a>
        <a href="compras.php">Minhas Compras</a>
      </div>

      <form class="nav-search" method="GET" action="index.php">
        <input
          type="text"
          name="busca"
          placeholder="Buscar livros..."
          value="<?php echo htmlspecialchars($busca); ?>"
        />
        <button type="submit">
          <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <circle cx="11" cy="11" r="7"/>
            <line x1="16.5" y1="16.5" x2="22" y2="22"/>
          </svg>
        </button>
      </form>

      <a href="carrinho.html" class="nav-carrinho">
        🛒
        <span id="contador">0</span>
      </a>
    </nav>
  </header>

  <main>

    <section class="banner">
      <h1>Catálogo de Livros</h1>
      <?php if ($busca !== ''): ?>
        <p class="descricao">Resultados para: <strong>"<?php echo htmlspecialchars($busca); ?>"</strong> — <a href="index.php">Limpar busca</a></p>
      <?php else: ?>
        <p class="descricao">Encontre os melhores livros e transforme seu conhecimento.</p>
      <?php endif; ?>
    </section>

    <section class="catalogo" id="catalogo">

      <?php
        $livros = $resultado->fetch_all(MYSQLI_ASSOC);
        if (count($livros) === 0):
      ?>
        <div class="nao-encontrado">
          <span>📚</span>
          <h2>Nenhum livro encontrado</h2>
          <p>Não encontramos resultados para "<strong><?php echo htmlspecialchars($busca); ?></strong>".<br>Tente outro título ou palavra-chave.</p>
          <a href="index.php" class="btn-detalhes" style="display:inline-flex; width:auto; margin-top:16px;">Ver todos os livros</a>
        </div>
      <?php else: ?>
        <?php foreach ($livros as $livro): ?>

          <div class="card">

            <img src="<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['titulo']; ?>">

            <h3><?php echo $livro['titulo']; ?></h3>

            <p class="descricao">
              <?php echo substr($livro['descricao'], 0, 90); ?>...
            </p>

            <p class="preco">
              R$ <?php echo number_format($livro['valor'], 2, ',', '.'); ?>
            </p>

            <a href="livro.php?id=<?php echo $livro['id']; ?>" class="btn-detalhes">
              👁 Ver detalhes
            </a>

            <button onclick="adicionarCarrinho(
              '<?php echo addslashes($livro["titulo"]); ?>',
              <?php echo $livro['valor']; ?>
            )">
              🛒 Adicionar ao Carrinho
            </button>

          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </section>

    <div class="trust-bar">
      <div class="trust-item">
        <span class="trust-icon">🔒</span>
        <div>
          <h4>Compra Segura</h4>
          <p>Seus dados protegidos com segurança de ponta a ponta.</p>
        </div>
      </div>
      <div class="trust-item">
        <span class="trust-icon">🚚</span>
        <div>
          <h4>Entrega Rápida</h4>
          <p>Receba seus livros com rapidez e segurança.</p>
        </div>
      </div>
      <div class="trust-item">
        <span class="trust-icon">🎧</span>
        <div>
          <h4>Suporte 24/7</h4>
          <p>Estamos sempre prontos para te ajudar.</p>
        </div>
      </div>
    </div>

  </main>

  <footer>
    <p>© 2024 Livraria Digital. Todos os direitos reservados.</p>
  </footer>

  <script src="scripts/script.js"></script>

</body>
</html>