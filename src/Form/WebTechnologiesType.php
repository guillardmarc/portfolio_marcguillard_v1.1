<?php

namespace App\Form;

use App\Entity\Achievements;
use App\Entity\WebTechnologies;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;

class WebTechnologiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Nom de la technologie',
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description de la technologie',
                ),
                'required'=>true,
            ))
            ->add('pictureLink', DropzoneType::class, [
                'attr'=>[
                    'placeholder' => 'Sélectionner une image',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un format de document valide',
                    ])
                ],
                'mapped' => false,
                'required' => false,
            ])
            ->add('isPrefered', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input',
                 ],
                 'label' => 'Technologie préféré',
                 'required'=>false,
             ])
            // ->add('achievements', EntityType ::class,  [
            //     'attr' => [
            //         'class' => 'd-flex justify-content-evenly',
            //         'placeholder' => 'Version du site'
            //     ],
            //     'choice_label' => 'version',
            //     'class'=> Achievements::class,
            //     'expanded' => true,
            //     'multiple' => true,
            //     'required'=>false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WebTechnologies::class,
        ]);
    }
}
