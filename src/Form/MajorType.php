<?php

namespace App\Form;

use App\Entity\Major;
use App\Entity\Student;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MajorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                  'label' => 'Name Major',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 50,
                    ]
            ])
            ->add('describle', TextType::class,[
                  'label' => 'Describle of Major',
                    'required' => true,
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 50,
                    ]


            ])

        ->add('student', EntityType::class, [
                'label' => 'Course Name',
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
                    'label' => 'Add Major'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Major::class,
        ]);
    }
}
