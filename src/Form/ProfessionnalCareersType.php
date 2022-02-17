<?php

namespace App\Form;

use App\Entity\Establishments;
use App\Entity\ProfessionnalCareers;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfessionnalCareersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Titre de l\'emploie',
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description de l\'emploie',
                ),
                'required'=>false,
            ))
            ->add('Type', ChoiceType::class, [
                'placeholder' => 'Type d\'étape',
                'choices' => [
                    'Formation'=>'Formation',
                    'Emploie'=>'Emploie',
                ],
                'required' => true,
            ])
            ->add('contract', ChoiceType::class, [
                'choices' => [
                    'Formation'=>'Formation',
                    'Stage'=>'Stage',
                    'Intérim'=>'Intérim',
                    'CDD'=>'CDD',
                    'CDI'=>'CDI',
                ],
                'placeholder' => 'Type de contrat',
                'expanded'=>false,
                'required' =>true,
                'multiple'=>false
            ])
            ->add('startDate', DateType::class, [
                'placeholder' => 'Date de début',
                'widget' => 'single_text',
                'required'=>false,
            ])
            ->add('duration', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Durée'
                ]
            ])
            ->add('employer', EntityType::class, [
                'placeholder' => 'Employeur',
                'choice_label' => 'name',
                'class'=> Establishments::class,
                'expanded' =>false,
                'multiple' => false,
                'required'=>true
            ])
            ->add('workSite', EntityType::class, [
                
                'placeholder' => 'Lieu',
                'choice_label' => 'name',
                'class'=> Establishments::class,
                'expanded' =>true,
                'multiple' =>true,
                'required'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfessionnalCareers::class,
        ]);
    }
}
