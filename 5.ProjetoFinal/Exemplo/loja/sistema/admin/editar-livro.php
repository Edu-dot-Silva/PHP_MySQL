<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Livraria Online</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <header>
    <h1>Livraria Online</h1>
  </header>

  <main>
    <h2>Cadastrar livro</h2>


    <div class="menu-dashboard">
      <?php include_once 'vendor/menu.php'; ?>
      <div style="background-color:#e7e7e7;padding: 25px;display: flex;padding-top: 30px;">


        <div class="body-dashboard">
          <div style="display: flex;justify-content: right; margin-bottom: 25px;">
            <a href="listar-produtos.php" class="btn">Listar livros</a>
          </div>
          <div class="dashboard-form">

            <form action="">
              <div>
                <label for="">Titulo</label>
                <input type="text" placeholder="Digite o titulo do livro">
              </div>
              <div class="col-2">
                <div>
                  <label for="">Imagem</label>
                  <input type="file" placeholder="Digite o titulo do livro">
                </div>
                <div>
                  <label for="">Preço</label>
                  <input type="text" placeholder="Digite o preço do livro">
                </div>
              </div>
              <label for="">Descrição</label>
              <textarea name="" id="" rows="10"></textarea>

              <button>Cadastrar</button>
            </form>
          </div>

        </div>

      </div>
    </div>

  </main>

  <footer>
    <p>&copy; 2025 Livraria Online. Todos os direitos reservados.</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>