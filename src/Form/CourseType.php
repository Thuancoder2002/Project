<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                  'label' => 'Course Name',
                    'required' => true,
                    'attr' => [
                        'minlength' => 3,
                        'maxlength' => 50,
                    ]


            ])

            ->add('image', TextType::class,[
                    'label' => 'Course Image',
                    'required' => true
                


            ])
            ->add('describle', TextType::class,[
                'label' => 'Describle',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 50,
                    ]


            ])

            ->add('teachers',EntityType::class,[
                'label' => 'Name Teacher',
                'required' => true,
                'class' => Teacher::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true

            ])

            ->add('students',EntityType::class,[
                'label' => 'Name Student',
                'required' => true,
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])

                 ->add(
                'save',
                SubmitType::class,
                [
                    'label' => 'Edit Course'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
