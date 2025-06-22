<?php
session_start();
include_once '../backend/conexaoCliente.php';

// Paginação
$por_pagina = 16;
$pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) && $_GET['pagina'] > 0 ? intval($_GET['pagina']) : 1;
$offset = ($pagina - 1) * $por_pagina;

// Filtros
$where = ["ativo = 1"];
$params = [];
$tipo_produto = 'livro'; // Para reutilização do filtro em outras páginas, altere este valor conforme necessário

// Filtro por tipo/categoria
$where[] = "(tipo = ? OR categoria_id = 1)";
$params[] = $tipo_produto;

// Filtro por busca
if (!empty($_GET['busca'])) {
    $where[] = "nome LIKE ?";
    $params[] = '%' . $_GET['busca'] . '%';
}

// Filtro por banda
if (!empty($_GET['banda'])) {
    $where[] = "banda = ?";
    $params[] = $_GET['banda'];
}

// Ordenação
$order = "id DESC";
if (!empty($_GET['ordem']) && is_array($_GET['ordem'])) {
    $ordens = [];
    foreach ($_GET['ordem'] as $ordem) {
        switch ($ordem) {
            case 'preco_asc':
                $ordens[] = "preco ASC";
                break;
            case 'preco_desc':
                $ordens[] = "preco DESC";
                break;
            case 'nome_asc':
                $ordens[] = "nome ASC";
                break;
            case 'nome_desc':
                $ordens[] = "nome DESC";
                break;
        }
    }
    if ($ordens) $order = implode(', ', $ordens);
}

// Consulta para total de resultados
$sql_total = "SELECT COUNT(*) as total FROM produtos WHERE " . implode(' AND ', $where);
$stmt_total = $conn->prepare($sql_total);
$types_total = str_repeat('s', count($params));
if ($params) {
    $stmt_total->bind_param($types_total, ...$params);
}
$stmt_total->execute();
$res_total = $stmt_total->get_result();
$total_registros = $res_total->fetch_assoc()['total'];
$stmt_total->close();

$total_paginas = ceil($total_registros / $por_pagina);

// Consulta paginada
$sql = "SELECT id, nome, preco, imagem_url FROM produtos WHERE " . implode(' AND ', $where) . " ORDER BY $order LIMIT $por_pagina OFFSET $offset";
$stmt = $conn->prepare($sql);
$types = str_repeat('s', count($params));
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$livros = $stmt->get_result();
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
    <link rel="stylesheet" href="../assets/css/index.css">
    <div class="produtos_container">
        <div class="produtos_filtro">
            <?php include '../components/filtroCliente.php'; ?>
        </div>
        <div class="section_produtos">
            <h2>Livros</h2>
            <?php if ($livros && $livros->num_rows > 0): ?>
                <div class="grid_produtos">
                    <?php while ($p = $livros->fetch_assoc()): ?>
                        <div class="card_produto">
                            <div class="card_produto_imagem">
                                <?php if (!empty($p['imagem_url'])): ?>
                                    <a href="paginaProduto.php?id=<?php echo $p['id']; ?>">
                                        <img src="../../AdminHeavyWords/assets/img/produtos/livro/<?php echo basename($p['imagem_url']); ?>" alt="<?php echo htmlspecialchars($p['nome']); ?>">
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
                </div>
                <!-- Paginação -->
                <div class="paginacao_produtos">
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <form method="get" style="display:inline;">
                            <?php
                            foreach ($_GET as $key => $value) {
                                if ($key === 'pagina') continue;
                                if (is_array($value)) {
                                    foreach ($value as $v) {
                                        echo '<input type="hidden" name="' . htmlspecialchars($key) . '[]" value="' . htmlspecialchars($v) . '">';
                                    }
                                } else {
                                    echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                                }
                            }
                            ?>
                            <input type="hidden" name="pagina" value="<?php echo $i; ?>">
                            <button type="submit" class="btn_paginacao<?php echo $i == $pagina ? ' ativo' : ''; ?>"><?php echo $i; ?></button>
                        </form>
                    <?php endfor; ?>
                </div>
            <?php else: ?>
                <p>Nenhum livro encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include '../components/rodape.php'; ?>
</body>
</html>
<?php $stmt->close();
$conn->close(); ?>