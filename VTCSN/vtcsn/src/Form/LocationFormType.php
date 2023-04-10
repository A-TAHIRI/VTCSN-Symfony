<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', ChoiceType::class,[
                'label'=>'Pays',
                'attr'=>[
                    'class'=>'form-control'
                ],
                'choices'=>[
                    'France'=>'France',
                    'Sénégal'=>'Sénégal'
                ]
            ])
            ->add('region',ChoiceType::class,[
                'label'=>'Region ',
                'attr'=>[
                    'class'=>'form-control',
                ],
                'choices'=>[
                    'Il-de-France'=>'Il-de-France',
                    'Dakar'=>'Dakar'
                ],
            ])
            ->add('city',ChoiceType::class,[
                'label'=>'Ville',
                'attr'=>[
                    'class'=>'form-control',
                ],
                'choices'=>[
                    'Paris'=>'Paris',
                    'Saint-Denis'=>'Saint-Denis',
                    'Dakar'=>'Dakar',
                    'Guédiawaye'=>'Guédiawaye'
                ],
            ])
            ->add('zipCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}