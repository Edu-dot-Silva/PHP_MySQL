<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Livraria Online</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
   <?php include_once 'vendor/header.php';?>

  <main>
    <h2>Nome categoria</h2>
    <div class="filtro">

      <h3>Filtrar Livros</h3>
      <form>

        <label for="nome">Nome:</label>
        <input type="number" id="nome" name="nome" placeholder="Digite o nome do livro"><br>
        <button type="submit">Filtrar</button>
      </form>
    </div>
    <div class="livros">
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/316Rn0ogOBL._SY445_SX342_.jpg" alt="">
        <h3>Livro A</h3>
        <p>R$ 49,90</p>
        <button onclick="adicionarCarrinho('Livro A', 49.90)">Adicionar ao Carrinho</button>
      </div>
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/316Rn0ogOBL._SY445_SX342_.jpg" alt="">
        <h3>Livro B</h3>
        <p>R$ 59,90</p>
        <button onclick="adicionarCarrinho('Livro B', 59.90)">Adicionar ao Carrinho</button>
      </div>
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/316Rn0ogOBL._SY445_SX342_.jpg" alt="">
        <h3>Livro B</h3>
        <p>R$ 59,90</p>
        <button onclick="adicionarCarrinho('Livro B', 59.90)">Adicionar ao Carrinho</button>
      </div>
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/316Rn0ogOBL._SY445_SX342_.jpg" alt="">
        <h3>Livro B</h3>
        <p>R$ 59,90</p>
        <button onclick="adicionarCarrinho('Livro B', 59.90)">Adicionar ao Carrinho</button>
      </div>
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/316Rn0ogOBL._SY445_SX342_.jpg" alt="">
        <h3>Livro B</h3>
        <p>R$ 59,90</p>
        <button onclick="adicionarCarrinho('Livro B', 59.90)">Adicionar ao Carrinho</button>
      </div>
      <div class="livro">
        <img src="https://m.media-amazon.com/images/I/316Rn0ogOBL._SY445_SX342_.jpg" alt="">
        <h3>Livro B</h3>
        <p>R$ 59,90</p>
        <button onclick="adicionarCarrinho('Livro B', 59.90)">Adicionar ao Carrinho</button>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Livraria Online. Todos os direitos reservados.</p>
  </footer>
  <script src="script.js"></script>
</body>

</html>