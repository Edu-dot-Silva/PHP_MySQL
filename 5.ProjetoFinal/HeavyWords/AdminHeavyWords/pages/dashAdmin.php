<?php
// session_start();
// $nome = isset($_SESSION['admin_nome']) ? $_SESSION['admin_nome'] : 'Administrador';
// echo "Bem-vindo, $nome";
include_once '../backend/conexaoAdmin.php';
include_once '../components/topoAdm.php';
// Buscar os 10 últimos produtos ativos
$ultimos = $conn->query("SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE ativo = 1 ORDER BY criado_em DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Heavy Words</title>
    <link rel="stylesheet" href="../assets/css/dash.css">
</head>

<body>
    <?php include_once '../components/navBar.php'; ?>
    <div class="tabelas-grid">
        <div class="card-tabela">
            <h3>Últimos produtos cadastrados</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Vendidos</th>
                    <th>Banda</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                    <th>Criado em</th>
                </tr>
                <?php if ($ultimos && $ultimos->num_rows > 0): ?>
                    <?php while ($row = $ultimos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td><?php echo $row['preco']; ?></td>
                            <td><?php echo $row['estoque']; ?></td>
                            <td><?php echo $row['vendidos']; ?></td>
                            <td><?php echo htmlspecialchars($row['banda']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                            <td><?php echo $row['ativo'] ? 'Sim' : 'Não'; ?></td>
                            <td><?php echo $row['criado_em']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <div class="card-tabela">
            <h3>Últimos produtos inativos</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Vendidos</th>
                    <th>Banda</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                    <th>Criado em</th>
                </tr>
                <?php
                $inativos = $conn->query("SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE ativo = 0 ORDER BY criado_em DESC LIMIT 10");
                if ($inativos && $inativos->num_rows > 0):
                    while ($row = $inativos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td><?php echo $row['preco']; ?></td>
                            <td><?php echo $row['estoque']; ?></td>
                            <td><?php echo $row['vendidos']; ?></td>
                            <td><?php echo htmlspecialchars($row['banda']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                            <td><?php echo $row['ativo'] ? 'Sim' : 'Não'; ?></td>
                            <td><?php echo $row['criado_em']; ?></td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="10">Nenhum produto inativo.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="card-tabela">

            <h3>Estoque baixo (menor que 5)</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Vendidos</th>
                    <th>Banda</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                    <th>Criado em</th>
                </tr>
                <?php
                $estoque_baixo = $conn->query("SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE estoque < 5 AND ativo = 1 ORDER BY estoque ASC, criado_em DESC LIMIT 10");
                if ($estoque_baixo && $estoque_baixo->num_rows > 0):
                    while ($row = $estoque_baixo->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td><?php echo $row['preco']; ?></td>
                            <td><?php echo $row['estoque']; ?></td>
                            <td><?php echo $row['vendidos']; ?></td>
                            <td><?php echo htmlspecialchars($row['banda']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                            <td><?php echo $row['ativo'] ? 'Sim' : 'Não'; ?></td>
                            <td><?php echo $row['criado_em']; ?></td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="10">Nenhum produto com estoque baixo.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="card-tabela">

            <h3>Mais vendidos</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Vendidos</th>
                    <th>Banda</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                    <th>Criado em</th>
                </tr>
                <?php
                $mais_vendidos = $conn->query("SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE ativo = 1 AND vendidos > 0 ORDER BY vendidos DESC, criado_em DESC LIMIT 10");
                if ($mais_vendidos && $mais_vendidos->num_rows > 0):
                    while ($row = $mais_vendidos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td><?php echo $row['preco']; ?></td>
                            <td><?php echo $row['estoque']; ?></td>
                            <td><?php echo $row['vendidos']; ?></td>
                            <td><?php echo htmlspecialchars($row['banda']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                            <td><?php echo $row['ativo'] ? 'Sim' : 'Não'; ?></td>
                            <td><?php echo $row['criado_em']; ?></td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="10">Nenhum produto vendido.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="card-tabela">

            <h3>Últimos clientes cadastrados</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Criado em</th>
                </tr>
                <?php
                $clientes = $conn->query("SELECT id, nome, email, criado_em FROM clientes ORDER BY criado_em DESC LIMIT 10");
                if ($clientes && $clientes->num_rows > 0):
                    while ($cli = $clientes->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $cli['id']; ?></td>
                            <td><?php echo htmlspecialchars($cli['nome']); ?></td>
                            <td><?php echo htmlspecialchars($cli['email']); ?></td>
                            <td><?php echo $cli['criado_em']; ?></td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="4">Nenhum cliente cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="card-tabela">

            <h3>Últimos pedidos</h3>
            <table>
                <tr>
                    <th>ID Pedido</th>
                    <th>ID Cliente</th>
                    <th>Nome Cliente</th>
                    <th>Data</th>
                    <th>Valor Total</th>
                </tr>
                <?php
                $pedidos = $conn->query("SELECT p.id, p.cliente_id, c.nome, p.data_pedido, p.valor_total FROM pedidos_simulados p JOIN clientes c ON p.cliente_id = c.id ORDER BY p.data_pedido DESC LIMIT 10");
                if ($pedidos && $pedidos->num_rows > 0):
                    while ($pedido = $pedidos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $pedido['id']; ?></td>
                            <td><?php echo $pedido['cliente_id']; ?></td>
                            <td><?php echo htmlspecialchars($pedido['nome']); ?></td>
                            <td><?php echo $pedido['data_pedido']; ?></td>
                            <td>R$ <?php echo number_format($pedido['valor_total'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="5">Não houve pedidos recentemente.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>
<?php if (isset($conn)) $conn->close(); ?>