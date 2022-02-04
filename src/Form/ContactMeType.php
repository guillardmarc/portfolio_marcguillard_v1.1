<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactMeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr'=>[
                    'placeholder'=>'Email *',
                ],
                'label'=>false,
                'mapped'=>false,
                'required'=>true,
            ])
            ->add('phone', TelType::class, [
                'attr'=>[
                    'placeholder'=>'Téléphone',
                ],
                'label'=>false,
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Nom *',
                ],
                'label'=>false,
                'mapped'=>false,
                'required'=>true,
            ])
            ->add('objet', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Objet du message *',
                ],
                'label'=>false,
                'mapped'=>false,
                'required'=>true
            ])
            ->add('message', TextareaType::class, [
                'attr'=>[
                    'placeholder'=>'Message *',
                ],
                'label'=>false,
                'mapped'=>false,
                'required'=>true
            ])
            ->add('company', TextType::class, [
                'attr'=>[
                    'autocomplete'=>'disabled',
                    'class'=>'visually-hidden',
                    'placeholder'=>'Entreprise',
                ],
                'label'=>false,
                'mapped'=>false,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
