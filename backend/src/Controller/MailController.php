<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class MailController extends AbstractController
{
    #[Route('/mail/contact', name: 'app_mail_contact', methods: ['POST'])]
    public function contact(Request $request, MailerInterface $mailer): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $firstname = htmlspecialchars($data['firstname'] ?? '');
            $lastname = htmlspecialchars($data['lastname'] ?? '');
            $company = htmlspecialchars($data['company'] ?? '');
            $email = filter_var($data['mail'] ?? '', FILTER_VALIDATE_EMAIL);
            $phone = htmlspecialchars($data['phone'] ?? '');
            $message = htmlspecialchars($data['message'] ?? '');

            if (empty($firstname) || empty($lastname) || empty($email) || empty($message)) {
                return $this->json([
                    'success' => false,
                    'message' => 'Champs requis manquants ou invalides'
                ], 400);
            }

            $htmlTemplate = "
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

            // Create plain text version
            $textBody = "Nom : $lastname $firstname\n";
            $textBody .= "Entreprise : $company\n";
            $textBody .= "Email : $email\n";
            $textBody .= "Téléphone : $phone\n\n";
            $textBody .= "Message :\n$message";

            // Create and send email
            $emailMessage = (new Email())
                ->from('alexandre@as-turing.fr')
                ->to('alexandre@as-turing.fr')
                ->replyTo($email)
                ->subject('Un nouveau message depuis le formulaire AS-Turing')
                ->text($textBody)
                ->html($htmlTemplate);

            $mailer->send($emailMessage);

            return $this->json([
                'success' => true,
                'message' => 'Le message a bien été envoyé.'
            ]);
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'error' => 'Erreur lors de l’envoi de l’e-mail : ' . $e->getMessage(),
            ]);
        }
    }
}
