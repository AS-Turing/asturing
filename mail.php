<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$config = require __DIR__ . '/.env.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

$mail = new PHPMailer(true);

header('Content-Type: application/json');


$firstname = htmlspecialchars($_POST['firstname'] ?? '');
$lastname = htmlspecialchars($_POST['lastname'] ?? '');
$email = filter_var($_POST['mail'] ?? '', FILTER_VALIDATE_EMAIL);
$message = htmlspecialchars($_POST['message'] ?? '');

if (!$firstname || !$lastname || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Champs requis manquants ou invalides']);
    exit;
}

$to = "alexandre@as-turing.fr";
$subject = "Nouveau message depuis le formulaire AS-Turing";
$body = "Nom : $lastname $firstname\n";
$body .= "Email : $email\n\n";
$body .= "Message :\n$message";

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = $config['SMTP_HOST'];
    $mail->Username   = $config['SMTP_USERNAME'];
    $mail->Password   = $config['SMTP_PASSWORD'];
    $mail->Port       = $config['SMTP_PORT'];//Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

    $mail->addAddress('alexandre@as-turing.fr');
    $mail->addReplyTo($email, "$firstname $lastname");

    $mail->isHTML(true);
    $mail->Subject = 'Un nouveau message depuis le formulaire AS-Turing';
    $mail->Body    = "
        <h2>Nouveau message via AS-Turing.fr</h2>
        <p><strong>Nom :</strong> $lastname $firstname</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Message :</strong><br>$message</p>
    ";

    $mail->AltBody = $body;
    $mail->SMTPDebug = 0;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}