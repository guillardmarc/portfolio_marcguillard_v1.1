<?php

namespace App\Form;

use App\Entity\UpdateWebsites;
use App\Entity\Websites;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateWebsitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('name', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Titre de la mise à jour',
                ],
                'required'=>true,
            ])
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Description du hobbie',
                ),
                'required'=>true,
            ))
            ->add('websites', EntityType::class,  [
                'attr' => [
                    'class' => 'd-flex justify-content-evenly',
                    'placeholder' => 'Version du site'
                ],
                'choice_label' => 'version',
                'class'=> Websites::class,
                'expanded' => true,
                'multiple' => false,
                'required'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdateWebsites::class,
        ]);
    }
}
