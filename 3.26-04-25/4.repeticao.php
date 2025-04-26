<?php
for($i = 0; $i <= 10; $i++){
    echo "O valor de i é: $i <br>";
}
echo "<hr>";

// estrutura while
$contador = 0;
while($contador <= 10){
    echo "O valor de contador é: $contador <br>";
    $contador++;
}
echo "<hr>";

// estrtura do while
$contador = 0;
do{
    echo "O valor de contador é: $contador <br>";
    $contador++;
}
while($contador <= 10);

echo "<hr>";

// estrutura foreach
$frutas = [
    "laranja",
    "maça",
    "banana",
    "uva",
    "abacaxi"
];

foreach($frutas as $fruta){
    echo "A fruta é: $fruta <br>";
}

echo "<hr>";

// percorrendo o mesmo array com for
for($i = 0;$i < sizeof($frutas); $i++){
    echo "A fruta é: $frutas[$i] <br>";

}
?>