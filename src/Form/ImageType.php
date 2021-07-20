<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => true,
                'label' => "Nom de l'image",
                'attr' => [
                    'placeholder' => "écrivez le titre de votre image"
                ]
            ])
            ->add('path', FileType::class, [
                'mapped' => false,
                'required' => true,
                'multiple' => false,
                'label' => "uploader votre image",
                'attr' => [
                    'placeholder' => "parcourir pour trouver l'image"
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048K',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/gif'
                        ]
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => "dscription de l'image",
                'attr' => [
                    'placeholder' => "vous pouvez décrire l'image (optionel)"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
