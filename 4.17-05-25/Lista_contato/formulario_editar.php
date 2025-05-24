<?php
    include_once 'vendor/conexao.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM pessoa WHERE Id_pessoa = $id";

    $resultado = $conexao -> query($sql);
    $pessoa = $resultado -> fetch_assoc();
    // fetch_assoc tranforma o resultado em array associativo
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar contato</h2>
    <form action="editar.php" method="POST">
        <div class="mb-3">
        <input type="hidden" name="id" value="<?php echo $pessoa['Id_pessoa'];?>">
        <label for="" class="form-label">Nome:</label>
        <input value="<?php echo $pessoa['Nome_pessoa'];?>" type="text" class="form-control" name="nome" id="">
        </div>
        <div class="mb-3">
        <label for="" class="form-label">E-mail:</label>
        <input value="<?php echo $pessoa['Email_pessoa'];?>" type="email" class="form-control" name="email" id="">
        </div>
        <div class="mb-3">
        <label for="" class="form-label">Telefone:</label>
        <input value="<?php echo $pessoa['Telefone_pessoa'];?>" type="text" class="form-control" name="telefone" id="">
        </div>
        <div class="mb-3">
        <label for="" class="form-label">Descrição:</label>
        <textarea name="descricao" class="form-control"></textarea>
        </div>
        <input type="submit" value="Salvar" class="btn btn-primary">
    </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>