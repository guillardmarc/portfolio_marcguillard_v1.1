<?php

namespace App\Form;

use App\Entity\Establishments;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;

class EstablishmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Nom de l\'entreprise',
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description de l\'entreprise',
                ),
                'required'=>true,
            ))
            ->add('city', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Ville',
                ],
                'required'=>true,
            ])
            ->add('httpLink', UrlType::class, [
                'attr'=>[
                    'placeholder'=>'Site web de l\'entreprise',
                ],
                'required'=>false,
            ])
            ->add('email', EmailType::class, [
                'attr'=>[
                    'placeholder'=>'Email de l\'entreprise',
                ],
                'required'=>false,
            ])
            ->add('phone', TelType::class, [
                'attr'=>[
                    'placeholder'=>'Téléphone de l\'entreprise',
                ],
                'required'=>false,
            ])
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
            // ->add('workSite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Establishments::class,
        ]);
    }
}
