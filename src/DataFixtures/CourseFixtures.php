<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         for ($i=1; $i<=5; $i++) {
            $course = new Course;
            $course->setName("SDCL $i");
            $course->setimage("https://image.shutterstock.com/image-photo/confident-intelligence-grey-hair-senior-260nw-261010109.jpg");
            $course->setdescrible("This is my course");
            $manager->persist($course);
        }
     

        $manager->flush();
    }
}