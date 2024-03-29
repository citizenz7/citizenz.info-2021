<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'rows' => '12'
                ]
            ])
            //->add('created_at')
            //->add('updated_at')
            ->add('is_active', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Actif ?',
                'choices' => [
                    'Oui' => 1,
                    'Non' => 0
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de l\'article',
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Image is not valid',
                    ])
                ]
            ])
            //->add('slug')
            //->add('author')
            ->add('category', EntityType::class, [
                'label' => 'Catégories de l\'article. Choisissez-en une ou plusieurs.',
                'class' => Category::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.title', 'ASC');
                }
            ])
            ->add('tag', EntityType::class, [
                'label' => 'Tags de l\'article. Choisissez-en un ou plusieurs.',
                'class' => Tag::class,
                'choice_label' => 'title',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control mb-3 select-tags'
                ],
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.title', 'ASC');
                },
                //'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
