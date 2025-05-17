    <?php
    include('Vendor/conexao.php');
    // include_once('Vendor/conexao.php');
    // require();
    // require_once();
    // tipos de metodos de inclusão da conexao
    // a diferença entre os dois é que o require nao aceita duplicadas
    ?>

    <!doctype html>
    <html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lista de pessoas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <?php
                $sql = "SELECT * FROM pessoa";
                $resultado = $conexao -> query($sql);

                if($resultado->num_rows > 0){                
            ?>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Telefone</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($linha = $resultado->fetch_assoc()){


        ?>
        <tr>
        <th scope="row"><?= $linha['Id_pessoa']; ?></th>
        <td><?php echo $linha['Nome_pessoa']; ?></td>
        <td><?php echo $linha['Email_pessoa']; ?></td>
        <td><?php echo $linha['Telefone_pessoa']; ?></td>
        <td>
            <a href="">+</a>
            <a href="">Editar</a>
            <a href="deletar.php?id=<?= $linha['Id_pessoa'];?>" onclick="return confirm('Tem certeza que deseja excluir esse registro?')">Excluir</a>
        </td>
        </tr>

        <?php
                }
        ?>
    </tbody>
    </table>

    <?php
    }
    else{
    ?>
        <div class="alert alert-warning">
            <p>Não há registros!</p>
        </div>
    <?php
    }
    ?>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
    </html>

