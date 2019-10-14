<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }




    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");


        for($i=0; $i<30; $i++)
        {
            $contact = new Contact();
            $contact->setNom($faker->lastName);
            $contact->setPrenom($faker->firstName);
            $contact->setEmail($faker->email);
            $contact->setObjet($faker->sentence(6, true));
            $contact->setMessage($faker->paragraph(7, true));

            $manager->persist($contact);
        }

        $user = new User();
        $user->setLogin("lydie");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            "123"
        ));

        $user->getRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $manager->flush();
    }
}
