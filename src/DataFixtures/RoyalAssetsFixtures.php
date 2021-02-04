<?php

namespace App\DataFixtures;

use App\Entity\RoyalAssets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoyalAssetsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Creation of a royal asset
        $storageJar = new RoyalAssets();
        $storageJar->setName('Viking Age storage jar');
        $storageJar->setDescription('A pretty storage jar with carved dragons on the lid.');
        $storageJar->setNbAsset(1);

        $manager->persist($storageJar);
        $manager->flush();

        $analyticalEngine = new RoyalAssets();
        $analyticalEngine->setName('Analytical Engine');
        $analyticalEngine->setDescription('The first mechanical computer to be created. Charles Babbage invented it in 1837.');
        $analyticalEngine->setNbAsset(1);

        $manager->persist($analyticalEngine);
        $manager->flush();
    }
}
