<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeVehicule',ChoiceType::class,[
                'label'=>'Type de Voiture',
                'attr'=>[
                'placeholder'=>'Choisir un Type',
                'class' => 'form-control',
                 ],
                'choices'=>[
                    'Mercedes'=>'Mercedes',
                    'volkswagen'=>'volkswagen',
                    'Renault'=>'Renault',
                    'Peugeot'=>'Peugeot'

                ]
            ])
            ->add('numberPlace',choiceType::class,[
                'label'=>'Nombre de Place',
                'attr'=>[
                'placeholder'=>'Choisir un Nombre',
                'class' => 'form-control',
                ],
                'choices'=>[
                    '3'=>'3',
                    '4'=>'4',
                    '5'=>'5',
                    '6'=>'6',
                    '7'=>'7'

                ]
            ])
            ->add('brand',choiceType::class,[
                'label'=>'Categorie de voiture',
                'attr'=>[
                ' placeholder'=>'Choisir une Categorie',
                'class' => 'form-control',
                ],
                'choices'=>[
                    'Mercedes Classe A'=>'Mercedes Classe A',
                    'Mercedes Classe B'=>'Mercedes Classe B',
                    'Mercedes Classe C'=>'Mercedes Classe C',
                    'VW Polo '=>'VW Polo ',
                    'VW Golf'=>'VW Golf',
                    'VW Passat '=>'VW Passat '
                ]

                ])
            ->add('model',choiceType::class,[
                'attr'=>[
                'placeholder'=>'Choisir un Model',
                'class' => 'form-control',
                ],
                'choices'=>[
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    '2022'=>'2022',
                    
                    
                 
                ]

                ])
            ->add('color',choiceType::class,[
                'label'=>'Couleur',
                'attr'=>['placeholder'=>'Choisir un Couleur',
                'class' => 'form-control',
                 ],
                
                'choices'=>[
                    'NOIR'=>'NOIR',
                    'GRIS'=>'GRIS',
                    'BLANC'=>'BLANC',
                    'ROUGE'=>'ROUGE',
                    'BLEU'=>'BLEU'
                ]
                ])
            ->add('image',FileType::class,[
                'label' => 'Sélectionner un fichier',
                'mapped' => false,
                'required' => false,
            ])
            ->add('energie',choiceType::class,[
                'label'=>'Carburant',
                'attr'=>['placeholder'=>'Choisir un Carburant',
                'class' => 'form-control',
                 ],
                
                'choices'=>[
                   ' Gazole '=>' Gazole',
                    'Essence'=>'Essence',
                    'Hybride'=>'Hybride',
                  
                ]
                ])
            ->add('numberDoor',choiceType::class,[
                'label'=>'Nombre de Porte',
                
                'attr'=>['placeholder'=>'Choisir un Nombre',
                'class' => 'form-control',
                      ],
                'choices'=>[
                    '3'=>'3',
                    '4'=>'4',
                   
                ]
                ])
            ->add('licensePlate',options:[
                'label'=>'Matricule',
                'attr'=>[
                'placeholder'=>'Entrez votre Matricule',
                'class' => 'form-control',
                ]
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}