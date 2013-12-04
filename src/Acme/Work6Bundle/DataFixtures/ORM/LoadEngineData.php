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
        $engine->setDescription('The Daimler-Benz DB 605 is a German aircraft engine, built during World War II. Developed from the DB 601, the DB 605 was used from 1942 to 1945. \nThe primary differences between the 605 and 601 were greater displacement, higher revolutions, higher compression ratio and a more powerful supercharger. Through careful study the engineers determined that the cylinders could be bored out to a larger diameter without seriously affecting the strength of the existing block. The difference was minimal, increasing from the 601s 150 mm cylinder bore to the 605s 154 mm, but this increased the overall displacement from 33.9 litres to 35.7. Altered valve timing increased the inlet period and improved the scavenging to give greater volumetric efficiency at higher speeds, which improved the maximum allowable RPM from 2,600 in the 601 to 2,800 in the 605. The combination of these changes raised power output from 1,350 PS (1,332 hp) to 1,475 PS (1455 hp). The engine was otherwise similar, notably in size, which was identical to the 601. However, its weight did increase from 700 to 756 kg.');
        $manager->persist($engine);

        $engine1 = new Engine();
        $engine1->setName('Packard V-1650');
        $engine1->setImg('V1650.jpg');
        $engine1->setDescription('The Packard V-1650 was a version of the Rolls-Royce Merlin aircraft engine, produced under licence in the United States by the Packard Motor Car Company. The engine was licensed in order to provide a 1,500 hp (1,100 kW; 1,500 PS)-class design at a time when U.S. engines of this rating were not considered ready for use even after years of development.\r\nThe first V-1650s, with a simple one-stage supercharger, were used in the P-40F Kittyhawk fighter. Later versions included a much more advanced two-stage supercharger for greatly improved performance at high altitudes. It found its most famous application in the North American P-51 Mustang fighter, where it vastly improved that aircraft\'s performance at altitude, transforming the Mustang into an outstanding fighter with the range and performance to escort heavy bombers over the European continent. By 1944, P-51B, P-51C and P-51D "Merlin" Mustangs were able to escort Allied heavy bombers in daylight all the way to Berlin and yet were still capable of combating German fighters attempting to intercept the bombers. By late 1944, the Allies had won air supremacy over the whole of Germany, and Germany\'s defeat in World War II began to appear inevitable.');
        $manager->persist($engine1);

        $engine2 = new Engine();
        $engine2->setName('Shvetsov ASh-82');
        $engine2->setImg('ASh_82.jpg');
        $engine2->setDescription('The Shvetsov ASh-82 (M-82) is a 14-cylinder, two-row, air-cooled radial aircraft engine developed from the Shvetsov M-62. The M-62 was the result of development of the M-25, which was a licensed version of the Wright R-1820 Cyclone. Arkadiy Shvetsov developed the Wright Cyclone design, reducing the stroke, dimensions and weight. This allowed the engine to be used in light aircraft, where a Twin Cyclone could not be installed.[1] It entered production in 1940 and saw service in a number of Soviet aircraft. It powered the Tupolev Tu-2 and Pe-8 bombers and the inline engine-powered LaGG-3 was adapted for the ASh-82, additionally the famous Lavochkin La-5, Lavochkin La-7 fighters, and the Ilyushin Il-14 airliner were created around the engine. Over 70,000 ASh-82s were built.');
        $manager->persist($engine2);

        $engine3 = new Engine();
        $engine3->setName('Napier Sabre');
        $engine3->setImg('napier_sabre.jpg');
        $engine3->setDescription('The Napier Sabre was a British H-24-cylinder, liquid cooled, sleeve valve, piston aero engine, designed by Major Frank Halford and built by Napier & Son during World War II. The engine evolved to become one of the most powerful inline piston aircraft engines in the world developing from 2,200 horsepower (1,640 kW) in its earlier versions to 3,500 hp (2,600 kW) in late-model prototypes.[1]\r\nThe first operational aircraft to be powered by the Sabre were the Hawker Typhoon and Hawker Tempest; however, the first aircraft powered by the Sabre was the Napier-Heston Racer, which was designed to capture the world speed record[nb 1]. Other aircraft using the Sabre were early prototype and production variants of the Blackburn Firebrand, the Martin-Baker MB 3 prototype and one of the Hawker Fury prototypes. The rapid conversion to jet engines after the war led to the quick demise of the Sabre, because Napier also turned to developing jet engines.');
        $manager->persist($engine3);

        $manager->flush();

        $this->addReference('engine', $engine);
        $this->addReference('engine1', $engine1);
        $this->addReference('engine2', $engine2);
        $this->addReference('engine3', $engine3);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
} 