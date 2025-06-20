<?php
include_once 'conexao_cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    if ($nome && $email && $senha) {
        // Salt de 22 caracteres para bcrypt
        $salt = substr(md5($senha . $email), 0, 22);
        $custo = "06";
        $senhaCriptografada = crypt($senha, "$2y$" . $custo . "$" . $salt . "$" );
        $sql = "INSERT INTO clientes (nome, email, senha, criado_em) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $nome, $email, $senhaCriptografada);
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Preencha todos os campos.";
    }
} else {
    echo "Requisição inválida.";
}
$conn->close();
?>
