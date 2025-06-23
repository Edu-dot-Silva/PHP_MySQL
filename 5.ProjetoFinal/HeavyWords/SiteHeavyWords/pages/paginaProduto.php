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
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/paginaProduto.css">
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
    <?php
    $voltar_url = 'index.php';
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
        if (strpos($referer, 'paginaProduto.php') === false) {
            $voltar_url = $referer;
        }
    }
    ?>
    <div class="section_btnVoltar">
        <a href="<?php echo htmlspecialchars($voltar_url); ?>"><img src="../assets/img/icons/cabecalho-icons/back.png" alt=""></a>
    </div>
    <div class="section_produto">
        <div class="produto_infos">
            <div class="produto_imagem">
                <?php if (!empty($produto['imagem_url'])): ?>
                    <img src="../../AdminHeavyWords/<?php echo $produto['imagem_url']; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                <?php endif; ?>
            </div>

            <div class="informacoes">
                <div class="detalhes_produto">
                    <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
                    <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
                    <p><strong>Banda:</strong> <?php echo htmlspecialchars($produto['banda']); ?></p>
                    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($produto['tipo']); ?></p>
                    <p class="preco-destaque"><strong>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong></p>
                </div>

                <div class="produto_btns">
                    <button class="btn_comprar" type="button" onclick="window.location.href='<?php echo isset($_SESSION['cliente_id']) ? 'comprar.php?id=' . $produto['id'] : 'loginCliente.php?add_carrinho=' . $produto['id']; ?>'">Comprar</button>
                    <button class="btn_adicionar" type="button" onclick="adicionarCarrinho(<?php echo $produto['id']; ?>)">Carrinho</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php include '../components/rodape.php'; ?>
</body>

</html>
<?php $conn->close(); ?>