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
  <style>
    .menu-dashboard {
      display: grid;
      grid-template-columns: 1fr 3fr;
      column-gap: 50px;
    }

    .menu-dashboard li {
      list-style: none;
      padding: 25px;
      background-color: #333;
      border-bottom: 1px solid #fff;
      color: #fff;
    }

    .menu-dashboard a {
      text-decoration: none;
      color: #fff;
    }

    .body-dashboard {
      width: 100%;
    }

    .body-dashboard table {
      width: 100%;
      text-align: center;
    }

    .body-dashboard table td {
      padding: 25px;
    }

    .body-dashboard a {
      text-decoration: none;
      /* color: #000; */
    }
  </style>

  <main>
    <h2>Cadastrar livro</h2>


    <div class="menu-dashboard">
      <?php include_once 'vendor/menu.php'; ?>
      <div style="background-color:#e7e7e7;padding: 25px;display: flex;padding-top: 30px;">


        <div class="body-dashboard">
          <div style="display: flex
          ;
              justify-content: right;
              margin-bottom: 25px;">
            <a href="index.php" class="btn">Listar livros</a>
          </div>
          <div class="dashboard-form">
            <div class="col-2">
              <div>

                <img src="../../assets/img/livro.jpg" alt="Livro A">
              </div>
              <div>
                <h1>Titulo</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio labore saepe natus quam! Laudantium obcaecati facere reprehenderit saepe beatae, hic et error aliquam odio, totam consequuntur unde quaerat at optio.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio labore saepe natus quam! Laudantium obcaecati facere reprehenderit saepe beatae, hic et error aliquam odio, totam consequuntur unde quaerat at optio.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio labore saepe natus quam! Laudantium obcaecati facere reprehenderit saepe beatae, hic et error aliquam odio, totam consequuntur unde quaerat at optio.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio labore saepe natus quam! Laudantium obcaecati facere reprehenderit saepe beatae, hic et error aliquam odio, totam consequuntur unde quaerat at optio.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio labore saepe natus quam! Laudantium obcaecati facere reprehenderit saepe beatae, hic et error aliquam odio, totam consequuntur unde quaerat at optio.</p>
                <p id="valor">Valor: 0,00</p>
              </div>
            </div>


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