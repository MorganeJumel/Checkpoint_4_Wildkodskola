<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        // Creation of a user 
        $user = new User();
        $user->setFirstName('Eirikr');
        $user->setLastName('Thorvaldson');
        $user->setEmail('thered@greenland.com');
        $user->setPhoneNumber('2996304627');
        $user->setRoles(['ROLE_user']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userpassword'
        ));

        $manager->persist($user);

        // Creation of an administrator
        $admin = new User();
        $admin->setFirstName('Thor');
        $admin->setLastName('Odenson');
        $admin->setEmail('admin@asgard.com');
        $admin->setPhoneNumber('2996304626');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        // Saving both users
        $manager->flush();
    }
}
