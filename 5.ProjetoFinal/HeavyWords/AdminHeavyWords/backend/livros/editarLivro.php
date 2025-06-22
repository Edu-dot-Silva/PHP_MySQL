<?php
include_once '../conexaoAdmin.php';
$msg = '';
// Buscar categorias
$categorias = [];
$catResult = $conn->query("SELECT id, nome FROM categorias ORDER BY nome ASC");
if ($catResult && $catResult->num_rows > 0) {
    while($cat = $catResult->fetch_assoc()) {
        $categorias[] = $cat;
    }
}
// Buscar dados do livro
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $livro = $result->fetch_assoc();
    $stmt->close();
    if (!$livro) {
        echo 'Livro não encontrado.';
        exit;
    }
} else {
    echo 'ID não informado.';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['estoque']);
    $banda = trim($_POST['banda']);
    $tipo = trim($_POST['tipo']);
    $categoria_id = intval($_POST['categoria_id']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $imagem_url = $livro['imagem_url'];
    if (isset($_FILES['imagem_url']) && $_FILES['imagem_url']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem_url']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid('produto_') . '.' . $ext;
        $destino = '../../assets/img/produtos/livro/' . $nome_arquivo;
        if (move_uploaded_file($_FILES['imagem_url']['tmp_name'], $destino)) {
            $imagem_url = 'assets/img/produtos/livro/' . $nome_arquivo;
        } else {
            $msg = 'Erro ao fazer upload da imagem.';
        }
    }
    if ($nome && $preco && $estoque && $tipo && $categoria_id && !$msg) {
        $sql = "UPDATE produtos SET nome=?, descricao=?, preco=?, estoque=?, banda=?, tipo=?, categoria_id=?, imagem_url=?, ativo=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssddisssii', $nome, $descricao, $preco, $estoque, $banda, $tipo, $categoria_id, $imagem_url, $ativo, $id);
        if ($stmt->execute()) {
            $msg = 'Livro atualizado com sucesso!';
            header('Location: ../../pages/listaLivros.php');
            exit;
        } else {
            $msg = 'Erro ao atualizar: ' . $conn->error;
        }
        $stmt->close();
    } else if (!$msg) {
        $msg = 'Preencha todos os campos obrigatórios.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <h2>Editar Livro</h2>
    <?php if ($msg) echo '<p>' . $msg . '</p>'; ?>
    <form method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($livro['nome']); ?>" required><br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($livro['descricao']); ?></textarea><br><br>
        <label for="preco">Preço:</label>
        <input type="number" step="0.01" id="preco" name="preco" value="<?php echo $livro['preco']; ?>" required><br><br>
        <label for="estoque">Estoque:</label>
        <input type="number" id="estoque" name="estoque" value="<?php echo $livro['estoque']; ?>" required><br><br>
        <label for="banda">Banda:</label>
        <input type="text" id="banda" name="banda" value="<?php echo htmlspecialchars($livro['banda']); ?>"><br><br>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($livro['tipo']); ?>" required><br><br>
        <label for="categoria_id">Categoria:</label>
        <select id="categoria_id" name="categoria_id" required readonly disabled>
            <?php
            $idLivro = '';
            foreach($categorias as $cat) {
                if (strtolower($cat['nome']) === 'livros') {
                    $idLivro = $cat['id'];
                    break;
                }
            }
            ?>
            <option value="<?php echo $idLivro; ?>" selected>Livros</option>
        </select>
        <input type="hidden" name="categoria_id" value="<?php echo $idLivro; ?>">
        <br><br>
        <label for="imagem_url">Imagem atual:</label>
        <?php if ($livro['imagem_url']): ?>
            <img src="../../<?php echo $livro['imagem_url']; ?>" alt="Imagem atual" style="max-width:120px;max-height:120px;"><br>
        <?php endif; ?>
        <label for="imagem_url">Nova Imagem (opcional):</label>
        <input type="file" id="imagem_url" name="imagem_url" accept="image/*"><br><br>
        <label for="ativo">Ativo:</label>
        <input type="checkbox" id="ativo" name="ativo" <?php if($livro['ativo']) echo 'checked'; ?>><br><br>
        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="../../pages/listaLivros.php">Voltar para lista</a>
</body>
</html>
<?php $conn->close(); ?>
