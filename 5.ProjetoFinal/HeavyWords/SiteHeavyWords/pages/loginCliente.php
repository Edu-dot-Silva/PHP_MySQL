<?php
session_start();
include_once '../backend/conexaoCliente.php';
$msg_login = '';
$msg_cadastro = '';
// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email_login']);
    $senha = $_POST['senha_login'];
    $sql = "SELECT id, senha FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $cli = $result->fetch_assoc()) {
        if (password_verify($senha, $cli['senha'])) {
            $_SESSION['cliente_id'] = $cli['id'];
            header('Location: index.php');
            exit;
        } else {
            $msg_login = 'Senha incorreta.';
        }
    } else {
        $msg_login = 'Email não encontrado.';
    }
    $stmt->close();
}
// Cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    if ($senha !== $senha2) {
        $msg_cadastro = 'As senhas não coincidem.';
    } else {
        $sql = "SELECT id FROM clientes WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $msg_cadastro = 'Email já cadastrado.';
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql2 = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param('sss', $nome, $email, $senha_hash);
            if ($stmt2->execute()) {
                $_SESSION['cliente_id'] = $stmt2->insert_id;
                header('Location: index.php');
                exit;
            } else {
                $msg_cadastro = 'Erro ao cadastrar.';
            }
            $stmt2->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login/Cadastro Cliente</title>
</head>
<body>
    <h2>Login</h2>
    <?php if ($msg_login) echo '<p style="color:red">' . $msg_login . '</p>'; ?>
    <form method="POST">
        <input type="hidden" name="login" value="1">
        <label for="email_login">Email:</label>
        <input type="email" id="email_login" name="email_login" required><br><br>
        <label for="senha_login">Senha:</label>
        <input type="password" id="senha_login" name="senha_login" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <hr>
    <h2>Cadastro</h2>
    <?php if ($msg_cadastro) echo '<p style="color:red">' . $msg_cadastro . '</p>'; ?>
    <form method="POST">
        <input type="hidden" name="cadastrar" value="1">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <label for="senha2">Confirmar Senha:</label>
        <input type="password" id="senha2" name="senha2" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
<?php $conn->close(); ?>
