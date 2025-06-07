<?php
$usario = $_POST['usuario'];
$senha = $_POST['senha'];

if($usario == 'admin' && $senha == '1234'){
    // echo 'tudo certo';
    session_start();
    $_SESSION['usuario_logado'] = $usario;

    header("Location: index.php");
}else{
    echo 'Usuário ou senha inválidos!';
}

?>