<?php
include_once '../backend/conexaoCliente.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Produto não encontrado.';
    exit;
}
$id = intval($_GET['id']);
$sql = "SELECT * FROM produtos WHERE id = $id AND ativo = 1";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    echo 'Produto não encontrado.';
    exit;
}
$produto = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($produto['nome']); ?> - Detalhes do Produto</title>
    <script>
    function adicionarCarrinho(produtoId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'adicionarCarrinho.php?id=' + produtoId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var resposta = JSON.parse(xhr.responseText);
                if (resposta.sucesso) {
                    document.getElementById('carrinhoQtd').innerText = resposta.qtd;
                } else if (resposta.login) {
                    window.location.href = 'loginCliente.php?add_carrinho=' + produtoId;
                }
            }
        };
        xhr.send();
    }
    </script>
</head>
<body>
    <?php include '../components/topoCliente.php'; ?>
    <h2><?php echo htmlspecialchars($produto['nome']); ?></h2>
    <?php if (!empty($produto['imagem_url'])): ?>
        <img src="../../AdminHeavyWords/<?php echo $produto['imagem_url']; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" style="max-width:300px;max-height:300px;display:block;margin-bottom:16px;">
    <?php endif; ?>
    <p><strong>Preço:</strong> R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
    <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
    <p><strong>Banda:</strong> <?php echo htmlspecialchars($produto['banda']); ?></p>
    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($produto['tipo']); ?></p>
    <button type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $produto['id'] : 'loginCliente.php?add_carrinho=' . $produto['id']; ?>'">Comprar</button>
    <button type="button" onclick="adicionarCarrinho(<?php echo $produto['id']; ?>)">Adicionar ao carrinho</button>
    <br>
    <a href="index.php">Voltar</a>
    <?php include '../components/rodape.php'; ?>
</body>
</html>
<?php $conn->close(); ?>
