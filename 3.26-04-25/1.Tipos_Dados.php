<?php
echo "<h1>Tipos de Dados</h1><br>";

$string = "isso é uma string";

$idade = 10;

$frase = "Ele tem ";

echo "<p>" . $frase . $idade . " anos</p>";

$ola = "Ola! ";
$bem_vindo = "Bem Vindo ";

echo $ola . $bem_vindo  . $string . "<br>";

$float = 50.99;

$boolean = true;

$tamanho_string = strlen($string);
// metodo que retorna tamanho da string

echo "'" . $string ."'" . " tem tamanho ". $tamanho_string . "<br>";

echo stripos($string, "a");
// metodo que retorna a posicao de um char

echo stripos($string, "o");

echo strpos($string, "s");
// retorna a posicao da primeira ocorrencia diferenciando maisculas de minisculas

echo "<hr>";

// calculos
$numero1 = 10;
$numero2 = 5;

$adicao = $numero1 + $numero2;
echo "A soma de $numero1 + $numero2 = $adicao <br>";

$subtracao= $numero1 - $numero2;
echo "A subtracao de $numero1 - $numero2 = $subtracao <br>";

$divisao = $numero1 / $numero2;
echo "A divisao de $numero1 / $numero2 = $divisao <br>";

$multiplicacao = $numero1 * $numero2;
echo "A multiplicacao de $numero1 * $numero2 = $multiplicacao <br>";

$modulo = $numero1 % $numero2;
echo "O modulo de $numero1 % $numero2 = $modulo <br>";

$exponenciacao = $numero1 ** $numero2;
echo "A exponenciacao de $numero1 ** $numero2 = $exponenciacao <br>";

$raizCubica = pow($numero1, $numero2);
echo "A raiz cubica de $numero1 por $numero2 = $raizCubica <br>";

$raizQuadrada = sqrt($numero1);
echo "A raiz quadrada de $numero1 = $raizQuadrada <br>";

$incremento = $numero1++;
echo "O incremento de $numero1 = $incremento <br>";

$decremento = $numero1--;
echo "O decremento de $numero1 = $decremento <br>";

?>