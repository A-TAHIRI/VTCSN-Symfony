<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Ride;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RideNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('rendezVous', TextType::class,[
                'label'=>'Votre address',
                'attr'=>[
                    'class'=>'form-conrol',
                    'placeholder' =>'Entrez votre address',

                ]
            ])
            ->add('destination', TextType::class,[
                'label'=>'Votre destination',
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder' =>'Entrez votre distination',

                ]
            ])
            ->add('rendez_vous_time', DateTimeType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
                'data' => new \DateTime("now")
            ])
            // ->add('location', EntityType::class, [
            //     'class' => Location::class,

            //        'attr'=>[
            //     'placeholder' => 'Choisir une pays',
            //     'class'=>'form-control'
            //        ],
            //     'choice_label' => function ($location) {
            //         return $location->getCountry() ;
            //     }
            // ])
            // ->add('location', EntityType::class, [
            //     'class' => Location::class,
            //   'attr'=>[
            //     'placeholder' => 'Choisir une region',
            //     'class'=>'form-control'
            //        ],
            //     'choice_label' => function ($location) {
            //         return $location->getRegion() ;
            //     }
            // ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
             'attr'=>[
                'placeholder' => 'Choisir une ville',
                'class'=>'form-control'
             ],
                'choice_label' => function ($location) {
                    return $location->getCity() ;
                }
            ])
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ride::class,
        ]);
    }
}