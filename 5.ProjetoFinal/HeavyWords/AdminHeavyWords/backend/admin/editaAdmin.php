<?php
include_once '../conexaoAdmin.php';

// Busca os dados do admin pelo id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT id, nome, email FROM usuarios_admin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "ID não informado.";
    exit;
}

// Atualiza os dados se enviado via POST
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = trim($_POST['nome']);
    $novo_email = trim($_POST['email']);
    $nova_senha = trim($_POST['senha']);
    if ($nova_senha !== '') {
        $senha = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios_admin SET nome = ?, email = ?, senha = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $novo_nome, $novo_email, $senha, $id);
    } else {
        $sql = "UPDATE usuarios_admin SET nome = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $novo_nome, $novo_email, $id);
    }
    if ($stmt->execute()) {
        $msg = "Dados atualizados com sucesso!";
        // Atualiza os dados exibidos
        $admin['nome'] = $novo_nome;
        $admin['email'] = $novo_email;
        header("Location: ../pages/listaAdmin.php");
        exit;
    } else {
        $msg = "Erro ao atualizar: " . $conn->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Administrador</title>
</head>
<body>
    <h2>Editar Administrador</h2>
    <?php if (!empty($msg)) echo '<p>' . $msg . '</p>'; ?>
    <form method="POST" id="form-edita-admin">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($admin['nome']); ?>" required><br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required><br><br>
        <label for="senha">Nova Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Deixe em branco para não alterar"><br><br>
        <label for="repete_senha">Repetir Nova Senha:</label>
        <input type="password" id="repete_senha" name="repete_senha" placeholder="Repita a nova senha"><br>
        <span id="erro-senha" style="color:red;"></span><br>
        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="../../pages/listaAdmin.php">Voltar</a>
    <script src="../assets/js/validaUpdateSenhaAdmin.js"></script>
</body>
</html>
<?php $conn->close(); ?>