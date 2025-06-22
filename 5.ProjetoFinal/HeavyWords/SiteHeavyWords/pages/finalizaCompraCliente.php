<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header('Location: loginCliente.php');
    exit;
}
include_once '../backend/conexaoCliente.php';
$cid = intval($_SESSION['cliente_id']);
// Dados do cliente
$cliente = $conn->query("SELECT nome, email FROM clientes WHERE id = $cid")->fetch_assoc();
// Itens do carrinho
$itens = $conn->query("SELECT p.nome, c.quantidade, p.preco FROM carrinho c JOIN produtos p ON c.produto_id = p.id WHERE c.cliente_id = $cid");
$total = 0;
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recalcula itens do carrinho
    $itens = $conn->query("SELECT c.produto_id, c.quantidade, p.preco, p.estoque FROM carrinho c JOIN produtos p ON c.produto_id = p.id WHERE c.cliente_id = $cid");
    $total = 0;
    $itens_array = [];
    while($item = $itens->fetch_assoc()) {
        // Verifica estoque suficiente
        if ($item['quantidade'] > $item['estoque']) {
            $mensagem = 'Estoque insuficiente para um ou mais produtos.';
            break;
        }
        $total += $item['preco'] * $item['quantidade'];
        $itens_array[] = $item;
    }
    if (!$mensagem && count($itens_array) > 0) {
        // Gerar número de pedido de 6 dígitos aleatórios
        $numero_pedido = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        // Cria pedido (adicione o campo numero_pedido na tabela pedidos_simulados se ainda não existir)
        $conn->query("INSERT INTO pedidos_simulados (cliente_id, valor_total, numero_pedido) VALUES ($cid, $total, '$numero_pedido')");
        $pedido_id = $conn->insert_id;
        foreach($itens_array as $item) {
            $pid = $item['produto_id'];
            $qtd = $item['quantidade'];
            $preco = $item['preco'];
            // Insere item do pedido
            $conn->query("INSERT INTO itens_pedido_simulado (pedido_id, produto_id, quantidade, preco_unitario) VALUES ($pedido_id, $pid, $qtd, $preco)");
            // Diminui estoque e incrementa vendidos
            $conn->query("UPDATE produtos SET estoque = estoque - $qtd, vendidos = vendidos + $qtd WHERE id = $pid");
        }
        // Limpa carrinho
        $conn->query("DELETE FROM carrinho WHERE cliente_id = $cid");
        $mensagem = 'Compra finalizada com sucesso! O número do seu pedido é #' . $numero_pedido . '. Enviaremos no seu email mais detalhes do pedido.';
    } elseif (!$mensagem) {
        $mensagem = 'Seu carrinho está vazio.';
    }
    // Atualiza itens para exibir resumo vazio ou atualizado
    $itens = $conn->query("SELECT p.nome, c.quantidade, p.preco FROM carrinho c JOIN produtos p ON c.produto_id = p.id WHERE c.cliente_id = $cid");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
</head>
<body>
    <h2>Finalizar Compra</h2>
    <?php if ($mensagem): ?>
        <p style="color:green;"><strong><?php echo $mensagem; ?></strong></p>
        <a href="index.php">Voltar para a loja</a>
        <hr>
    <?php else: ?>
    <h3>Dados do Cliente</h3>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($cliente['nome']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($cliente['email']); ?></p>
    <hr>
    <h3>Pagamento</h3>
    <form method="POST" action="">
        <label>Número do cartão:</label><br>
        <input type="text" name="cartao" maxlength="19" required><br><br>
        <label>Validade:</label><br>
        <input type="text" name="validade" maxlength="7" placeholder="MM/AAAA" required><br><br>
        <label>CVV:</label><br>
        <input type="text" name="cvv" maxlength="4" required><br><br>
        <button type="submit">Finalizar compra</button>
    </form>
    <hr>
    <h3>Resumo da Compra</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Total</th>
        </tr>
        <?php if ($itens && $itens->num_rows > 0): ?>
            <?php while($item = $itens->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['nome']); ?></td>
                    <td><?php echo $item['quantidade']; ?></td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
                </tr>
                <?php $total += $item['preco'] * $item['quantidade']; ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></td>
            </tr>
        <?php else: ?>
            <tr><td colspan="4">Nenhum item no carrinho.</td></tr>
        <?php endif; ?>
    </table>
    <br>
    <a href="paginaCarrinho.php">Voltar ao carrinho</a>
    <?php endif; ?>
</body>
</html>
<?php $conn->close(); ?>
