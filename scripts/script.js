function getCarrinho() {
  return JSON.parse(localStorage.getItem("carrinho")) || [];
}

// Atualiza contador
function atualizarContador() {
  const contador = document.getElementById("contador");
  if (contador) {
    contador.innerText = getCarrinho().length;
  }
}

// Adicionar ao carrinho
function adicionarCarrinho(nome, preco) {
  let carrinho = getCarrinho();

  carrinho.push({
    nome: nome,
    preco: preco
  });

  localStorage.setItem("carrinho", JSON.stringify(carrinho));

  atualizarContador();
}

function finalizarCompra() {
  let carrinho = getCarrinho();

  fetch("finalizar_compra.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "carrinho=" + encodeURIComponent(JSON.stringify(carrinho))
  })
  .then(res => res.text())
  .then(res => {
    console.log(res);
    alert("Compra finalizada com sucesso!");
    localStorage.removeItem("carrinho");
    atualizarContador();
    location.reload();
  });
}

// Inicializa contador ao carregar página
atualizarContador();