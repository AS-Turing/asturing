<?php

namespace App\Controller\Admin;

use App\Entity\SpecificationBook;
use App\Form\SpecificationAnswersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecificationBookAnswerController extends AbstractController
{
    #[Route('/admin/specification-book/{id}/answer', name: 'admin_specification_book_answer')]
    public function answer(
        SpecificationBook $specificationBook,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(SpecificationAnswersType::class, $specificationBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($specificationBook);
            $entityManager->flush();

            $this->addFlash('success', 'Le cahier des charges a été enregistré avec succès !');

            // Redirection simple vers le dashboard admin

            return $this->redirect('/admin');
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            foreach ($form->getErrors(true) as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        }
        return $this->render('admin/specification_book_answer.html.twig', [
            'form' => $form->createView(),
            'specificationBook' => $specificationBook,
        ]);
    }
}
