<?php

$host ='localhost';
$user = 'root';
$password = '';
$db = 'contatos';

$conexao = new mysqli($host, $user, $password, $db);
// usando new mysqli envolver um pouco de POO
// mysqli é uma extensão do PHP que permite interagir com bancos de dados MySQL
// fica um pouco mais enxuto e mais fácil de entender se comparado ao mysqli_connect
if($conexao->connect_error){
    die("Falha na conexão: " . $conexao->connect_error);
}
// else{
//     echo "Conexão realizada com sucesso!";
// }

?>