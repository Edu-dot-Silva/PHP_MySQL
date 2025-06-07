<h1>Página protegida</h1>
<a href="logout.php">Sair</a>
<?php
session_start();

echo $_SESSION['usuario_logado'];

if(!isset($_SESSION['usuario_logado'])){
    header('Location: login.php');
    exit();
}

?>

<?php
// session_start();

// echo $_SESSION['usuario_logado'];

?>