<?php

namespace App\Form;

use App\Entity\Grade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GradeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('grade',  ChoiceType::class,
        [
            'label' => 'Phân loại',
            'required' => true,
            'choices' => [
                  ' ' =>' ',
                '6.5' => '6.5',
                '8.5' => '8.5',
                '10' => '10'
            ],
            'multiple' => false, //false (default), Hold CTRL to select muliple
            'expanded' => false  //false: drop-down (default), true: radio button

        ])
        ->add('comment', ChoiceType::class,
        [
            'label' => 'Phân loại',
            'required' => true,
            'choices' => [
                ' ' =>' ',
                'Pass' => 'Pass',
                'Merit' => 'Merit',
                'Des' => 'Des'
            ],
            'multiple' => false, //false (default), Hold CTRL to select muliple
            'expanded' => false  //false: drop-down (default), true: radio button

        ])
        ->add('student', EntityType::class, [
            'label' => 'Course Name',
            'required' => true,
            'class' => Student::class,
            'choice_label' => 'name',
            'multiple' => false,
            'expanded' => false
        ])
        ->add('teacher', EntityType::class, [
            'label' => 'Course Name',
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
