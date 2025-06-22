<?php
include_once '../backend/conexaoAdmin.php';
// Buscar o id da categoria Vinil
$idVinil = null;
$catResult = $conn->query("SELECT id FROM categorias WHERE LOWER(nome) = 'vinil' LIMIT 1");
if ($catResult && $catResult->num_rows > 0) {
    $cat = $catResult->fetch_assoc();
    $idVinil = $cat['id'];
}
$sql = "SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE categoria_id = $idVinil ORDER BY id ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Vinil</title>
</head>
<body>
    <h2>Vinil</h2>
    <a href="../backend/vinil/adicionarVinil.php">Adicionar Vinil</a>
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
                        <form action="../backend/vinil/editarVinil.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="../backend/vinil/excluirVinil.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="11">Nenhum vinil cadastrado.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
