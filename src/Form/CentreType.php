<?php

namespace App\Form;

use App\Entity\Centre;
use App\Entity\Promo;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'required' => true,
                'label' => 'Nom:',
                'attr' => [
                    'placeholder' => 'nom du centre'
                ]
            ])
            ->add('adresse', TextType::class,[
                'required' => true,
                'label' => 'Adresse:',
                'attr' => [
                    'placeholder' => 'ex: 12 rue de Paris'
                ]
            ])
            ->add('codePostal', TextType::class,[
                'required' => true,
                'label' => 'Code Postal:',
                'attr' => [
                    'placeholder' => 'ex: 75000 Paris'
                ]
            ])
            ->add('mail', EmailType::class,[
                'required' => true,
                'label' => 'Mail:',
                'attr' => [
                    'placeholder' => 'mail@example.com'
                ]
            ])
            ->add('telephone', TextType::class,[
                'required' => true,
                'label' => 'Telephone:',
                'attr' => [
                    'placeholder' => '00 00 00 00 00'
                ]
            ])
            ->add('responsable', TextType::class,[
                'required' => true,
                'label' => 'Responsable:',
                'attr' => [
                    'placeholder' => 'ex: Florence Cité'
                ]
            ])
            ->add('horaire', TextType::class,[
                'required' => true,
                'label' => 'Horaire (Matin):',
                'attr' => [
                    'placeholder' => 'ex: 9:00 - 12:00',
                ]
            ])
            ->add('horaireApresMidi', TextType::class,[
                'required' => true,
                'label' => 'Horaire (Après-midi):',
                'attr' => [
                    'placeholder' => 'ex: 13:00 - 17:00'
                ]
            ])
            ->add('promos', EntityType::class, [
                'class' => Promo::class,
                'required' => false,
                'label' =>  'Promo(s) :',
                'multiple' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'Promo(s) :',
                ],
            ])
            ->add('couleur',ColorType::class,[
                'required' => true,
                'label' => 'Couleur:',
                'help' => 'Eviter la couleur blanc pour meilleur visibilité'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Centre::class,
        ]);
    }
}
