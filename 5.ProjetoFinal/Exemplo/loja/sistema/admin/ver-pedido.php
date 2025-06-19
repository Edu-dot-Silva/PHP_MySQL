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

    .body-dashboard table {
      width: 100%;
      text-align: center;
    }

    .body-dashboard table td {
      padding: 25px;
    }

    .body-dashboard a {
      text-decoration: none;
      color: #000;
    }
  </style>

  <main>
    <h2>Pedido</h2>


    <div class="menu-dashboard">
      <?php include_once 'vendor/menu.php'; ?>
      <div style="padding:0 0  70px 0;">
        <div class="body-dashboard">

          <div style="background-color:#e7e7e7;padding:20px">
            <h3>Detalhes do Pedido</h3>
            <p>Nome do cliente: Fulano</p>
            <p>Data do Pedido: 01/01/2025</p>
            <p>Total: R$ 150,00</p>
            <p>Status: Pago</p>
            <p>Endereço de Entrega: Rua Exemplo, 123, Cidade, Estado</p>
            <p>Telefone: (00) 12345-6789</p>
            <p>Email:contato@email.com</p>
          </div>



          <table style="margin-top: 30px;background-color:#e7e7e7;padding:20px">
            <!-- titulo da tabela -->
            <caption style="background-color:#e7e7e7;padding:20px">Lista do pedido</caption>
            <thead>
              <tr>


                <th>Item</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>AÇÃO</th>
              </tr>

            </thead>

            <tfoot>
              <tr>


                <th>Item</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>AÇÃO</th>

              </tr>
            </tfoot>

            <tbody>
              <tr>
                <td>Livro 1</td>

                <td>R$ 00,00</td>
                <td>1</td>
                <td>
                  <a href="">Ver</a> |

                  <a href="">Deletar</a>
                </td>
              </tr>
              <tr>
                <td>Livro 2</td>

                <td>R$ 00,00</td>
                <td>2</td>
                <td>
                  <a href="">Ver</a> |

                  <a href="">Deletar</a>
                </td>
              </tr>

              <tr>
                <td>Livro 3</td>

                <td>R$ 00,00</td>
                <td>1</td>
                <td>
                  <a href="">Ver</a> |

                  <a href="">Deletar</a>
                </td>

            </tbody>
          </table>
        </div>
        <form action="">
          <select name="" id="" style="width: 70%; padding: 10px; margin-top: 10px;">
            <option value="">Selecione o status</option>
            <option value="pago">Pago</option>
            <option value="pendente">Pendente</option>
            <option value="cancelado">Cancelado</option>
            <option value="entregue">Entregue</option>
          </select>
          <input type="submit" value="Atualizar Status" style="margin-top: 20px; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;width: 20%;">
        </form>
      </div>
    </div>



  </main>

  <footer>
    <p>&copy; 2025 Livraria Online. Todos os direitos reservados.</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>