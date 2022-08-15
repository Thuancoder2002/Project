<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',
        TextType::class,
        [
            
            'label' => 'Student Name',
            'required'=> true,
            'attr' => [
                'minlength' => 5,
                'maxlength' => 100,
                'placeholder' => 'Enter Name of Teacher '
            ],
        
        ])
    ->add('image', TextType::class,
        [
            'label' => 'Student Image',
            'required' => true,
            'attr' => [
                'minlength' => 5,
                'maxlength' => 500,
                'placeholder' => 'Enter image or link '
            ],
        ])

    ->add('birthday',DateType::class,
        [
            'label' => 'Student Birthday',
            'required' => true,
            'widget' => 'single_text'

        ])
    ->add('email',TextType::class,
        [
            'label' => 'Student Email',
            'required' => true,
            'attr' => [
                'minlength' => 5,
                'maxlength' => 50,
                'placeholder' => 'Enter Email of you'
            ],
        ])
    ->add('phone', TextType::class,
        [
            'label' => 'Student Phone',
            'required' => true,
            'attr' => [
                'minlength' => 5,
                'maxlength' => 50,
                'placeholder' => 'Enter PhoneNumber '
            ],
        ])
    ->add('address', ChoiceType::class,
    [
        'label' => 'Phân loại',
        'required' => true,
        'choices' => [
             'An Giang'=>'An Giang',
            'Bà Rịa-Vũng Tàu'=>'Bà Rịa-Vũng Tàu',
               'Bạc Liêu'=>'Bạc Liêu',
'Bắc Giang'=>'Bắc Giang',
'Bắc Ninh'=>'Bắc Ninh',
'Bến Tre'=>'Bến Tre',
'Bình Dương'=>'Bình Dương',
'Bình Định'=>'Bình Định',
'Bình Phước'=>'Bình Phước',
'Bình Thuận'=>'Bình Thuận',
'Cà Mau'=>'Cà Mau',
'Cao Bằng'=>'Cao Bằng',
'Cần Thơ (TP)'=>'Cần Thơ',
'Đà Nẵng (TP)'=>'Đà Nẵng',
'Đắk Lắk'=>'Đắk Lắk',
'Đắk Nông'=>'Đắk Nông',
'Điện Biên'=>'Điện Biên',
'Đồng Nai'=>'Đồng Nai',
'Đồng Tháp'=>'Đồng Tháp',
'Gia Lai'=>'Gia Lai',
'Hà Giang'=>'Hà Giang',
'Hà Nam'=>'Bến Tre',
'Hà Nội (TP)=>"Hà Nội',
'Hà Tĩnh'=>'Hà Tĩnh',
'Hải Dương'=>'Hải Dương',
'Hải Phòng (TP)'=>'Hải Phòng (TP)',
'Hòa Bình'=>'Hòa Bình',
'Hồ Chí Minh (TP)'=>'Hồ Chí Minh (TP)',
'Hậu Giang'=>'Hậu Giang',
'Hưng Yên'=>'Hưng Yên',
'Khánh Hòa'=>'Khánh Hòa',
'Kiên Giang'=>'Kiên Giang',
'Kon Tum'=> 'Kon Tum',
'Lai Châu'=>'Lai Châu',
'Lào Cai'=>'Lào Cai',
'Lạng Sơn'=> 'Lạng Sơn',
'Lâm Đồng'=>'Lâm Đồng',
'Long An'=> 'Long An',
'Nam Định'=>'Nam Định',
'Nghệ An'=>'Nghệ An',
'Ninh Bình'=>'Ninh Bình',
'Ninh Thuận'=>'Ninh Thuận',
'Phú Thọ'=>'Phú Thọ',
'Phú Yên'=> 'Phú Yên',
'Quảng Bình'=>'Quảng Bình',
'Quảng Nam'=> 'Quảng Nam',
'Quảng Ngãi'=>'Quảng Ngãi',
'Quảng Ninh'=>'Quảng Ninh',
'Quảng Trị'=>'Quảng Trị',
'Sóc Trăng'=>'Sóc Trăng',
'Sơn La'=> 'Sơn La',
'Tây Ninh'=>'Tây Ninh',
'Thái Bình'=>'Thái Bình',
'Thái Nguyên'=> 'Thái Nguyên',
'Thanh Hóa'=>'Thanh Hóa',
'Thừa Thiên Huế' =>'Huế',
'Tiền Giang'=> 'Tiền Giang',
'Trà Vinh'=> 'Trà Vinh',
'Tuyên Quang'=>'Tuyên Quang',
'Vĩnh Long'=>'Vĩnh Long',
'Vĩnh Phúc'=> 'Vĩnh Phúc',
'Yên Bái'=>'Yên Bái'
             
        ],
        'multiple' => false, //false (default), Hold CTRL to select muliple
        'expanded' => false  //false: drop-down (default), true: radio button

    ])
    ->add('courses',EntityType::class, [
        'label' => 'Course Name',
        'required' => true,
        'class' => Course::class,
        'choice_label' => 'name',
        'multiple' => true,
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
            'data_class' => Teacher::class,
        ]);
    }
}
