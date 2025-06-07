<?php

session_start();

$_SESSION['nome'] = 'Diego Rodrigues';
$_SESSION['idade'] = 33;

echo $_SESSION['nome'];
echo $_SESSION['idade'];
?>


<a href="pagina2.php">Página 2</a>