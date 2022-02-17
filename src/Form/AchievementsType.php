<?php

namespace App\Form;

use App\Entity\Achievements;
use App\Entity\Establishments;
use App\Entity\WebTechnologies;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;

class AchievementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>"Nom du projet",
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description',
                ),
                'required'=>true,
            ))
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'required'=>false,
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Abandonné'=>'Abandonné',
                    'En cours'=>'En cours',
                    'Finis'=>'Finis',
                ],
                'placeholder' => 'Etat',
                'expanded'=>false,
                'required' =>true,
                'multiple'=>false
            ])
            ->add('gitLink', UrlType::class, [
                'attr'=>[
                    'placeholder'=>'Lien dépot GIT'
                ],
                'required'=>true
            ])
            ->add('httpLink', UrlType::class, [
                'attr'=>[
                    'placeholder'=>'Lien dépot GIT'
                ],
                'required'=>false,
            ])
            ->add('releaseDate', DateType::class, [
                'widget' => 'single_text',
                'required'=>false,
            ])
            ->add('updateDate', DateType::class, [
                'widget' => 'single_text',
                'required'=>false,
            ])
            ->add('technology', EntityType::class, [
                'attr' => [
                    'class' => 'd-flex justify-content-evenly',
                    'placeholder' => 'Technologies utiliser'
                ],
                'choice_label' => 'name',
                'class'=> WebTechnologies::class,
                'expanded' =>true,
                'multiple' => true,
                'required'=>true
            ],)
            ->add('applicant', EntityType::class, [
                'choice_label'=>'name',
                'class'=> Establishments::class,
                'placeholder'=>'Demandeur',
                'required'=>false
            ])
            ->add('pictureLink', DropzoneType::class, [
                'attr'=>[
                    'placeholder' => 'Sélectionner une image',
                ],
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achievements::class,
        ]);
    }
}
