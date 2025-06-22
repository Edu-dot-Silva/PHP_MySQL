<?php
session_start();
include_once '../backend/conexaoCliente.php';
// Mais vendidos: 6 itens com maior vendidos
$mais_vendidos = $conn->query("SELECT id, nome, preco, imagem_url FROM produtos WHERE ativo = 1 AND vendidos > 0 ORDER BY vendidos DESC, id DESC LIMIT 6");
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
    <link rel="stylesheet" href="../assets/css/index.css">
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
    <div class="section_mais_vendidos">
        <div class="grid">
            <?php if ($mais_vendidos && $mais_vendidos->num_rows > 0): ?>
                <?php while($p = $mais_vendidos->fetch_assoc()): ?>
                    <div class="card_produto">
                        <div class="card_produto_imagem">
                            <?php if (!empty($p['imagem_url'])): ?>
                                <a href="paginaProduto.php?id=<?php echo $p['id']; ?>">
                                    <img src="../../AdminHeavyWords/<?php echo $p['imagem_url']; ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>">
                            </a>
                        <?php endif; ?>
                        </div>
                        <div class="card_produto_nome">
                            <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                        </div>
                        <div class="card_produto_preco">
                            <p>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
                        </div>
                        <div class="card_btns">
                            <button class="btn_comprar" type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $p['id'] : 'loginCliente.php?add_carrinho=' . $p['id']; ?>'">Comprar</button>
                            <button class="btn_adicionar" type="button" onclick="adicionarCarrinho(<?php echo $p['id']; ?>)">Carrinho</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum produto mais vendido.</p>
            <?php endif; ?>
        </div>
    </div>
    <h2>Promoção</h2>
    <div class="section_promocao">
        <div class="grid-promocao">
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
                    <div class="card_produto">
                        <div class="card_produto_imagem">
                            <?php if (!empty($p['imagem_url'])): ?>
                                <a href="paginaProduto.php?id=<?php echo $p['id']; ?>">
                                    <img src="../../AdminHeavyWords/<?php echo $p['imagem_url']; ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card_produto_nome">
                            <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                        </div>
                        <div class="card_produto_preco">
                            <p>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
                        </div>
                        <div class="card_btns">
                            <button class="btn_comprar" type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $p['id'] : 'loginCliente.php?add_carrinho=' . $p['id']; ?>'">Comprar</button>
                            <button class="btn_adicionar" type="button" onclick="adicionarCarrinho(<?php echo $p['id']; ?>)">Carrinho</button>
                        </div>
                    </div>
                <?php endforeach;
            } else { ?>
                <p>Nenhum produto em promoção.</p>
            <?php } ?>
        </div>
    </div>
    <!-- Section Novidades -->
    <h2>Novidades</h2>
    <div class="section_novidades">
        <div class="grid-novidades">
            <?php
            $novidades = $conn->query("SELECT id, nome, preco, imagem_url FROM produtos WHERE ativo = 1 ORDER BY criado_em DESC, id DESC LIMIT 6");
            if ($novidades && $novidades->num_rows > 0):
                while($p = $novidades->fetch_assoc()): ?>
                    <div class="card_produto">
                        <div class="card_produto_imagem">
                            <?php if (!empty($p['imagem_url'])): ?>
                                <a href="paginaProduto.php?id=<?php echo $p['id']; ?>">
                                    <img src="../../AdminHeavyWords/<?php echo $p['imagem_url']; ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card_produto_nome">
                            <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                        </div>
                        <div class="card_produto_preco">
                            <p>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
                        </div>
                        <div class="card_btns">
                            <button class="btn_comprar" type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $p['id'] : 'loginCliente.php?add_carrinho=' . $p['id']; ?>'">Comprar</button>
                            <button class="btn_adicionar" type="button" onclick="adicionarCarrinho(<?php echo $p['id']; ?>)">Carrinho</button>
                        </div>
                    </div>
            <?php endwhile;
            else: ?>
                <p>Nenhum produto novo cadastrado.</p>
            <?php endif; ?>
        </div>
    </div>
    <section class="section_loja_fisica">
        <h2>Nossa loja física</h2>
        <div class="section_loja_fisica">
            <iframe 
                src="https://www.google.com/maps?q=Av.+São+João,+439,+São+Paulo,+SP&output=embed"
                class="mapa_loja_fisica"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </section>
    <?php include '../components/rodape.php'; ?>
</body>
</html>
<?php $conn->close(); ?>