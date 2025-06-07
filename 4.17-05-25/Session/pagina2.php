<?php
session_start();
echo $_SESSION['nome'];
echo $_SESSION['idade'];
?>

<a href="logout.php">Sair</a>