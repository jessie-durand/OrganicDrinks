<?php

namespace App\Form;

use App\Entity\Benefit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BenefitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('image')
            ->add('description')
            ->add('ingredients', null, [
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Benefit::class,
        ]);
    }
}
