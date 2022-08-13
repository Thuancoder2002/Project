<?php

namespace App\Form;

use App\Entity\Major;
use App\Entity\Course;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
                [
                    'label' => 'Name Class',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 50,
                    ]
                ])
            ->add('describle',TextType::class,
                [
                    'label' => 'Describle',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 50,
                    ]
                ])
            ->add('major', EntityType::class, [
                'label' => 'Major',
                'required' => true,
                'class' => Major::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true
            ])
             ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Save'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
