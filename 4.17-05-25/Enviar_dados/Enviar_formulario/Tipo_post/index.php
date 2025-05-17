<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario - post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
    <style>
        form{           
            width: 50%;
            margin: auto;
            margin-top:100px;
        }

    </style>
</head>
<body>
   
<div class="container">
<form method="post" action="receber-dados.php">
    <!-- Este formulário utiliza o método POST, que envia os dados pela URL -->
    <!-- Quando for submetido executa o codigo que esta no receber-dados.php  -->
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome">    
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email">    
  </div>

  <div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha">    
  </div>

  
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>