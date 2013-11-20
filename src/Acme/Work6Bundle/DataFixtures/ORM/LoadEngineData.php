<?php

namespace Acme\Work6Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\Work6Bundle\Entity\Engine;

class LoadEngineData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $engine = new Engine();
        $engine->setName('Daimler-Benz DB 605 DC');
        $engine->setImg('db605dc.jpg');
        $engine->setDescription('The primary differences between the 605 and 601 were greater displacement, higher
                                revolutions, higher compression ratio and a more powerful supercharger. Through
                                careful study the engineers determined that the cylinders could be bored out to a
                                larger diameter without seriously affecting the strength of the existing block.
                                The difference was minimal, increasing from the 601\'s 150 mm cylinder bore to the 605\'s
                                154 mm, but this increased the overall displacement from 33.9 litres to 35.7. Altered
                                valve timing increased the inlet period and improved the scavenging to give greater
                                volumetric efficiency at higher speeds, which improved the maximum allowable RPM from
                                2,600 in the 601 to 2,800 in the 605. The combination of these changes raised power
                                output from 1,350 PS (1,332 hp) to 1,475 PS (1455 hp). The engine was otherwise similar,
                                notably in size, which was identical to the 601. However, its weight did increase from
                                700 to 756 kg.');

        $manager->persist($engine);
        $manager->flush();

        $this->addReference('engine', $engine);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
} 