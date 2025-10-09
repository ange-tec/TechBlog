<?php

namespace App\DataFixtures;

use App\Entity\Article;
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
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setInscriptionDate(\DateTime::createFromFormat(\DateTimeInterface::W3C, '2004-02-12T15:19:21+00:00'));
        $manager->persist($user);
        $manager->flush();

        $article = new Article();
        $article->setTitle("L’intelligence artificielle révolutionne le développement web en 2025");
        $article->setSummary("
        En 2025, l’intelligence artificielle s’impose comme un allié incontournable des développeurs web.
        Des assistants de code intelligents aux frameworks autonomes, le paysage du développement évolue plus vite que jamais.
        ");
        $article->setContent("
        De plus, les frameworks modernes s’adaptent à cette nouvelle ère :
        Symfony, Laravel et Next.js intègrent déjà des modules d’assistance pilotés par IA.
        ");
        $article->setImage('./public/images/desert.jpeg');
        $article->setNbrView("12");
        $article->setDate(\DateTime::createFromFormat(\DateTimeInterface::W3C, '2004-02-12T15:19:21+00:00'));
        $manager->persist($article);
        $manager->flush();
    }
}
