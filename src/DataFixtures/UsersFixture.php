<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ObjectManager;



class UsersFixture extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $user->setFirstname("Jean miche");
        $user->setLastname("de la magnagna");
        $user->setMail("jeanmiche@gmail.com");


        $user->setPassword($this->passwordEncoder->encodePassword($user, 'LePasswordPutain'));

        $manager->persist($user);
        $manager->flush();
    }
}
