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

class WebsitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt')
            // ->add('modifiedAt')
            ->add('regulation', CKEditorType::class, array(
                'config' => array(
                    'editorplaceholder' => 'Réglement du site',
                ),
                'required'=>true,
            ))
            ->add('copyright', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Copyright du site',
                ],
                'required'=>true,
            ])
            ->add('version', TextType::class, [
                'attr'=>[
                    'placeholder'=>'Version du site',
                ],
                'required'=>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Websites::class,
        ]);
    }
}
