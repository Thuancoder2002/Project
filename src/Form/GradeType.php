<?php

namespace App\Form;

use App\Entity\Grade;
use App\Entity\Course;
use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GradeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grade', IntegerType::class,
            [
                'label' => 'Grade',
                'required' => true,
                // 'choices' => [
                //       ' ' =>' ',
                //     '6.5' => '6.5',
                //     '8.5' => '8.5',
                //     '10' => '10'
                // ],
               // 'multiple' => false, //false (default), Hold CTRL to select muliple
               // 'expanded' => false  //false: drop-down (default), true: radio button
               'attr' => [
                'min' => 0,
                'max' => 10
            ]
            ]
        )
            // ->add('comment', ChoiceType::class,
            // [
            //     'label' => 'Evaluate',
            //     'required' => false,
            //     'choices' => [
            //         ' ' =>' ',
            //         'Pass' => 'Pass',
            //         'Merit' => 'Merit',
            //         'Des' => 'Des'
            //     ]])
            //     'multiple' => false, //false (default), Hold CTRL to select muliple
            //     'expanded' => false  //false: drop-down (default), true: radio button

            // ])
            ->add('student', EntityType::class, [
                'label' => 'Student Name',
                'required' => true,
                'class' => Student::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('teacher', EntityType::class, [
                'label' => 'Teacher Name',
                'required' => true,
                'class' => Teacher::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('course', EntityType::class, [
                'label' => 'Course Name',
                'required' => true,
                'class' => Course::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
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
            'data_class' => Grade::class,
        ]);
    }
}
