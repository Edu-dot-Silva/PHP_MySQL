<?php
include_once '../backend/conexaoAdmin.php';
// Buscar o id da categoria Cd
$idCd = null;
$catResult = $conn->query("SELECT id FROM categorias WHERE LOWER(nome) = 'cd' LIMIT 1");
if ($catResult && $catResult->num_rows > 0) {
    $cat = $catResult->fetch_assoc();
    $idCd = $cat['id'];
}
// Altere ORDER BY id ASC para ORDER BY id DESC
$sql = "SELECT id, nome, descricao, preco, estoque, vendidos, banda, tipo, ativo, criado_em FROM produtos WHERE categoria_id = $idCd ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de CDs</title>
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link rel="stylesheet" href="../assets/css/lista.css">
</head>
<body>
    <?php include_once '../components/topoAdm.php'; ?>
    <?php include_once '../components/navBar.php'; ?>

    <div class="container-lista">
        <h2>CDs</h2>
        <a href="../backend/cd/adicionarCd.php" class="btn_adicionar" style="text-decoration: none;">Adicionar CD</a>

        <div class="container-tabela-wrapper">
            <table>
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
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td><?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $row['estoque']; ?></td>
                            <td><?php echo $row['vendidos']; ?></td>
                            <td><?php echo htmlspecialchars($row['banda']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                            <td><?php echo $row['ativo'] ? 'Sim' : 'Não'; ?></td>
                            <td><?php echo $row['criado_em']; ?></td>
                            <td>
                                <div class="acoes-btns">
                                    <form action="../backend/cd/editarCd.php" method="GET">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button class="btn_admin btn_editar" type="submit">
                                            <img src="../assets/img/icons/edit.png" alt="Editar">
                                        </button>
                                    </form>
                                    <form action="../backend/cd/excluirCd.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button class="btn_admin btn_excluir" type="submit">
                                            <img src="../assets/img/icons/trash.png" alt="Excluir">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="11">Nenhum CD cadastrado.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
