<?php
session_start();
include_once '../backend/conexaoCliente.php';

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

$sql = "SELECT id, nome, preco, imagem_url FROM produtos WHERE " . implode(' AND ', $where) . " ORDER BY $order";
$stmt = $conn->prepare($sql);

// Bind dinâmico
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
    <h2>Livros</h2>
    <?php include '../components/filtroCliente.php'; ?>
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
<?php $stmt->close(); $conn->close(); ?>