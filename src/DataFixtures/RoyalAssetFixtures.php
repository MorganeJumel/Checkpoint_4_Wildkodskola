<?php

namespace App\DataFixtures;

use App\Entity\RoyalAsset;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RoyalAssetFixtures extends Fixture implements DependentFixtureInterface
{   
    const ROYALASSETS = [
        'Viking Age storage jar' => [
            'description' => 'A pretty storage jar with carved dragons on the lid.',
            'nbAsset' => 1,
            'user' => 'user_0'
        ],
        'Analytical Engine' => [
            'description' => 'The first mechanical computer to be created. Charles Babbage invented it in 1837.',
            'nbAsset' => 1,
            'user' => 'user_0'
        ],
        'Pair of socks' => [
            'description' => 'A pretty pair of socks with bears on it.',
            'nbAsset' => 1,
            'user' => 'user_0'
        ]
    ];
    public function getDependencies()  
    {
        return [UserFixtures::class];  
    }

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::ROYALASSETS as $name => $data) {
            $royalasset = new RoyalAsset();
            $royalasset->setName($name);
            $royalasset->setDescription($data['description']);
            $royalasset->setNbAsset($data['nbAsset']);
            $royalasset->setUser($this->getReference($data['user']));

            $manager->persist($royalasset);
            $i++;
        }
        $manager->flush();
    }
}
