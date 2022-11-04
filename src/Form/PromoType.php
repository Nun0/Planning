<?php

namespace App\Form;

use App\Entity\Centre;
use App\Entity\Cours;
use App\Entity\Promo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => 'ex: DWWM'
                ],
                'help' => 'Rappel: le complement de promo seras ajouter au moment de creation de mission.'
            ])
            ->add('centre', EntityType::class, [
                'class' => Centre::class,
                'required' => false,
                'label' => 'Centre(s) :',
                'multiple' => false,
                'by_reference' => true,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'selectionez le centre... ',
                ],
            ])
            ->add('cours', EntityType::class, [
                'class' => Cours::class,
                'required' => false,
                'label' => 'Cours :',
                'multiple' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'selectionez un ou plusieurs cours...',
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
