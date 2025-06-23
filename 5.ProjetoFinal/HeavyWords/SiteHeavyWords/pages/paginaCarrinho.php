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
    <title>Heavy Words - Seu carrinho</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/paginaCarrinho.css">
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
    <?php include '../components/topoCliente.php'; ?>
    <?php include '../components/navBar.php'; ?>
    <?php
    $voltar_url = 'index.php';
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
        if (strpos($referer, 'paginaCarrinho.php') === false) {
            $voltar_url = $referer;
        }
    }
    ?>
    <div class="section_btnVoltar">
        <a href="<?php echo htmlspecialchars($voltar_url); ?>">
            <img src="../assets/img/icons/cabecalho-icons/back.png" alt="">
        </a>
    </div>
    <h2>Seu carrinho, <?php echo htmlspecialchars($cliente_nome); ?></h2>

    <div class="section_carrinho">
        <div class="carrinho">

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <tr>
                <th></th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
                <th></th>
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
                        <input type="number" class="qtd_carrinho" min="1" value="<?php echo $item['quantidade']; ?>" onchange="atualizarQuantidade(<?php echo $item['id']; ?>, this)">
                    </td>
                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td id="totalItem_<?php echo $item['id']; ?>">R$ <?php echo number_format($item['preco'] * $item['quantidade'], 2, ',', '.'); ?></td>
                    <td><button class="excluir_carrinho" onclick="excluirItem(<?php echo $item['id']; ?>)"><img src="../assets/img/icons/cabecalho-icons/trash.png" class="icon_excluir_carrinho" alt=""></button></td>
                </tr>
                <?php $total += $item['preco'] * $item['quantidade']; ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="4" align="right"><strong>Total:</strong></td>
                <td colspan="2"><strong id="totalGeral">R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></td>
            </tr>
        </table>
        <br>
        <div class="section_btn_carrinho">
        <?php
        $continuar_url = 'index.php';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
            if (strpos($referer, 'paginaCarrinho.php') === false) {
                $continuar_url = $referer;
            }
        }
        ?>
        <button class="btn_continuar" onclick="window.location.href='<?php echo htmlspecialchars($continuar_url); ?>'">Continuar comprando</button>
        <button class="btn_finalizar" onclick="window.location.href='finalizaCompraCliente.php'">Finalizar compra</button>
    </div>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
    </div>
    </div>
    <br>
    <?php include '../components/rodape.php'; ?>
</body>
</html>
<?php $conn->close(); ?>