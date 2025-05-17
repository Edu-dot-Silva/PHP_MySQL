<?php
// Define o endereço do servidor do banco de dados
$servidor = "localhost";

// Define o nome de usuário do banco de dados
$usuario = "root";

// Define a senha do banco de dados
$senha = "";

// Define o nome do banco de dados
$banco = "contatos";

// Desativa os relatórios de erro do MySQLi
mysqli_report(MYSQLI_REPORT_OFF);
// desbloqueia a função que alerta erros

// Estabelece uma conexão com o banco de dados
$conexao = @mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se houve falha na conexão
if (mysqli_connect_errno()) {
    // Encerra o script e exibe uma mensagem de erro caso a conexão falhe
    die("Erro na conexão: (" . mysqli_connect_errno() . "): " . mysqli_connect_error());
}
else{
    echo "Conexão bem-sucedida!";
}

// Define uma consulta SQL para selecionar todos os registros da tabela "PESSOA"
$consulta = "SELECT * FROM PESSOA";

// Executa a consulta SQL e armazena o resultado
$resultado = mysqli_query($conexao, $consulta);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão</title>
</head>
<body>

<?php
// Percorre cada registro no resultado da consulta
while ($linha = mysqli_fetch_assoc($resultado)) {
    // Exibe o registro completo para fins de depuração
    // print_r($linha);

    // Exibe os detalhes do registro de forma formatada
    echo "<div>";
    echo "<p> ID: " . $linha['Id_pessoa'] . "</p>";
    echo "<p> NOME: " . $linha['Nome_pessoa'] . "</p>";
    echo "<p> E-MAIL: " . $linha['Email_pessoa'] . "</p>";
    echo "<p> TELEFONE: " . $linha['Telefone_pessoa'] . "</p>";
    echo "<p> DESCRIÇÃO: " . $linha['Descricao_pessoa'] . "</p>";
    echo "<hr>";
    echo "</div>";
}
?>

<table>
<?php
// Percorre novamente cada registro para exibi-lo em formato de tabela
while ($linha = mysqli_fetch_assoc($resultado)) {
?>

<tr>
    <!-- Exibe o ID do registro -->
    <td><?= $linha['Id_Pessoa'] ?></td>
    <!-- Exibe o nome do registro -->
    <td><?php echo $linha['Nome_Pessoa'] ?></td>
    <!-- Exibe o e-mail do registro -->
    <td><?php echo $linha['Email_Pessoa'] ?></td>
</tr>

<?php
}
?>
</table>

</body>
</html>

