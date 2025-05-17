<?php
include 'Vendor/conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM pessoa WHERE Id_pessoa = $id";

$conexao->query($sql);

header("Location: index.php");
exit();
?>