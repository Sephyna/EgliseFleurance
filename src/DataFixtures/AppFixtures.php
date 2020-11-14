<?php

namespace App\DataFixtures;

use App\Entity\Roles;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Roles();
        $admin->setName('Administrateur');
        $manager->persist( $admin);
        $modo = new Roles();
        $modo->setName('Modérateur');
        $manager->persist( $modo);
        $member = new Roles();
        $member->setName('Membre');
        $manager->persist( $member);

        $firstUser = new Users();
        $firstUser->setEmail('cindy_boccard@hotmail.fr');
        $firstUser->setPassword('$2y$10$oBXo9SVcHUuVgijpN0cTXuvPbSIqInt4Hgvu/Qz96vNU3bSdKvZQm');
        $firstUser->setRole($admin);
        $manager->persist( $firstUser);

        $manager->flush();

    }
}
