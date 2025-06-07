<?php 
include_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == 'POST' ){
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);


    // echo "senha = ". $senha;

    // echo "<br>";

    $salt = md5($senha . $usuario);
    // echo "senha criptografada = " . $salt;

    $custo = "06";

    $senhaCriptografada = crypt($senha, "$2b$" . $custo . "$" . $salt . "$" );

    echo $senhaCriptografada;

    $sql = "insert into usuario(Email_Usuario,Senha_Usuario)values('$usuario','$senhaCriptografada')";
    
    // mysqli_query($conexao, $sql)
    if($conexao->query($sql)){
        echo "Usuario cadastrado com sucesso!";
    }else{
        echo "Erro ao cadastrar usuario";
    }


    // $senhaDescript = md5($senhaCripto);
    // echo "senha descriptografada = " . $senhaDescript;


}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form method="POST">
        <input type="text" placeholder="Digite seu email" name="usuario">
        <input type="password" placeholder="Digite sua senha" name="senha">
        <input type="submit" value="Entrar">
    </form>
</body>
</html>