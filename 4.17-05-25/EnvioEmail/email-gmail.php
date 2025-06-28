<?php
// para funcionar com gmail deve estar com autenticação em dois fatores
// Inclui os arquivos da biblioteca
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configurações do servidor Gmail SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'email@email.com';      // Seu e-mail
    $mail->Password   = '1234';        // Sua senha de app (não a senha normal)
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remetente e destinatário
    $mail->setFrom('email@email.com', 'Seu Nome');
    $mail->addAddress('email@email.com', 'Destinatário');

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Assunto do e-mail';
    $mail->Body    = '<b>Mensagem em HTML</b>';
    $mail->AltBody = 'Mensagem alternativa em texto puro';

    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}
