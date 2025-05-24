<?php
require_once 'vendor/conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$descricao = $_POST['descricao'];

$sql = "UPDATE pessoa SET 
    Nome_pessoa = '$nome', 
    Email_pessoa = '$email', 
    Telefone_pessoa = '$telefone', 
    Descricao_pessoa = '$descricao' 
    WHERE Id_pessoa = $id"; 

// echo $sql;

$conexao->query($sql);
header("Location: index.php");
?>