<?php

namespace App\Form;

use App\Entity\Drink;
use App\Entity\Benefit;
use App\Entity\Ingredient;
use App\Service\FiltreService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class IngredientType extends AbstractType
{
    public FiltreService $filtreService;


    public function __construct(FiltreService $filtreService)
    {
        $this->filtreService = $filtreService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'Name',
                TextType::class,
                array(
                    'attr' => array(
                        'placeholder' => 'Nom',
                    ),
                    'label' => ' '
                )
            )
            ->add('image')
            ->add('description')

            // ->add('benefits', EntityType::class, [
            //     'choices' => $this->filtreService->filtreBenefit($options['ingredient']),
            //     'label' => ' ',
            //     'class' => Benefit::class,
            //     'choice_label' => 'name',
            //     'placeholder' => "Veuillez choisir un bienfait", l
            // ])

            // ->add('drinks', EntityType::class, [
            //     'choices' => $this->filtreService->filtreDrink($options['ingredient']),
            //     'label' => ' ',
            //     'class' => Drink::class,
            //     'choice_label' => 'name',
            //     'placeholder' => "Veuillez choisir une boisson",
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
            'ingredient' => '',
        ]);
    }
}
