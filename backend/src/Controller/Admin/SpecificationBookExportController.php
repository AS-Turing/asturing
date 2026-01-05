<?php

namespace App\Controller\Admin;

use App\Entity\SpecificationBook;
use App\Repository\SpecificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecificationBookExportController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SpecificationRepository $specificationRepository
    ) {
    }

    #[Route('/admin/specification-book/{id}/export-pdf', name: 'admin_specification_book_export_pdf')]
    public function exportPdf(SpecificationBook $specificationBook): Response
    {
        // Récupérer toutes les questions pour l'ordre
        $allSpecifications = $this->specificationRepository->findAllOrdered();
        
        // Créer un tableau associatif des réponses
        $answers = [];
        foreach ($specificationBook->getAnswers() as $answer) {
            $answers[$answer->getSpecification()->getId()] = $answer->getAnswerValue();
        }
        
        // Organiser les données par section
        $sections = [
            'Contact' => [1, 2, 3, 4, 5],
            'Contexte entreprise' => [6, 7],
            'Objectifs du projet' => [8, 9, 10, 11, 12],
            'Cibles & Utilisateurs' => [13, 14],
            'Contenu' => [15, 16, 17, 18],
            'Design & UX' => [19, 20, 21, 22],
            'Fonctionnalités' => [23, 24, 25],
            'Technique & Infrastructure' => [26, 27, 28],
            'SEO & Marketing' => [29, 30, 31],
            'Juridique & Conformité' => [32, 33, 34, 35],
            'Collaboration & Suivi' => [36, 37, 38],
            'Maintenance & Évolution' => [39, 40],
            'Contraintes & Remarques' => [41, 42],
        ];
        
        // Générer le HTML
        $html = $this->renderView('admin/specification_book_pdf.html.twig', [
            'specificationBook' => $specificationBook,
            'allSpecifications' => $allSpecifications,
            'answers' => $answers,
            'sections' => $sections,
        ]);
        
        // Configuration Dompdf
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Nom du fichier
        $filename = sprintf(
            'cahier-des-charges-%s-%s.pdf',
            $this->slugify($specificationBook->getTitle()),
            $specificationBook->getCreatedAt()->format('Y-m-d')
        );
        
        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
    
    private function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        
        return empty($text) ? 'cahier' : $text;
    }
}
