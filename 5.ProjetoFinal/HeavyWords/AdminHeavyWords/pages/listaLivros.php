<?php
include_once '../backend/conexaoAdmin.php';
// Buscar o id da categoria Livros
$idLivros = null;
$catResult = $conn->query("SELECT id FROM categorias WHERE LOWER(nome) = 'livros' LIMIT 1");
if ($catResult && $catResult->num_rows > 0) {
    $cat = $catResult->fetch_assoc();
    $idLivros = $cat['id'];
}
// Altere ORDER BY id ASC para ORDER BY id DESC
$sql = "SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE categoria_id = $idLivros ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
</head>
<body>
    <h2>Livros</h2>
    <a href="../backend/livros/adicionaLivros.php">Adicionar Livros</a>
    <a href="dashAdmin.php">Voltar</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Vendidos</th>
            <th>Banda</th>
            <th>Tipo</th>
            <th>Ativo</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['descricao']; ?></td>
                    <td><?php echo $row['preco']; ?></td>
                    <td><?php echo $row['estoque']; ?></td>
                    <td><?php echo $row['vendidos']; ?></td>
                    <td><?php echo $row['banda']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td><?php echo $row['ativo'] ? 'Sim' : 'Não'; ?></td>
                    <td><?php echo $row['criado_em']; ?></td>
                    <td>
                        <form action="../backend/livros/editarLivro.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="../backend/livros/excluirLivro.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="11">Nenhum produto cadastrado.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
