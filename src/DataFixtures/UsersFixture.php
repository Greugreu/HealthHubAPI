<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class UsersFixture extends Fixture
{

//    private $encoder;
//
//    public function __construct(UserPasswordEncoderInterface $encoder)
//    {
//        $this->encoder = $encoder;
//    }

    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $user->setFirstname("Jean miche");
        $user->setLastname("de la magnagna");
        $user->setMail("jeanmiche@gmail.com");


        $user->setPassword(password_hash('putain', PASSWORD_BCRYPT ));

        $manager->persist($user);
        $manager->flush();
    }
}
