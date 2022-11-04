<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Promo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('module', TextType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => 'ex: Javascript'
                ]
            ])
            ->add('promo', EntityType::class, [
                'class' => Promo::class,
                'required' => false,
                'label' =>  'Promo(s) :',
                'multiple' => true,
                'by_reference' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'selectionez une ou plusieurs promo(s) :',
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
