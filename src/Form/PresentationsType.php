<?php

namespace App\Form;

use App\Entity\Presentations;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;


class PresentationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('lastName', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Nom',
                ],
                'required'=>true,
            ])
            ->add('firstName', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Prénom',
                ],
                'required'=>true,
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'required'=> true,
            ])
            ->add('email', EmailType::class, [
                'attr'=>[
                    'placeholder'=>'Email',
                ],
                'required'=>true,
            ])
            ->add('phone', TelType::class, [
                'attr'=>[
                    'placeholder'=>'Téléphone',
                ],
                'required'=>true,
            ])
            ->add('job', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Enploie',
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description',
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
            ->add('isPublished', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input',
                 ],
                 'label' => 'Publier',
                 'required'=>false,
             ])
            ->add('publicationDate', DateType::class, [
                'widget' => 'single_text',
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presentations::class,
        ]);
    }
}
