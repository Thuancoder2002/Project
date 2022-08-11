<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $student = new Student;
        $student->setName("Nguyen Van A");
        $student->setEmail("nguyenvana@fpt.edu.vn");
        $student->setStudentid("GCH200888");
        $student->setPhone("0379172187");
        $student->setImage("https://www.nssi.com/media/wysiwyg/images/2.jpg");
        $student->setBrithday(\DateTime::createFromFormat('Y-m-d','2001-03-06'));

        $manager->flush();
    }
}

