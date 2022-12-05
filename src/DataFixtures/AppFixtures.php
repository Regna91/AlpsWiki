<?php

namespace AlpsWiki\DataFixtures;

use AlpsWiki\Entity\Folder;
use AlpsWiki\Factory\FolderFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        FolderFactory::createMany(10);
    }
}
