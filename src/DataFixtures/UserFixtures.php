<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class UserFixtures extends Fixture
{
    
    //khai báo thư viện để mã hóa mật khẩu
    //interface: UserPasswordHasherInterface
    //function: hassPassword
    private $hasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        //tạo user với role Admin
        $user = new User;
        $user->setUsername("admin");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $manager->persist($user);

        //tạo user với role Customer
        $user = new User;
        $user->setUsername("student");
        $user->setRoles(['ROLE_STUDENT']);
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $manager->persist($user);

         $user = new User;
        $user->setUsername("teacher");
        $user->setRoles(['ROLE_TEACHER']);
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $manager->persist($user);
        
        
        $manager->flush();
    }
}
