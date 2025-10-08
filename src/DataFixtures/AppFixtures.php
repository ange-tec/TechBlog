<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setEmail("test@gmail.com");
        $user->setName("test");
        $user->setBiography("test set test");
        $user->setPassword("test");
        $user->setInscriptionDate(\DateTime::createFromFormat(\DateTimeInterface::W3C, '2004-02-12T15:19:21+00:00'));
        $manager->persist($user);
        $manager->flush();
    }
}
