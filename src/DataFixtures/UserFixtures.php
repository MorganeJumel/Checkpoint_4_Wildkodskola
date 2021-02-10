<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    const USERS = [
        'Eirikr' => [
            'email' => 'thered@greenland.com',
            'lastname' => 'Thorvaldson',
            'password' => 'userpassword',
            'role' => 'ROLE_user',
            'phonenumber' => '2996304627'
        ],
        'Thor' => [
            'email' => 'admin@asgard.com',
            'lastname' => 'Odenson',
            'password' => 'adminpassword',
            'role' => 'ROLE_ADMIN',
            'phonenumber' => '2996304626'
        ]
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::USERS as $name => $data) {
            $user = new User();
            $user->setFirstName($name);
            $user->setLastName($data['lastname']);
            $user->setEmail($data['email']);
            $user->setPhoneNumber($data['phonenumber']);
            $user->setRoles([$data['role']]);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $data['password']
            ));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
            $i++;
        }
        $manager->flush();
    }
}