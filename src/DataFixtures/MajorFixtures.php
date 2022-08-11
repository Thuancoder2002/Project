<?php

namespace App\DataFixtures;

use App\Entity\Major;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MajorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i=1; $i<=5; $i++) {
            $major = new Major;
            $major->setName("Major $i");
            $major->setDescrible("This is my major");
            $manager->persist($major);
        }

       

        $manager->flush();
    }
}
