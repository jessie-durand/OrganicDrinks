<?php

namespace App\Form;

use App\Entity\Benefit;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IngredientType extends AbstractType
{
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
            //     'class' => Benefit::class,
            //     'choice_label' => 'name'
            // ])
            // ->add('drinks')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
