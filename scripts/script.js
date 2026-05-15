// CONTADOR DO CARRINHO

let contador = localStorage.getItem("carrinho") || 0;

// Atualiza contador na tela
function atualizarCarrinho() {

  const elemento = document.getElementById("contador");

  if (elemento) {
    elemento.innerText = contador;
  }

  const totalItens = document.getElementById("totalItens");

  if (totalItens) {
    totalItens.innerText = contador + " itens";
  }
}

// Adicionar item
function adicionarCarrinho() {

  contador++;

  localStorage.setItem("carrinho", contador);

  atualizarCarrinho();

  alert("Livro adicionado ao carrinho!");
}

// Limpar carrinho
function limparCarrinho() {

  contador = 0;

  localStorage.setItem("carrinho", contador);

  atualizarCarrinho();

  alert("Carrinho limpo!");
}

// LOGIN
const form = document.getElementById("formLogin");

if (form) {

  form.addEventListener("submit", function(event) {

    event.preventDefault();

    const usuario = document.getElementById("usuario").value;

    alert("Bem-vindo, " + usuario + "!");

    window.location.href = "index.html";
  });
}

// Atualiza ao carregar página
atualizarCarrinho();
