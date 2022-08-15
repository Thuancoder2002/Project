<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClassroomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       for ($i=1; $i<=5; $i++) {
            $classroom = new Classroom;
            $classroom->setName("GCH1004 $i");
            $classroom->setDescrible("This is my classroom");
            $manager->persist($classroom);
        }
        $manager->flush();
    }
}