<?php
$idade = 18;

if ($idade >= 18) {
    echo "Você é maior de idade.";
} else {
    echo "Você é menor de idade.";
}

echo "<hr>";

if ($idade < 13) {
    echo "Você é criança.";
} 
elseif($idade >= 13 && $idade < 18) {
    echo "Você é adolescente.";
}
else {
    echo "Você é adulto.";
}

echo "<hr>";    

// switch case
$dia_semana = 5;
switch ($dia_semana) {
    case 1:
        echo "Domingo";
        break;
    case 2:
        echo "Segunda-feira";
        break;
    case 3:
        echo "Terça-feira";
        break;
    case 4:
        echo "Quarta-feira";
        break;
    case 5:
        echo "Quinta-feira";
        break;
    case 6:
        echo "Sexta-feira";
        break;
    case 7:
        echo "Sábado";
        break;
    default:
        echo "Dia inválido.";
}

?>