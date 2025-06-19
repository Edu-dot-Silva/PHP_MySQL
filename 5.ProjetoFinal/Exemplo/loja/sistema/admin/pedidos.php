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
    <h2>Lista de peditos</h2>


    <div class="menu-dashboard">
      <?php include_once 'vendor/menu.php'; ?>
      <div style="background-color:#e7e7e7;padding: 70px 0;">
        <div class="body-dashboard">

          <table>
            <thead>
              <tr>

                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Status</th>
                <th>AÇÃO</th>
              </tr>

            </thead>

            <tfoot>
              <tr>

                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Status</th>
                <th>AÇÃO</th>

              </tr>
            </tfoot>

            <tbody>
              <tr>
                <td>1</td>
                <td>Nome do cliente</td>
                <td>R$ 00,00</td>
                <td>Pago</td>
                <td>
                  <a href="ver-pedido.php">Ver</a> |

                  <a href="">Deletar</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Nome do cliente</td>
                <td>R$ 00,00</td>
                <td>Pendente</td>
                <td>
                  <a href="ver-pedido.php">Ver</a> |

                  <a href="">Deletar</a>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Nome do cliente</td>
                <td>R$ 00,00</td>
                <td>Cancelado</td>
                <td>
                  <a href="ver-pedido.php">Ver</a> |

                  <a href="">Deletar</a>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>Nome do cliente</td>
                <td>R$ 00,00</td>
                <td>Pago</td>
                <td>
                  <a href="ver-pedido.php">Ver</a> |

                  <a href="">Deletar</a>
                </td>
              </tr>


            </tbody>
          </table>
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