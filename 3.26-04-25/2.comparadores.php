<?php
$numero1 = 10;
$numero2 = 15;

$igual = $numero1 == $numero2; 
echo "Igual = " . $igual; // false

echo "<br>";    

$diferente = $numero1 != $numero2;
echo "Diferente = " . $diferente; // true
echo "<br>";

$Tipoigual = $numero1 === $numero2;
echo "Igual tipo = " . $Tipoigual; // false
echo "<br>";

$diferenteTipo = $numero1 !== $numero2;
echo "Diferente tipo = " . $diferenteTipo; // true
echo "<br>";

$maior = $numero1 > $numero2;
echo "Maior = " . $maior; // false
echo "<br>";

$menor = $numero1 < $numero2;
echo "Menor = " . $menor; // true
echo "<br>";
?>