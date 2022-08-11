<?php

namespace App\DataFixtures;

use App\Entity\Grade;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GradeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       for ($i=1; $i<=5; $i++) {
            $grade = new Grade;
            $grade->setGrade(rand(30,60));
            $grade->setComment("This is my grade");
            $manager->persist($grade);
        }

        $manager->flush();
    }
}