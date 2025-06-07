
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="verificar2.php" method="POST">
        <input type="text" placeholder="Digite seu email" name="usuario">
        <input type="password" placeholder="Digite sua senha" name="senha">
        <input type="submit" value="Entrar">
    </form>

    <?php
        if(!isset($_GET['erro']) == 0){
            echo "<p style='color:red'>Usuário ou senha inválidos!</p>";
        }

        if($_GET['erro'] ?? 0){
            echo "<p style='color:red'>Usuário ou senha inválidos!</p>";
        }
    ?>
</body>
</html>