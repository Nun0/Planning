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

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('role', ChoiceType::class, [
                'placeholder' => 'Choissisez un rôle...',
                'label' => 'Rôle',
                'choices' => [
                    'Formateur' => 'USER',
                    'Administrateur' => 'ADMIN',
                ],
                'required' => true,
                'mapped' => false,])
            ->add('plainPassword',TextType::class, ["label" => "Password :"])
            ->add('nom',TextType::class, ["label" => "Nom :"])
            ->add('prenom',TextType::class, ["label" => "Prenom :"])
            ->add('telephone',TextType::class, ["label" => "Telephone :"])
            ->add('couleur', ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}