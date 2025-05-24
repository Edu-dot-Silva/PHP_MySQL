<?php
require_once 'vendor/conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$descricao = $_POST['descricao'];

// print_r($_POST);
// teste para verificar o que vem do formulario

$sql = "insert into pessoa(Nome_pessoa, Email_pessoa, Telefone_pessoa, Descricao_pessoa) values ('$nome', '$email', '$telefone', '$descricao')";

// echo $sql;

$conexao->query($sql);
header("Location: index.php");
?>