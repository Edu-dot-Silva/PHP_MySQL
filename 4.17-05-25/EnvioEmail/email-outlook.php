<?php

// https://github.com/sendmail/sendmail
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// aplicação simples em um formulario com action apontando para esse arquivo
// if($_POST){
//     $nome = $_POST['nome'];
//     $email = $_POST['email'];
//     $mensagem = $_POST['mensagem'];

//     echo $nome;
//     echo $email;
//     echo $mensagem;

//     $msg = "Nome:$nome <br> - Email: $email <br> - Mensagem - $mensagem";
// }

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP do Outlook
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'email@email.com'; // seu e-mail Outlook/Hotmail
    $mail->Password   = '1234';         // sua senha da conta
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remetente e destinatário
    $mail->setFrom('email@email.com', 'Seu Nome');
    $mail->addAddress('email@email.com', 'Destinatário');

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Assunto de teste';
    $mail->Body    = $msg;
    $mail->AltBody = 'Essa é uma mensagem de texto simples.';

    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}
