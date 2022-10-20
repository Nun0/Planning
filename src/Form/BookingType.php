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
use Symfony\Component\Form\FormInterface;

class BookingType extends AbstractType
{
    public function __construct(private PromoRepository $promoRepository){}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beginAt', DateType::class, [
                'required'=>true,
                'label' => 'Date début',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                ])
                ->add('endAt', DateType::class, [
                    'required'=>true,
                    'label' => 'Date fin',
                    'widget' => 'single_text',
                    'input' => 'datetime_immutable',
                    ])
                ->add('color', ColorType::class)
                ->add('title')
                ->add('formateur', EntityType::class, [
                    'class' => User::class,
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
                ]);
        
                $formModifier = function (FormInterface $form, Centre $centre = null) {
                    $promos = $centre === null ? [] : $this->promoRepository->findByCentreOrderedByAscName($centre);
        
                    $form->add('promo', EntityType::class, [
                        'class' => Promo::class,
                        'choice_label' => 'name',
                        'disabled' => $centre === null,
                        'placeholder' => 'selectionez la promo...',
                        'choices' => $promos
                    ]);
                };
        
                $builder->addEventListener(
                    FormEvents::PRE_SET_DATA,
                    function (FormEvent $event) use ($formModifier) {
                        $data = $event->getData();
        
                        $formModifier($event->getForm(), $data->getcentre());
                    }
                );
        
                $builder->get('centre')->addEventListener(
                    FormEvents::POST_SUBMIT,
                    function (FormEvent $event) use ($formModifier) {
                        $centre = $event->getForm()->getData();
        
                        $formModifier($event->getForm()->getParent(), $centre);
                    }
                );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
