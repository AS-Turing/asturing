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
$company = htmlspecialchars($_POST['company']);
$email = filter_var($_POST['mail'] ?? '', FILTER_VALIDATE_EMAIL);
$phone = htmlspecialchars($_POST['phone']);
$message = htmlspecialchars($_POST['message'] ?? '');

if (!$firstname || !$lastname || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Champs requis manquants ou invalides']);
    exit;
}

$to = "alexandre@as-turing.fr";
$subject = "Nouveau message depuis le formulaire AS-Turing";
$body = "Nom : $lastname $firstname\n";
$body .= "Entreprise : $company\n";
$body .= "Email : $email\n\n";
$body .= "Téléphone : $phone\n";
$body .= "Message :\n$message";

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';//Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = $config['SMTP_HOST'];
    $mail->Username   = $config['SMTP_USERNAME'];
    $mail->Password   = $config['SMTP_PASSWORD'];
    $mail->Port       = $config['SMTP_PORT'];
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->addAddress('alexandre@as-turing.fr');
    $mail->addReplyTo($email, "$firstname $lastname");

    $mail->isHTML(true);
    $mail->Subject = 'Un nouveau message depuis le formulaire AS-Turing';
    $mail->Body = "
      <div style=\"font-family: 'Open Sans', sans-serif; color: #333; max-width: 600px; margin: auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; border: 1px solid #e0e0e0;\">
        <h2 style=\"color: #007bff; margin-bottom: 20px;\">📩 Nouveau message depuis le formulaire de contact - <strong>AS-Turing.fr</strong></h2>
        
        <table style=\"width: 100%; border-collapse: collapse;\">
          <tr>
            <td style=\"padding: 8px 0; font-weight: bold;\">👤 Nom :</td>
            <td style=\"padding: 8px 0;\">$lastname $firstname</td>
          </tr>
          <tr>
            <td style=\"padding: 8px 0; font-weight: bold;\">🏢 Entreprise :</td>
            <td style=\"padding: 8px 0;\">$company</td>
          </tr>
          <tr>
            <td style=\"padding: 8px 0; font-weight: bold;\">📧 Email :</td>
            <td style=\"padding: 8px 0;\">$email</td>
          </tr>
          <tr>
            <td style=\"padding: 8px 0; font-weight: bold;\">📞 Téléphone :</td>
            <td style=\"padding: 8px 0;\">$phone</td>
          </tr>
        </table>
    
        <hr style=\"margin: 20px 0; border: none; border-top: 1px solid #ddd;\">
    
        <p style=\"font-weight: bold;\">📝 Message :</p>
        <p style=\"white-space: pre-line; line-height: 1.6;\">$message</p>
        
        <p style=\"margin-top: 30px; font-size: 0.9em; color: #999;\">— Formulaire de contact automatique | AS-Turing</p>
      </div>
    ";


    $mail->AltBody = $body;
    $mail->SMTPDebug = 0;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}