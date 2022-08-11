<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $teacher = new Teacher;
        $teacher->setName("Nguyen van A");
        $teacher->setEmail("abc@fpt.edu.vn");
        $teacher->setPhone("0379172187");
        $teacher->setaddress("Hanoi");
        $teacher->setImage("https://www.nssi.com/media/wysiwyg/images/2.jpg");
        $teacher->setBirthday(\DateTime::createFromFormat('Y-m-d','2001-03-06'));
      $manager->persist($teacher);

        $manager->flush();
    }
}