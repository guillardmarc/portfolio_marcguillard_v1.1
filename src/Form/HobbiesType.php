<?php

namespace App\Form;

use App\Entity\Hobbies;
use Attribute;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\UX\Dropzone\Form\DropzoneType;

class HobbiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Titre du hobbie',
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description du hobbie',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hobbies::class,
        ]);
    }
}
