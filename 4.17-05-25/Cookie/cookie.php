<?php
setcookie("usuario", "Eduardo", time() + 10);

$array = ['livro1', 'livro2', 'livro3'];
setcookie('meu_array',json_encode($array), time() + 3600);

if(isset($_COOKIE['meu_array'])){
    $array = json_decode($_COOKIE['meu_array'], true);

    print_r($array);    
}

// echo $_COOKIE['usuario'];
?>