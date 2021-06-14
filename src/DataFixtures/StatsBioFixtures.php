<?php

namespace App\DataFixtures;

use App\Entity\StatsBio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatsBioFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $statsBio = new StatsBio();
        $statsBio->setHeight(1.75);
        $statsBio->setWeight(70.95);

        $manager->flush();
    }
}
