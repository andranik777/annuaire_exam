<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setRoles(array('ROLE_RH'));
        $admin->setPassword($this->passwordHasher->hashPassword($admin,"rh123@"));
        $admin->setNom("PELLEGRIN");
        $admin->setPrenom("Anne");
        $admin->setEmail("rh@humanbooster.com");
        $admin->setSecteur("RH");
        $admin->setTypeContrat("CDI");
        $manager->persist($admin);
        $manager->flush();
    }
}
