<?php
include_once '../conexaoAdmin.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $repete = trim($_POST['repete_senha']);
    if ($nome && $email && $senha && $repete) {
        if ($senha === $repete) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios_admin (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $nome, $email, $senha_hash);
            if ($stmt->execute()) {
                $msg = "Administrador cadastrado com sucesso!";
                header("Location: ../../pages/listaAdmin.php");
            } else {
                $msg = "Erro ao cadastrar: " . $conn->error;
            }
            $stmt->close();
        } else {
            $msg = "As senhas não coincidem.";
        }
    } else {
        $msg = "Preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Administrador</title>
</head>
<body>
    <h2>Adicionar Administrador</h2>
    <?php if ($msg) echo '<p>' . $msg . '</p>'; ?>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <label for="repete_senha">Repetir Senha:</label>
        <input type="password" id="repete_senha" name="repete_senha" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="../../pages/listaAdmin.php">Voltar para lista</a>
</body>
</html>
<?php $conn->close(); ?>