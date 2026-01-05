<?php

namespace App\Form;

use App\Entity\Specification;
use App\Entity\SpecificationAnswer;
use App\Entity\SpecificationBook;
use App\Repository\SpecificationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationAnswersType extends AbstractType
{
    public function __construct(
        private SpecificationRepository $specificationRepository
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Champs de base du SpecificationBook
        $builder->add('title', TextType::class, [
            'label' => 'Titre du projet',
            'help' => 'Exemple: "Projet Site Web Client X"',
            'attr' => ['placeholder' => 'Nom du projet ou du client'],
        ]);

        $builder->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => false,
            'help' => 'Description optionnelle du projet',
            'attr' => [
                'rows' => 3,
                'placeholder' => 'Notes supplémentaires sur le projet...'
            ],
        ]);

        // Charger les questions
        $specifications = $this->specificationRepository->findAllOrdered();

        foreach ($specifications as $specification) {
            $fieldOptions = [
                'label' => $specification->getLabel(),
                'required' => false, // On désactive la validation required côté formulaire
                'help' => $specification->getTooltip(),
                'attr' => [
                    'placeholder' => $specification->getPlaceholder(),
                ],
                'mapped' => false,
            ];

            // Déterminer le type de champ selon le type de la question
            $fieldType = $this->getFieldType($specification);
            
            // Ajouter les options spécifiques selon le type
            if (in_array($specification->getType(), ['select', 'radio', 'checkbox'])) {
                $choices = $this->formatChoices($specification->getTypeOptions());
                $fieldOptions['choices'] = $choices;
                
                if ($specification->getType() === 'checkbox') {
                    $fieldOptions['multiple'] = true;
                    $fieldOptions['expanded'] = true;
                } elseif ($specification->getType() === 'radio') {
                    $fieldOptions['expanded'] = true;
                }
            }

            if ($specification->getType() === 'number') {
                if ($specification->getMin() !== null) {
                    $fieldOptions['attr']['min'] = $specification->getMin();
                }
                if ($specification->getMax() !== null) {
                    $fieldOptions['attr']['max'] = $specification->getMax();
                }
            }

            $builder->add('question_' . $specification->getId(), $fieldType, $fieldOptions);
        }

        // Listener pour sauvegarder les réponses
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($specifications) {
            $specificationBook = $event->getData();
            $form = $event->getForm();

            if (!$specificationBook instanceof SpecificationBook) {
                return;
            }

            // Supprimer les anciennes réponses si édition
            foreach ($specificationBook->getAnswers() as $answer) {
                $specificationBook->removeAnswer($answer);
            }

            // Créer les nouvelles réponses
            foreach ($specifications as $specification) {
                $fieldName = 'question_' . $specification->getId();
                $value = $form->get($fieldName)->getData();

                if ($value !== null && $value !== '' && $value !== []) {
                    $answer = new SpecificationAnswer();
                    $answer->setSpecification($specification);
                    $answer->setSpecificationBook($specificationBook);
                    
                    // Convertir les tableaux (checkbox) en JSON
                    if (is_array($value)) {
                        $answer->setAnswerValue(json_encode($value));
                    } else {
                        $answer->setAnswerValue((string) $value);
                    }
                    
                    $specificationBook->addAnswer($answer);
                }
            }
        });

        // Listener pour pré-remplir les réponses existantes
        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $specificationBook = $event->getData();
            $form = $event->getForm();

            if (!$specificationBook instanceof SpecificationBook) {
                return;
            }

            // Pré-remplir les champs avec les réponses existantes
            foreach ($specificationBook->getAnswers() as $answer) {
                $fieldName = 'question_' . $answer->getSpecification()->getId();
                if ($form->has($fieldName)) {
                    $value = $answer->getAnswerValue();
                    
                    // Décoder JSON pour les checkbox
                    if ($answer->getSpecification()->getType() === 'checkbox') {
                        $value = json_decode($value, true) ?: [];
                    }
                    
                    $form->get($fieldName)->setData($value);
                }
            }
        });
    }

    private function getFieldType(Specification $specification): string
    {
        return match ($specification->getType()) {
            'text' => TextType::class,
            'textarea' => TextareaType::class,
            'email' => EmailType::class,
            'tel' => TelType::class,
            'number' => NumberType::class,
            'date' => DateType::class,
            'select', 'radio', 'checkbox' => ChoiceType::class,
            default => TextType::class,
        };
    }

    private function formatChoices(?array $typeOptions): array
    {
        if (empty($typeOptions)) {
            return [];
        }

        $choices = [];
        foreach ($typeOptions as $option) {
            if (isset($option['label']) && isset($option['value'])) {
                $choices[$option['label']] = $option['value'];
            }
        }

        return $choices;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SpecificationBook::class,
        ]);
    }
}
