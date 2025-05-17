<?php

// Exibe os dados enviados pelo método GET
print_r($_GET);

// Obtém os valores enviados pelo formulário via GET
$nome  = $_GET['nome'];
$email = $_GET['email'];
$senha = $_GET['senha'];

// Exibe os valores recebidos
echo $nome . "<br>";
echo $email . "<br>";
echo $senha . "<br>";

// O método GET é usado para enviar dados anexados à URL.
// É mais adequado para consultas ou envio de dados não sensíveis, pois os dados ficam visíveis na barra de endereço.

?>