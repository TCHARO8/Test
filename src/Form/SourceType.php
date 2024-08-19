<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Source;
use App\Repository\DepartementRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceType extends AbstractType
{
    private DepartementRepository $departementRepository;
    public function __construct(DepartementRepository $departementRepository,)
    {
        $this->departementRepository = $departementRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Code', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('LibelleSource', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Departement', EntityType::class, [
                'class' => Departement::class,
                'label' => 'Departement',
                'choice_label' => 'libelleD',
//                'choices'=> $this->departementRepository->listeDepartements(),
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => "Rechercher le département",
            ])
//            ->add('Departement', EntityType::class, [
//                'class' => departement::class,
//                'choice_label' => 'id',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Source::class,
        ]);
    }
}
