<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header('Location: loginCliente.php');
    exit;
}
include_once '../backend/conexaoCliente.php';
$cid = intval($_SESSION['cliente_id']);
$cliente_nome = '';
$res_nome = $conn->query("SELECT nome FROM clientes WHERE id = $cid");
if ($res_nome && $row_nome = $res_nome->fetch_assoc()) {
    $cliente_nome = $row_nome['nome'];
}
$sql = "SELECT c.id, c.quantidade, p.nome, p.preco, p.imagem_url FROM carrinho c JOIN produtos p ON c.produto_id = p.id WHERE c.cliente_id = $cid";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Seu carrinho, <?php echo htmlspecialchars($cliente_nome); ?></title>
    <script>
    function atualizarQuantidade(itemId, input) {
        var novaQtd = parseInt(input.value);
        if (novaQtd < 1) {
            excluirItem(itemId);
            return;
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateCarrinho.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Atualiza o total do item e o total geral sem recarregar
                var resposta = JSON.parse(xhr.responseText);
                if (resposta.sucesso) {
                    document.getElementById('totalItem_' + itemId).innerText = resposta.totalItem;
                    document.getElementById('totalGeral').innerText = resposta.totalGeral;
                }
            }
        };
        xhr.send('id=' + itemId + '&quantidade=' + novaQtd);
    }
    function excluirItem(itemId) {
        if (!confirm('Deseja remover este item do carrinho?')) return;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'deleteCarrinho.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
        xhr.send('id=' + itemId);
    }
    </script>
</head>
<body>
    <h2>Seu carrinho, <?php echo htmlspecialchars($cliente_nome); ?></h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
            <?php $total = 0; ?>
            <?php while($item = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php if (!empty($item['imagem_url'])): ?>
                            <img src="../../AdminHeavyWords/<?php echo $item['imagem_url']; ?>" style="max-width:60px;max-height:60px;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['nome']); ?></td>
                    <td>
                        <input type="number" min="1" value="<?php echo $item['quantidade']; ?>" style="width:50px;" onchange="atualizarQuantidade(<?php echo $item['id']; ?>, this)">
                    </td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td id="totalItem_<?php echo $item['id']; ?>">R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
                    <td><button onclick="excluirItem(<?php echo $item['id']; ?>)">Excluir</button></td>
                </tr>
                <?php $total += $item['preco'] * $item['quantidade']; ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="4" align="right"><strong>Total:</strong></td>
                <td colspan="2"><strong id="totalGeral">R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></td>
            </tr>
        </table>
        <br>
        <button onclick="window.location.href='index.php'">Continuar comprando</button>
        <button onclick="window.location.href='finalizaCompraCliente.php'">Finalizar compra</button>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
    <br>
    <a href="index.php">Voltar</a>
    <?php include '../components/rodape.php'; ?>
</body>
</html>
<?php $conn->close(); ?>