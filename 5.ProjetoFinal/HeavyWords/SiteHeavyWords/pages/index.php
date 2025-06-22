<?php
session_start();
include_once '../backend/conexaoCliente.php';
$mais_vendidos = $conn->query("SELECT id, nome, preco, imagem_url FROM produtos WHERE ativo = 1 AND vendidos > 0 ORDER BY vendidos DESC LIMIT 6");
// Contador do carrinho
$carrinho_qtd = 0;
$cliente_nome = '';
if (isset($_SESSION['cliente_id'])) {
    $cid = intval($_SESSION['cliente_id']);
    $res = $conn->query("SELECT SUM(quantidade) as total FROM carrinho WHERE cliente_id = $cid");
    if ($res && $row = $res->fetch_assoc()) {
        $carrinho_qtd = intval($row['total']);
    }
    // Buscar nome do cliente
    $res_nome = $conn->query("SELECT nome FROM clientes WHERE id = $cid");
    if ($res_nome && $row_nome = $res_nome->fetch_assoc()) {
        $cliente_nome = $row_nome['nome'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Heavy Words</title>
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
    <?php include '../components/navBar.php'; ?>
    <h2>Mais Vendidos</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 24px;">
        <?php if ($mais_vendidos && $mais_vendidos->num_rows > 0): ?>
            <?php while($p = $mais_vendidos->fetch_assoc()): ?>
                <div style="border:1px solid #ccc; padding:16px; width:200px; cursor:pointer;">
                    <?php if (!empty($p['imagem_url'])): ?>
                        <a href="paginaProduto.php?id=<?php echo $p['id']; ?>" style="text-decoration:none;color:inherit;">
                        <img src="../../AdminHeavyWords/<?php echo $p['imagem_url']; ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>" style="max-width:100%;max-height:120px;display:block;margin-bottom:8px;">
                        </a>
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                    <p>Preço: R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
                    <button type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $p['id'] : 'loginCliente.php?add_carrinho=' . $p['id']; ?>'">Comprar</button>
                    <button type="button" onclick="adicionarCarrinho(<?php echo $p['id']; ?>)">Adicionar ao carrinho</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum produto mais vendido.</p>
        <?php endif; ?>
    </div>
    <h2>Promoção</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 24px; margin-top: 32px;">
        <?php
        $promocoes = $conn->query("SELECT id, nome, preco, imagem_url FROM produtos WHERE ativo = 1 AND preco <= 50");
        $produtosPromo = [];
        if ($promocoes && $promocoes->num_rows > 0) {
            while($p = $promocoes->fetch_assoc()) {
                $produtosPromo[] = $p;
            }
            shuffle($produtosPromo);
            $produtosPromo = array_slice($produtosPromo, 0, 6);
            foreach($produtosPromo as $p): ?>
                <div style="border:1px solid #ccc; padding:16px; width:200px; cursor:pointer;">
                    <?php if (!empty($p['imagem_url'])): ?>
                        <a href="paginaProduto.php?id=<?php echo $p['id']; ?>" style="text-decoration:none;color:inherit;">
                        <img src="../../AdminHeavyWords/<?php echo $p['imagem_url']; ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>" style="max-width:100%;max-height:120px;display:block;margin-bottom:8px;">
                        </a>
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                    <p>Preço: R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
                    <button type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $p['id'] : 'loginCliente.php?add_carrinho=' . $p['id']; ?>'">Comprar</button>
                    <button type="button" onclick="adicionarCarrinho(<?php echo $p['id']; ?>)">Adicionar ao carrinho</button>
                </div>
            <?php endforeach;
        } else { ?>
            <p>Nenhum produto em promoção.</p>
        <?php } ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>