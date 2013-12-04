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
        $weapons->setName('MG 151');
        $weapons->setImg('mg151.jpg');
        $weapons->setDescription('The MG 151 (MG 151/15) was a 15 mm aircraft-mounted autocannon produced by Waffenfabrik Mauser during World War II. It was the prototype for the 20 mm MG 151/20 cannon widely used on German Luftwaffe fighters, night fighters, fighter-bombers, bombers and ground-attack aircraft. Salvaged guns saw post-war use by other nations.');

        $manager->persist($weapons);

        $weapons1 = new Weapons();
        $weapons1->setName('MG 131');
        $weapons1->setImg('mg131.jpg');
        $weapons1->setDescription('The MG 131 (shortened from German: Maschinengewehr 131, or "Machine gun 131") was a German 13 mm caliber machine gun developed in 1938 by Rheinmetall-Borsig and produced from 1940 to 1945. The MG 131 was designed for use at fixed, flexible or turreted, single or twin mountings in Luftwaffe aircraft during World War II.');

        $manager->persist($weapons1);

        $weapons2 = new Weapons();
        $weapons2->setName('AN/M2 Browning .50');
        $weapons2->setImg('an_m2.jpg');
        $weapons2->setDescription('The M2 machine gun was widely used during World War II and in later postwar conflicts as a remote or flexible aircraft gun. For fixed (offensive) or flexible (defensive) guns used in aircraft, a dedicated M2 version was developed called the .50 Browning AN/M2. The "AN" stands for "Army/Navy", since the gun was developed jointly for use by both services (unusual for the time, when the delineations between the Army and Navy were much stricter, and relations between armed services were often cool, if not outright hostile.) The AN/M2 had a cyclic rate of 750–850 rounds per minute, with the ability to be fired from an electrically operated remote-mount solenoid trigger when installed as a fixed gun. Cooled by the aircraft\'s slip-stream, the air-cooled AN/M2 was fitted with a substantially lighter 36-inch (91 cm) length barrel, lightening the complete unit to 61 pounds (28 kg), which also had the effect of increasing the rate of fire. The official designation for this weapon was Browning Machine Gun, Aircraft, Cal. .50, AN/M2 (Fixed) or (Flexible).');

        $manager->persist($weapons2);

        $weapons3 = new Weapons();
        $weapons3->setName('HVAR');
        $weapons3->setImg('hvar.jpg');
        $weapons3->setDescription('The HVAR was designed by engineers at Caltech during World War II as an improvement on the 5-Inch Forward Firing Aircraft Rocket (FFAR), which had a 5 inch diameter warhead but an underpowered 3.25 inch diameter rocket motor. The desire for improved accuracy from the flatter trajectory of a faster rocket spurred the rapid development. HVAR had a constant 5” diameter for both warhead and rocket motor, increasing propellant from 8.5 lb to 23.9 lb of Ballistite. U.S. Ballistite propellant had a sea level specific impulse of over 200 seconds, compared with about 180 seconds for the British Cordite, German WASAG and Soviet PTP propellants. Hercules Powder Company was the principal U.S. supplier of high performance extruded Ballistite propellants: 51.5% nitrocellulose, 43% nitroglycerine, 3.25% diethylphthalate, 1.25% potassium sulphate, 1% ethyl centralite, and 0.2% carbon black. The propellant in U.S. 3.25” and 5” rocket motors consisted of a single large X shaped “cruciform” Ballistite grain. This went against the common practice of filling rocket motors with different numbers of smaller same-sized tubular charges, the number depending on motor diameter. The central hole in a tubular charge makes it more difficult to extrude, requiring a softer propellant blend that also yields somewhat lower performance. Rocket ∆V increased from 710 ft/sec for the 5” AR to 1375 ft/sec for HVAR, giving the coveted flat trajectory.');

        $manager->persist($weapons3);

        $weapons4 = new Weapons();
        $weapons4->setName('Hispano-Suiza HS.404');
        $weapons4->setImg('hs_404.jpg');
        $weapons4->setDescription('In the buildup to the Second World War, the United Kingdom had embarked on a programme to develop cannon-armed fighters and acquired a licence to build the HS.404, which entered production as the Hispano Mk.I intended as aeroplane armament. Its first use was in the Westland Whirlwind of 1940, and later in the more powerful Bristol Beaufighter, providing the Royal Air Force with powerful cannon-armed interceptors. The experience of the Battle of Britain had shown the batteries of eight rifle-calibre machine guns to be inadequate and prompted the adoption of auto cannon armament for the primary portion of Royal Air Force (RAF) fighters. The Beaufighter highlighted the need for a belt feed mechanism; as a night fighter the 60-round drums needed to be replaced in the dark by the Radar/Wireless Operator, often while the aircraft was manoeuvering to keep sight of its quarry. In addition, the early trial installations in the Hawker Hurricane and Supermarine Spitfire had shown a tendency for the gun to jam during combat manouvres, leading to some official doubt as to the suitability of cannons as the sole main armament. This led briefly to the Air Ministry specifying 12-machine gun armament for new fighters.');

        $manager->persist($weapons4);

        $weapons5 = new Weapons();
        $weapons5->setName('RP-3');
        $weapons5->setImg('rp_3.jpg');
        $weapons5->setDescription('The RP-3 (from Rocket Projectile 3 inch) was a British rocket projectile used during and after the Second World War. Though primarily an air-to-ground weapon, it saw limited use in other roles. Its 60 lb (27 kg ) warhead gave rise to the alternative name of the "60 lb rocket"; the 25 lb (11.3 kg) solid-shot armour piercing variant was referred to as the "25 lb rocket". They were generally used by British fighter-bomber aircraft against targets such as tanks, trains, motor transport and buildings, and by Coastal Command and Royal Navy aircraft against U-boats and shipping.');

        $manager->persist($weapons5);

        $weapons6 = new Weapons();
        $weapons6->setName('ShVAK');
        $weapons6->setImg('ShVAK.jpg');
        $weapons6->setDescription('The ShVAK (Russian: ШВАК: Шпитальный-Владимиров Авиационный Крупнокалиберный, Shpitalnyi-Vladimirov Aviatsionnyi Krupnokalibernyi, "Shpitalny-Vladimirov large-calibre for aircraft") was a 20 mm autocannon used by the Soviet Union during World War II. It was designed by Boris Shpitalniy and Semyon Vladimirov and entered production in 1936. ShVAK were installed in many models of Soviet aircraft. The TNSh was a version of the gun produced for light tanks (Russian: ТНШ: Tankovyi Nudel’man-Shpitalnyi).');

        $manager->persist($weapons6);

        $weapons7 = new Weapons();
        $weapons7->setName('MG 17');
        $weapons7->setImg('mg17.jpg');
        $weapons7->setDescription('The MG 17 was a 7.92 mm machine gun produced by Rheinmetall-Borsig for use at fixed mountings in many World War II Luftwaffe aircraft. A mainstay fixed machine gun in German built aircraft (many of which were sold to other countries) well before World War II, by 1940 it was starting to be replaced with heavier caliber machine gun and cannons. By 1945 very few if any aircraft mounted the MG 17.\r\nThe MG 17 was installed in the Messerschmitt Bf 109, Messerschmitt Bf 110, Focke-Wulf Fw 190, Junkers Ju 87, Junkers Ju 88C Nightfighter, Heinkel He 111, Dornier Do 17/215 Nightfighter, Focke-Wulf Fw 189 and many other aircraft. Many MG 17s were later modified for infantry use as heavier weapons replaced them on Luftwaffe aircraft. Official numbers of conversions was about 24,271 by January 1, 1944, although additional conversions may have been done as well.');

        $manager->persist($weapons7);

        $manager->flush();

        $this->addReference('weapons', $weapons);
        $this->addReference('weapons1', $weapons1);
        $this->addReference('weapons2', $weapons2);
        $this->addReference('weapons3', $weapons3);

        $this->addReference('weapons4', $weapons4);
        $this->addReference('weapons5', $weapons5);
        $this->addReference('weapons6', $weapons6);
        $this->addReference('weapons7', $weapons7);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
} 