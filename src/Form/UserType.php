<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => 'Email:',
                'attr' => [
                    'placeholder' => 'mail@example.com',
                ]
            ])

            ->add('role', ChoiceType::class, [
                'placeholder' => 'Choissisez un rôle...',
                'label' => 'Rôle:',
                'choices' => [
                    'Formateur' => 'USER',
                    'Administrateur' => 'ADMIN',
                ],
                'required' => true,
                'mapped' => false,
            ])

            ->add('plainPassword',TextType::class, [
                "label" => "Mot de passe :",
                'required' => true,
                'attr' => [
                    'placeholder' => 'motDePasse',
                ],
            ])

            ->add('prenom',TextType::class, [
                "label" => "Prenom :",
                'required' => true,
                'attr' => [
                    'placeholder' => 'prenom d\'utilisateur',
                ],
            ])

            ->add('nom',TextType::class, [
                "label" => "Nom :",
                'required' => true,
                'attr' => [
                    'placeholder' => 'nom d\'utilisateur',
                ],
            ])

            ->add('telephone',TextType::class, [
                "label" => "Telephone :",
                'required' => true,
                'attr' => [
                    'placeholder' => '00 00 00 00 00',
                ],
            ])

            ->add('couleur', ColorType::class, [
                'required' => true, 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}