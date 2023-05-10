<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;


class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    
                ],
                'label' => 'Lastname / Surname',
                 
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    

                ],
                'label' => 'Email address',
                  

            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                   

                ],
                'label' => 'object of the message',

                

            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control-message',
                    
                  
                ],
                'label' => 'Message',
                
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-danger btn-lg mt-4 ',
                    'style'=>'border-radius: 10px;  '
                ],
                'label' => 'Submit my request'
            ]);
            
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}