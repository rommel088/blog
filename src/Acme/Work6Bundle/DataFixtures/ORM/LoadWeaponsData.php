<?php

namespace Acme\Work6Bundle\DataFixtures\ORM;

use Acme\Work6Bundle\Entity\Weapons;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $weapons = new Weapons();
        $weapons->setName('MG151');
        $weapons->setImg('mg151.jpg');
        $weapons->setDescription('dfgsd adsgdg aerg');

        $manager->persist($weapons);
        $manager->flush();

        $this->addReference('weapons', $weapons);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
} 