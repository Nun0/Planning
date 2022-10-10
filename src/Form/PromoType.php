<?php

namespace App\Form;

use App\Entity\Centre;
use App\Entity\Cours;
use App\Entity\Promo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('centre', EntityType::class, [
                'class' => Centre::class,
                'required' => false,
                'label' => 'Centre(s) :',
                'multiple' => false,
                'by_reference' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'Centre(s) :',
                ],
            ])
            ->add('cours', EntityType::class, [
                'class' => Cours::class,
                'required' => false,
                'label' => 'Cours :',
                'multiple' => true,
                'by_reference' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'Cours:',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promo::class,
        ]);
    }
}
