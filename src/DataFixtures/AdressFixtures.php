<?php

namespace App\DataFixtures;

use App\Entity\AdressBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdressFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 4; $i++){
            $address = new AdressBook();
            $address->setStreetNum("street num$i");
            $address->setStreet("street$i");
            $address->setRegion("region$i");
            $address->setCity("city$i");
            $address->setContry("Country$i");
            $manager->persist($address);
        }


        $manager->flush();
    }
}
