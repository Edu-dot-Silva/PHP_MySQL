<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Carrinho - Livraria Online</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <?php include_once 'vendor/header.php'; ?>

  <main>
    <h2>Seu Carrinho</h2>
    <ul id="lista-carrinho"></ul>

    <style>
      table {
        width: 80%;
        text-align: center;
        margin: 0 auto;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 10px;
        border: 1px solid #ccc;
      }



      input[type="number"] {
        width: 50px;
        text-align: center;
      }
    </style>
    <table>
      <thead>
        <tr>
          <th>Imagem</th>
          <th>Produto</th>
          <th>Preço</th>
          <th>Quantidade</th>
          <th>Total</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody id="tabela-carrinho">
        <!-- Itens do carrinho serão adicionados aqui -->
        <tr>
          <td>
            <img src="assets/img/livro.jpg" alt="Livro A" width="50">
          </td>
          <td>Livro A</td>
          <td>R$ 49,90</td>
          <td><input type="number" value="1" min="1"></td>
          <td>R$ 49,90</td>
          <td><button>Remover</button></td>
        </tr>
        <tr>
          <td>

            <img src="assets/img/livro.jpg" alt="Livro A" width="50">
          </td>
          <td>Livro B</td>
          <td>R$ 30,90</td>
          <td><input type="number" value="1" min="1"></td>
          <td>R$ 30,90</td>
          <td><button>Remover</button></td>
        </tr>


      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">Subtotal</td>
          <td id="subtotal" colspan="2">R$ 00,00</td>

        </tr>

        <tr>
          <td colspan="4">Total</td>
          <td id="total" colspan="2">R$ 00,00</td>

        </tr>
      </tfoot>
    </table>
    <div class="btn-container">
      <button id="finalizar-compra">Finalizar Compra</button>
      <button id="continuar-comprando">Continuar Comprando</button>
    </div>
  </main>
  <footer>
    <p>&copy; 2025 Livraria Online. Todos os direitos reservados.</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    atualizarTotais();

    document.querySelectorAll("#tabela-carrinho input[type='number']").forEach(input => {
      input.addEventListener("input", function() {
        atualizarTotais();
      });
    });

    document.querySelectorAll("#tabela-carrinho button").forEach(button => {
      button.addEventListener("click", function() {
        this.closest("tr").remove();
        atualizarTotais();
      });
    });

    function atualizarTotais() {
      let subtotal = 0;
      document.querySelectorAll("#tabela-carrinho tr").forEach(row => {
        let precoText = row.cells[2]?.textContent;
        let quantidadeInput = row.cells[3]?.querySelector("input");
        let totalCell = row.cells[4];

        if (precoText && quantidadeInput && totalCell) {
          let preco = parseFloat(precoText.replace("R$", "").replace(",", "."));
          let quantidade = parseInt(quantidadeInput.value);
          let total = preco * quantidade;

          totalCell.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
          subtotal += total;
        }
      });

      document.getElementById("subtotal").textContent = `R$ ${subtotal.toFixed(2).replace(".", ",")}`;
      document.getElementById("total").textContent = `R$ ${subtotal.toFixed(2).replace(".", ",")}`;
    }
  });


  const botao = document.getElementById('continuar-comprando');
  const botaoFinalizar = document.getElementById('finalizar-compra');

  botao.addEventListener('click', () => {
    window.location.href = "index.php";
  });

  botaoFinalizar.addEventListener('click', () => {
    window.location.href = "finalizar.php";
  });
</script>