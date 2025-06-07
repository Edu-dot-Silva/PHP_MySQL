<?php

include_once('conexao.php');
$usario = $_POST['usuario'];
$senha = $_POST['senha'];

$login = "select * from usuario where Email_Usuario = '$usario' and Senha_Usuario = '$senha'";
// echo $login;

$login = mysqli_query($conexao, $login);

if(mysqli_num_rows($login) > 0){
    session_start();
    $_SESSION['usuario_logado'] = $usario;
    $_SESSION['email_logado'] = mysqli_fetch_assoc($login)['Email_Usuario'];
    header('Location: index.php');
}else{
    header("Location: login.php?erro=1");
}

?>