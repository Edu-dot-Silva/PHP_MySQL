<?php
session_start();
include_once '../backend/conexaoAdmin.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $sql = "SELECT nome, senha FROM usuarios_admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ((isset($row['senha']) && password_verify($senha, $row['senha'])) || (isset($row['senha']) && $senha === $row['senha'])) {
            $_SESSION['admin_nome'] = $row['nome'];
            header('Location: dashAdmin.php');
            exit;
        } else {
            $msg = "Senha incorreta.";
        }
    } else {
        $msg = "E-mail não encontrado.";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>HeavyWords - Admin</title>
</head>
<body>
    <h2>Login Administrador</h2>
    <?php if (!empty($msg)) echo '<p style="color:red;">' . $msg . '</p>'; ?>
    <form method="POST">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
