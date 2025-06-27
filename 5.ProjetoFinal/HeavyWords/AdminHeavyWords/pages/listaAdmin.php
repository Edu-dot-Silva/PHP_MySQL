<?php
include_once '../backend/conexaoAdmin.php';

$sql = "SELECT id, nome, email, criado_em FROM usuarios_admin ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Administradores</title>
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link rel="stylesheet" href="../assets/css/lista.css">
</head>

<body>
    <?php include_once '../components/topoAdm.php'; ?>
    <?php include_once '../components/navBar.php'; ?>
    <div class="container-lista">
        <h2>Administradores</h2>
        <a href="../backend/admin/adicionaAdmin.php" class="btn_adicionar" style="text-decoration: none;">Adicionar Administrador</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['criado_em']; ?></td>
                        <td>
                            <div class="acoes-btns">
                                <form action="../backend/admin/editaAdmin.php" method="GET">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button class="btn_admin btn_editar" type="submit">
                                        <img src="../assets/img/icons/edit.png" alt="Editar">
                                    </button>
                                </form>
                                <form action="../backend/admin/excluirAdmin.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
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
                <tr>
                    <td colspan="5">Nenhum administrador cadastrado.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>
<?php $conn->close(); ?>