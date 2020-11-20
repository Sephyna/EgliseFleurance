<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $firstUser = new User();
        $firstUser->setEmail('cindy_boccard@hotmail.fr');
        $firstUser->setPassword('$2y$10$oBXo9SVcHUuVgijpN0cTXuvPbSIqInt4Hgvu/Qz96vNU3bSdKvZQm');
        $firstUser->setRoles(['ROLE_ADMIN','ROLE_MODERATOR','ROLE_USER' ]);

        $firstUser->setIsVerified(1);
        $manager->persist( $firstUser);

        $manager->flush();

    }
}
