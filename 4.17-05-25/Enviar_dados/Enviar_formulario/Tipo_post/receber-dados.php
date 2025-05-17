<?php

// Exibe os dados enviados pelo método POST
print_r($_POST);

// Obtém os valores enviados pelo formulário via POST
$nome  = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Exibe os valores recebidos
echo $nome . "<br>";
echo $email . "<br>";
echo $senha . "<br>";

// O método POST é usado para enviar dados de forma mais segura, pois os dados não aparecem na URL.
// É ideal para envio de informações sensíveis, como senhas.

?>