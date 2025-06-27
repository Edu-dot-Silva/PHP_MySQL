<?php
include_once '../backend/conexaoAdmin.php';

$sql = "SELECT id, nome, email, criado_em FROM usuarios_admin ORDER BY id ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Administradores</title>
    <link rel="stylesheet" href="../assets/css/dash.css">
</head>
<body>
    <?php include_once '../components/topoAdm.php'; ?>
        <?php include_once '../components/navBar.php'; ?>

    <h2>Administradores</h2>
    <a href="../backend/admin/adicionaAdmin.php">Adicionar Administrador</a>
    <a href="dashAdmin.php" style="margin-left:16px;">Voltar</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['criado_em']; ?></td>
                    <td>
                        <form action="../backend/admin/editaAdmin.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="../backend/admin/excluirAdmin.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">Nenhum administrador cadastrado.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
