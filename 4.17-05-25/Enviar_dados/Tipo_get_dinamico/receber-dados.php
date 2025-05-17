<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receber dados dinamicos via URL</title>
</head>
<body>

    <?php
        // Obtém o valor do parâmetro 'codigo' enviado via URL utilizando o método GET
        $cod = $_GET['codigo'];
        // Exibe o valor do parâmetro 'codigo' na página
        echo $cod;
    ?>
    
</body>
</html>