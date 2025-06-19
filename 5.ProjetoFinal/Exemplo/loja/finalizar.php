<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Contato - Livraria Online</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <?php include_once 'vendor/header.php'; ?>
  <main>
    <h2>Finalizar compra</h2>
    <div class="form-contato">
      <form>
        <label>Nome:</label>
        <input type="text" name="nome">
        <label>Email:</label>
        <input type="email" name="email">

      </form>
      <div class="btn-finalizar">
        <button id="btn-lista">Ver lista de pedido</button>
        <button>Cancelar</button>
        <button>Finalizar</button>
      </div>
      <style>
        .btn-finalizar {
          width: 80%;
          margin: 0 auto;
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 20px;
          margin-top: 50px;
        }


        .lista-pedido {
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;

        }

        .lista-pedido table {
          width: 80%;

        }

        .lista-pedido table {
          border-collapse: collapse;
        }

        .lista-pedido th,
        .lista-pedido td {
          text-align: center;
          padding: 10px;

          /* border: 1px solid red; */
        }

        tfoot,
        thead {
          background-color: black;
          color: #fff;
        }
      </style>




    </div>

    <div class="lista-pedido" id="lista-pedido">
      <h3>Lista do pedido</h3>
      <table>
        <thead>
          <th>Produto</th>
          <th>Valor</th>
          <th>Quantidade</th>
          <th>Valor total</th>
        </thead>
        <tbody>
          <tr>
            <td>Livro A</td>
            <td>R$ 59,50</td>
            <td>5</td>
            <td>R$ 40,00</td>
          </tr>
          <tr>
            <td>Livro A</td>
            <td>R$ 59,50</td>
            <td>5</td>
            <td>R$ 40,00</td>
          </tr>
          <tr>
            <td>Livro A</td>
            <td>R$ 59,50</td>
            <td>5</td>
            <td>R$ 40,00</td>
          </tr>
          <tr>
            <td>Livro A</td>
            <td>R$ 59,50</td>
            <td>5</td>
            <td>R$ 40,00</td>
          </tr>
        </tbody>
        <tfoot>

          <th colspan="2"></th>
          <th colspan="1" style="text-align: center;">Total</th>
          <th>R$ 00,00</th>
        </tfoot>
      </table>
    </div>


  </main>
  <footer>
    <p>&copy; 2025 Livraria Online. Todos os direitos reservados.</p>
  </footer>
</body>

</html>

<script>
  const botaoLista = document.getElementById('btn-lista');
  const lista = document.getElementById('lista-pedido');
  lista.style.display = 'none';


  botaoLista.addEventListener('click', () => {
    // window.location.href = "finalizar.html";

    if (lista.style.display === 'none') {
      lista.style.display = 'flex';
    } else {
      lista.style.display = 'none';
    }
  });
</script>