<?php

namespace Acme\Work6Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\Work6Bundle\Entity\Plane;

class LoadPlaneData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $plane = new Plane();
        $plane = new Plane();
        $plane->setName("Messerschmitt Bf.109G-10");
        $plane->setImg('bf109g10.jpg');
        $plane->setDescription("Без внешних подвесок и с двигателем DB 605DC Bf 109G-10 был самым скоростным
                                        вариантом серии G, развивая при весе 3100 кг у земли 550 км/ч и 680 км/ч на высоте
                                        7400 м. Высота в 6000 м набиралась за 5,8 мин.");
        $plane->setTth(json_encode(array('speed'=>'680 km/h')));
        $plane->setEngineId($this->getReference('engine'));
        $plane->addWeapon($this->getReference('weapons'));

        $manager->persist($plane);
        $manager->flush();

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}