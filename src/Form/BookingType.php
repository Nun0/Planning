<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Promo;
use App\Entity\Centre;
use App\Entity\Booking;
use App\Repository\CentreRepository;
use App\Repository\PromoRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\Common\Collections\Collection;

class BookingType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $promos= [ "Aucune"];
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
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Ce champs ne peut pas être vide'])
                ],
            ])
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
            ])->add('promo', EntityType::class, [
                "label" => "promotion",
                "class" => Promo::class,
                "choice_label" => function($promo){
                    return $promo->getNom();
                }
            ]);

            /*
            ->add('promo', EntityType::class, [
                'class' => Promo::class,
                'label' => 'Promo:',
                'required' => true,
                'placeholder' => 'Selectionnez la promo...',
                'choice_filter' => function($promo) use ($promos){
                    dump($promo);
                    return in_array($promo, $promos, true);
                }
            ]);
            */
            // $formModifier = function (FormInterface $form, Centre $centre = null) {
            //     $promos = null === $centre ? [] : $centre->getPromos();
            //     dump($promos);
            //     $form->add('promo', EntityType::class, [
            //         'class' => Promo::class,
            //         'placeholder' => $centre?  $centre->getNom():"Selectionnez le centre", //'selectionez la promo...',
            //         'choices' => $promos,
            //     ]);
            // };

            // $builder->addEventListener(
            //     FormEvents::PRE_SET_DATA,
            //     function (FormEvent $event) use ($formModifier) {
            //         $data = $event->getData();
            //         dump($data);
            //         if($data->getCentre()){
            //             $formModifier($event->getForm(), $data->getCentre());
            //         }
            //     }
            // );

            // $builder->get('centre')->addEventListener(
            //     FormEvents::POST_SET_DATA,
            //     function (FormEvent $event) use ($formModifier) {
            //         // It's important here to fetch $event->getForm()->getData(), as
            //         // $event->getData() will get you the client data (that is, the ID)
            //         $centre = $event->getForm()->getData();
            //         dump($centre);
            //         // since we've added the listener to the child, we'll have to pass on
            //         // the parent to the callback function!
            //         $formModifier($event->getForm()->getParent(), $centre);
            //     }
            // );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
