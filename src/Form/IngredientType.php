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

            ->add('benefits',  null, [
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ])

            ->add('drinks', null, [
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
            'ingredient' => '',
        ]);
    }
}
