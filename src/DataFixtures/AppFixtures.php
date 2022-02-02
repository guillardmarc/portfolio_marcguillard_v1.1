<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Presentations;
use App\Entity\UpdateWebsites;
use App\Entity\Websites;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder =$encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // Phpfaker initialization:
        $faker = Factory::create('fr_FR');

        // User initialization:
        $user = new Users();

        // User creation:
        $user->setEmail('guillardmarc44@gmail.com')
             ->setRoles(['ROLE_ADMIN']);
            // Password hash
            $password = $this->encoder->encodePassword($user, 'FI1ILVKYalm11011983@');
        $user->setPassword($password);

        // User persist:
        $manager->persist($user);

        // Presentation initialization:
        $presentation = new Presentations();

        // Presentation creation:
        $presentation->setCreatedAt(new DateTime())
                     ->setModifiedAt(new DateTime())
                     ->setLastName('GUILLARD')
                     ->setFirstName('Marc')
                     ->setBirthDate(new DateTime('11/01/1983'))
                     ->setEmail('guillardmarc44@gmail.com')
                     ->setPhone('0663607861')
                     ->setJob('Dévéloppeur Web Web Mobile')
                     ->setContent($faker->text())
                     ->setPictureLink('https://loremflickr.com/320/240?lock=1')
                     ->setIsPublished(0);
        
        // Presentation persist:
        $manager->persist($presentation);

        // Website initialisation
        $website = new Websites();

        // Website creation:
        $website->setCreatedAt(new DateTime())
                ->setModifiedAt(new DateTime())
                ->setRegulation($faker->text())
                ->setCopyright($faker->text())
                ->setVersion('V 1.0');
        
        // Website persist
        $manager->persist($website);

        // UpdateWebsite initialization:
        $updateWebsite = new UpdateWebsites();

        // UpdateWebsite creation:
        $updateWebsite->setCreatedAt(new DateTime())
                      ->setModifiedAt(new DateTime())
                      ->setName($faker->text())
                      ->setContent($faker->text())
                      ->setWebsites($website);
        
        // UpdateWebsite persist:
        $manager->persist($updateWebsite);

        $manager->flush();
    }
}
