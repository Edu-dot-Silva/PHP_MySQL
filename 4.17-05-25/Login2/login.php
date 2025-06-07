<?php
include_once 'conexao.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // echo $usuario;
    // echo $senha;
    // print_r($_POST);

    $sql = "SELECT * from usuario WHERE Email_Usuario = '$usuario'";
    $resultado = $conexao->query($sql);

    if($resultado && $resultado->num_rows == 1){
        $row = $resultado->fetch_assoc();
        $senhaDB = $row['Senha_Usuario'];

        $salt = md5($senha . $usuario);
        $custo = '06';
        $senhaVerificada = crypt($senha, '$2b$' . $custo . '$' . $salt . '$');

        // echo $senhaDB . '<br>' . $senhaVerificada;
    
        if($senhaDB === $senhaVerificada){
            echo 'Login realizado com sucesso'; 
            session_start();
            $_SESSION['usuario_id'] = $row['Id_Usuario'];
            $_SESSION['usuario_email'] = $row['Email_Usuario'];
            header('Location: index.php');
        }else{
            echo 'Senha incorreta';
        }
    }else{
        echo 'Usuario não encontrado';
}
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <input type="text" placeholder="Digite seu email" name="usuario">
        <input type="password" placeholder="Digite sua senha" name="senha">
        <input type="submit" value="Entrar">
    </form>
</body>
</html>