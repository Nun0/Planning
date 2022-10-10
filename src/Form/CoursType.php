<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Promo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('module')
            ->add('promo', EntityType::class, [
                'class' => Promo::class,
                'required' => false,
                'label' =>  'Promo(s) :',
                'multiple' => true,
                'by_reference' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'Promo(s) :',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
