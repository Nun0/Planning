<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, ["label" => "Email :"])
            ->add('roles', CollectionType::class , [
                'allow_add' => true,
                'allow_delete'=> true,
                ])
            ->add('password',TextType::class, ["label" => "Password :"])
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
