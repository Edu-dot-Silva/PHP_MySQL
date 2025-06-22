<?php
session_start();
include_once '../backend/conexaoCliente.php';
// Buscar produtos da categoria livros (ajuste o id da categoria conforme seu banco, ou use WHERE tipo = 'livro' se preferir)
$livros = $conn->query("SELECT id, nome, preco, imagem_url FROM produtos WHERE ativo = 1 AND (tipo = 'livro' OR categoria_id = 1)");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
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
    <h2>Livros</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 24px;">
        <?php if ($livros && $livros->num_rows > 0): ?>
            <?php while($p = $livros->fetch_assoc()): ?>
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
            <p>Nenhum livro encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>