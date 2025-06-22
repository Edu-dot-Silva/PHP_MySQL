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
// Descobrir o id da categoria Acessórios
$idAcessorio = '';
foreach($categorias as $cat) {
    if (strtolower($cat['nome']) === 'acessórios' || strtolower($cat['nome']) === 'acessorios') {
        $idAcessorio = $cat['id'];
        break;
    }
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
    $imagem_url = '';
    if (isset($_FILES['imagem_url']) && $_FILES['imagem_url']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem_url']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid('produto_') . '.' . $ext;
        $destino = '../../assets/img/produtos/' . $nome_arquivo;
        if (move_uploaded_file($_FILES['imagem_url']['tmp_name'], $destino)) {
            $imagem_url = 'assets/img/produtos/' . $nome_arquivo;
        } else {
            $msg = 'Erro ao fazer upload da imagem.';
        }
    }
    if ($nome && $preco && $estoque && $tipo && $categoria_id && !$msg) {
        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, banda, tipo, categoria_id, imagem_url, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssdisissi', $nome, $descricao, $preco, $estoque, $banda, $tipo, $categoria_id, $imagem_url, $ativo);
        if ($stmt->execute()) {
            $msg = 'Produto cadastrado com sucesso!';
            header('Location: ../../pages/listaAcessorios.php');
        } else {
            $msg = 'Erro ao cadastrar: ' . $conn->error;
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
    <title>Adicionar Acessório</title>
</head>
<body>
    <h2>Adicionar Acessório</h2>
    <?php if ($msg) echo '<p>' . $msg . '</p>'; ?>
    <form method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br><br>
        <label for="preco">Preço:</label>
        <input type="number" step="0.01" id="preco" name="preco" required><br><br>
        <label for="estoque">Estoque:</label>
        <input type="number" id="estoque" name="estoque" required><br><br>
        <label for="banda">Banda:</label>
        <input type="text" id="banda" name="banda"><br><br>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" required><br><br>
        <label for="categoria_id">Categoria:</label>
        <select id="categoria_id" name="categoria_id" required readonly disabled>
            <option value="<?php echo $idAcessorio; ?>" selected>Acessório</option>
        </select>
        <input type="hidden" name="categoria_id" value="<?php echo $idAcessorio; ?>">
        <br><br>
        <label for="imagem_url">Imagem:</label>
        <input type="file" id="imagem_url" name="imagem_url" accept="image/*" required><br><br>
        <label for="ativo">Ativo:</label>
        <input type="checkbox" id="ativo" name="ativo" checked><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="../../pages/listaAcessorios.php">Voltar para lista</a>
</body>
</html>
<?php $conn->close(); ?>