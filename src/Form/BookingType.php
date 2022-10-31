<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Promo;
use App\Entity\Centre;
use App\Entity\Booking;
use App\Entity\Cours;
use App\Repository\CentreRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookingType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $promos= ["Aucune"];
        $builder
            ->add('beginAt', DateType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Ce champs ne peut pas être vide'])
                ],
                'label' => 'Date début',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                ])

            ->add('endAt', DateType::class, [
                'label' => 'Date fin',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                ])
            ->add('color', ColorType::class)
            ->add('formateur', EntityType::class, [
                'class' => User::class,
                'constraints' => [
                    new NotBlank(['message' => 'Ce champs ne peut pas être vide'])
                ],
                'choice_label' => function($u){
                    return $u->getPrenom() . ' ' . $u->getNom();
                },
                'required' => true,
                'query_builder' => function(UserRepository $ur){
                    return $ur->createQueryBuilder('u')->orderBy('u.prenom', 'ASC');
                },
                'label' => 'Formateur: ',
                'placeholder' => 'selectionez le formateur... ',
                'multiple' => false,
                'by_reference' => true,
            ])
                
            ->add('centre', EntityType::class, [
                'class' => Centre::class,
                'required' => false,
                'label' => 'Centre: ',
                'placeholder' => 'selectionez le centre... ',
                'query_builder' => function(CentreRepository $cr){
                    return $cr->createQueryBuilder('c')->orderBy('c.nom', 'ASC');
                },
            ])
                
            ->add('promo', EntityType::class, [
                "label" => "Promo: ",
                "class" => Promo::class,
                "choice_label" => function($promo){
                    return $promo->getNom();
                }
            ])
                
            ->add('title', TextType::class, [
                "label" => " Promo (texte libre): ",
                'constraints' => [
                    new NotBlank(['message' => 'Ce champs ne peut pas être vide'])
                ],
            ])
            
            ->add('cours', EntityType::class, [
                "label" => "Cours: ",
                "class" => Cours::class,
                "choice_label" => function($cours){
                return $cours->getModule();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
