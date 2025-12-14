<?php

namespace App\Controller\Api;

use App\Entity\ContactMessage;
use App\Entity\ContactPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/api')]
class ContactController extends AbstractController
{
    #[Route('/contact/config', name: 'api_contact_config', methods: ['GET'])]
    public function getConfig(EntityManagerInterface $entityManager): JsonResponse
    {
        $contactPage = $entityManager->getRepository(ContactPage::class)->findOneBy([]);
        
        if (!$contactPage) {
            return $this->json(['error' => 'Contact config not found'], 404);
        }
        
        return $this->json([
            'hero' => [
                'badge' => $contactPage->getHeroBadge(),
                'title' => $contactPage->getHeroTitle(),
                'subtitle' => $contactPage->getHeroSubtitle(),
            ],
            'form' => [
                'title' => $contactPage->getFormTitle(),
                'description' => $contactPage->getFormDescription(),
                'privacyText' => $contactPage->getFormPrivacyText(),
                'privacyLink' => $contactPage->getFormPrivacyLink(),
                'submitButton' => $contactPage->getFormSubmitButton(),
                'submittingButton' => $contactPage->getFormSubmittingButton(),
                'successMessage' => $contactPage->getFormSuccessMessage(),
                'errorMessage' => $contactPage->getFormErrorMessage(),
            ],
            'contactInfo' => $contactPage->getContactInfo(),
            'urgentCta' => [
                'title' => $contactPage->getUrgentCtaTitle(),
                'description' => $contactPage->getUrgentCtaDescription(),
                'buttonText' => $contactPage->getUrgentCtaButtonText(),
                'buttonLink' => $contactPage->getUrgentCtaButtonLink(),
                'buttonIcon' => $contactPage->getUrgentCtaButtonIcon(),
            ],
            'faq' => [
                'title' => $contactPage->getFaqTitle(),
                'description' => $contactPage->getFaqDescription(),
                'items' => $contactPage->getFaqItems(),
            ],
            'seo' => [
                'title' => $contactPage->getSeoTitle(),
                'description' => $contactPage->getSeoDescription(),
            ],
        ]);
    }

    #[Route('/contact', name: 'api_contact_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        MailerInterface $mailer
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        // Validation basique
        if (empty($data['name']) || empty($data['email']) || empty($data['subject']) || empty($data['message'])) {
            return $this->json([
                'error' => 'All fields are required',
                'fields' => ['name', 'email', 'subject', 'message']
            ], 400);
        }

        // Validation email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->json(['error' => 'Invalid email address'], 400);
        }

        // Créer le message de contact
        $contactMessage = new ContactMessage();
        $contactMessage->setName($data['name']);
        $contactMessage->setEmail($data['email']);
        $contactMessage->setPhone($data['phone'] ?? null);
        $contactMessage->setCompany($data['company'] ?? null);
        $contactMessage->setSubject($data['subject']);
        $contactMessage->setMessage($data['message']);

        $entityManager->persist($contactMessage);
        $entityManager->flush();

        // Envoi de l'email de notification
        try {
            $email = (new Email())
                ->from($_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@as-turing.fr')
                ->to($_ENV['MAIL_TO_ADDRESS'] ?? 'contact@as-turing.fr')
                ->replyTo($data['email'])
                ->subject('Nouveau message de contact : ' . $data['subject'])
                ->html($this->renderEmailContent($contactMessage));

            $mailer->send($email);
        } catch (\Exception $e) {
            // Log l'erreur mais ne bloque pas la réponse
            error_log('Erreur envoi email: ' . $e->getMessage());
        }

        return $this->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'id' => $contactMessage->getId(),
        ], 201);
    }

    private function renderEmailContent(ContactMessage $message): string
    {
        $html = '<html><body style="font-family: Arial, sans-serif; color: #333;">';
        $html .= '<h2 style="color: #6366f1;">Nouveau message de contact</h2>';
        $html .= '<table style="width: 100%; border-collapse: collapse;">';
        $html .= '<tr><td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>Nom :</strong></td><td style="padding: 10px; border-bottom: 1px solid #ddd;">' . htmlspecialchars($message->getName()) . '</td></tr>';
        $html .= '<tr><td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>Email :</strong></td><td style="padding: 10px; border-bottom: 1px solid #ddd;"><a href="mailto:' . htmlspecialchars($message->getEmail()) . '">' . htmlspecialchars($message->getEmail()) . '</a></td></tr>';
        
        if ($message->getPhone()) {
            $html .= '<tr><td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>Téléphone :</strong></td><td style="padding: 10px; border-bottom: 1px solid #ddd;">' . htmlspecialchars($message->getPhone()) . '</td></tr>';
        }
        
        if ($message->getCompany()) {
            $html .= '<tr><td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>Entreprise :</strong></td><td style="padding: 10px; border-bottom: 1px solid #ddd;">' . htmlspecialchars($message->getCompany()) . '</td></tr>';
        }
        
        $html .= '<tr><td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>Sujet :</strong></td><td style="padding: 10px; border-bottom: 1px solid #ddd;">' . htmlspecialchars($message->getSubject()) . '</td></tr>';
        $html .= '<tr><td style="padding: 10px; border-bottom: 1px solid #ddd;"><strong>Date :</strong></td><td style="padding: 10px; border-bottom: 1px solid #ddd;">' . $message->getCreatedAt()->format('d/m/Y à H:i') . '</td></tr>';
        $html .= '</table>';
        $html .= '<div style="margin-top: 20px; padding: 20px; background-color: #f9fafb; border-left: 4px solid #6366f1;">';
        $html .= '<h3 style="margin-top: 0; color: #6366f1;">Message :</h3>';
        $html .= '<p style="white-space: pre-wrap;">' . nl2br(htmlspecialchars($message->getMessage())) . '</p>';
        $html .= '</div>';
        $html .= '<p style="margin-top: 30px; font-size: 12px; color: #999;">Ce message a été envoyé depuis le formulaire de contact de <a href="https://www.as-turing.fr" style="color: #6366f1;">www.as-turing.fr</a></p>';
        $html .= '</body></html>';
        
        return $html;
    }
}
