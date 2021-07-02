<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'E-mail'
                ]
            ])
            //->add('roles')
            //->add('password')
            ->add('username', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Picture is not valid (jpeg or png only)',
                    ])
                ]
            ])
            //->add('isVerified')
            ->add('presentation', TextareaType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'rows' => '3',
                    'placeholder' => 'Présentation'
                ]
            ])
            ->add('facebook', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Facebook'
                ]
            ])
            ->add('twitter', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Twitter'
                ]
            ])
            ->add('instagram', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Instagram'
                ]
            ])
            ->add('linkedin', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil LinkedIn'
                ]
            ])
            ->add('github', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Github'
                ]
            ])
            ->add('youtube', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Youtube'
                ]
            ])
            ->add('discord', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre profil Discord'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
