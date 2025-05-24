<?php
    include('Vendor/conexao.php');
    // include_once('Vendor/conexao.php');
    // require();
    // require_once();
    // tipos de metodos de inclusão da conexao
    // a diferença entre os dois é que o require nao aceita duplicadas

    $id = $_GET['id'];
    $sql = "SELECT * FROM pessoa WHERE Id_pessoa = $id";
    $resultado = $conexao -> query($sql);
    $pessoa = $resultado -> fetch_assoc();
?>

    <!doctype html>
    <html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pessoa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h2>Detalhes do contato</h2>
        </div>
        <ul>
            <li class="list-group-item"><strong>Nome</strong><?php echo $pessoa['Nome_pessoa']?></li>
            <li class="list-group-item"><strong>Email</strong><?php echo $pessoa['Email_pessoa']?></li>
            <li class="list-group-item"><strong>Telefone</strong><?php echo $pessoa['Telefone_pessoa']?></li>
            <li class="list-group-item"><strong>Descrição</strong><?php echo $pessoa['Descricao_pessoa']?></li>
        </ul>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
    </html>

