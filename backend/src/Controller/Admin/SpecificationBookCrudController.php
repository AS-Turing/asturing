<?php

namespace App\Controller\Admin;

use App\Entity\SpecificationBook;
use App\Form\SpecificationAnswersType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class SpecificationBookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SpecificationBook::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Cahier des charges')
            ->setEntityLabelInPlural('Cahiers des charges')
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        // Action pour répondre aux questions
        $answerQuestions = Action::new('answerQuestions', 'Répondre aux questions', 'fa fa-edit')
            ->linkToRoute('admin_specification_book_answer', function (SpecificationBook $entity) {
                return ['id' => $entity->getId()];
            })
            ->setCssClass('btn btn-primary');
        
        // Action personnalisée pour exporter en PDF
        $exportPdf = Action::new('exportPdf', 'Exporter en PDF', 'fa fa-file-pdf')
            ->linkToRoute('admin_specification_book_export_pdf', function (SpecificationBook $entity) {
                return ['id' => $entity->getId()];
            })
            ->setCssClass('btn btn-success');
        
        return $actions
            ->add(Crud::PAGE_INDEX, $answerQuestions)
            ->add(Crud::PAGE_INDEX, $exportPdf)
            ->add(Crud::PAGE_DETAIL, $answerQuestions)
            ->add(Crud::PAGE_DETAIL, $exportPdf)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [];
        
        $fields[] = TextField::new('title', 'Titre du projet')
            ->setHelp('Exemple: "Projet Site Web Client X"');
        $fields[] = TextareaField::new('description', 'Description')
            ->setHelp('Description optionnelle du projet')
            ->hideOnIndex();
        
        if ($pageName === Crud::PAGE_INDEX) {
            $fields[] = DateTimeField::new('createdAt', 'Date de création');
        } elseif ($pageName === Crud::PAGE_DETAIL) {
            $fields[] = DateTimeField::new('createdAt', 'Date de création');
        }

        return $fields;
    }

    public function createEntity(string $entityFqcn)
    {
        $specificationBook = new SpecificationBook();
        $specificationBook->setCreatedAt(new \DateTimeImmutable());
        return $specificationBook;
    }
}
