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
        $plane->setName("Messerschmitt Bf 110");
        $plane->setImg('bf110.jpg');
        $plane->setDescription("The Messerschmitt Bf 110, often (erroneously) called Me 110, was a twin-engine heavy fighter (Zerstörer—German for \"Destroyer\") in the service of the Luftwaffe during World War II. Hermann Göring was a proponent of the Bf 110, and nicknamed it his Eisenseiten (\"Ironsides\"). Development work on an improved type to replace the Bf 110, the Messerschmitt Me 210 began before the war started, but its teething troubles resulted in the Bf 110 soldiering on until the end of the war in various roles, alongside its replacements, the Me 210 and the Me 410.', 'General characteristics\r\nCrew: 2 (3 for night fighter variants)\r\nLength: 12.3 m (40 ft 6 in)\r\nWingspan: 16.3 m (53 ft 4 in)\r\nHeight: 3.3 m (10 ft 9 in)\r\nWing area: 38.8 m² (414 ft²)\r\nLoaded weight: 7,790 kg (17,158 lb)\r\nPowerplant: 2 × Daimler-Benz DB 605B liquid-cooled inverted V-12, 1,085 kW (1,455 HP)1,475 PS each\r\nPerformance\r\nMaximum speed: 595 km/h (370 mph)\r\nRange: 900 km (558 mi); 1,300 km (807 mi) with droptanks\r\nService ceiling: 11,000 m (36,000 ft)\r\nRate of climb: 8 min to 6,000 m (20,000 ft)\r\nWing loading: max. 243 kg/m² ()\r\nArmament\r\nGuns:\r\n2 × 20 mm MG 151 cannons 750 rounds: 350 rpg + 400 rpg rounds\r\n4 × 7.92 mm (.312 in) MG 17 machine guns with 1,000 rounds per gun\r\n1 × 7.92 mm (.312 in) MG 81Z twin machine gun installation in rear cockpit, with 850 rounds per gun");
        $plane->setTth(json_encode(array('speed'=>'680 km/h')));
        $plane->setEngineId($this->getReference('engine'));
        $plane->addWeapon($this->getReference('weapons'));
        $plane->addWeapon($this->getReference('weapons7'));

        $manager->persist($plane);

        $plane1 = new Plane();
        $plane1->setName("Messerschmitt Bf 109G");
        $plane1->setImg('bf109g.jpg');
        $plane1->setDescription("The Bf 109 G-series was developed from the largely identical F-series airframe, although there were detail differences. Modifications included a reinforced wing structure, an internal bullet-proof windscreen, the use of heavier, welded framing for the cockpit transparencies, and additional light-alloy armour for the fuel tank. It was originally intended that the wheel wells would incorporate small doors to cover the outer portion of the wheels when retracted. To incorporate these the outer wheel bays were squared off. Two small inlet scoops for additional cooling of the spark plugs were added on both sides of the forward engine cowlings. A less obvious difference was the omission of the boundary layer bypass outlets, which had been a feature of the F-series, on the upper radiator flaps.', 'General characteristics\r\nCrew: One\r\nLength: 8.95 m (29 ft 7 in)\r\nWingspan: 9.925 m (32 ft 6 in)\r\nHeight: 2.60 m (8 ft 2 in)\r\nWing area: 16.05 m² (173.3 ft²)\r\nEmpty weight: 2,247 kg (5,893 lb)\r\nLoaded weight: 3,148 kg (6,940 lb)\r\nMax. takeoff weight: 3,400 kg (7,495 lb)\r\nPowerplant: 1 × Daimler-Benz DB 605A-1 liquid-cooled inverted V12, 1,475 PS (1,455 hp, 1,085 kW)\r\nPropellers: VDM 9-12087 three-bladed light-alloy propeller\r\nPropeller diameter: 3 m (9 ft 10 in)\r\nPerformance\r\nMaximum speed: 640 km/h (398 mph) at 6,300 m (20,669 ft)\r\nCruise speed: 590 km/h (365 mph) at 6,000 m (19,680 ft)\r\nRange: 850 km (528 mi)1,000 km (621 mi) with droptank\r\nService ceiling: 12,000 m (39,370 ft)\r\nRate of climb: 17.0 m/s (3,345 ft/min)\r\nWing loading: 196 kg/m² (40 lb/ft²)\r\nPower/mass: 344 W/kg (0.21 hp/lb)\r\nArmament\r\nGuns:\r\n2 × 13 mm (.51 in) synchronized MG 131 machine guns with 300 rounds per gun\r\n1 × 20 mm MG 151 cannon as Motorkanone with 200 rpg.[72] G-6/U4 variant: 1 × 30 mm (1.18 in) MK 108 cannon as Motorkanone with 65 rpg\r\n2 × 20 mm MG 151/20 underwing cannon pods with 135 rpg (optional kit—Rüstsatz VI)");
        $plane1->setTth(json_encode(array('speed'=>'680 km/h')));
        $plane1->setEngineId($this->getReference('engine'));
        $plane1->addWeapon($this->getReference('weapons'));
        $plane1->addWeapon($this->getReference('weapons1'));

        $manager->persist($plane1);

        $plane2 = new Plane();
        $plane2->setName("North American P-51 Mustang");
        $plane2->setImg('p51d.jpg');
        $plane2->setDescription("The North American Aviation P-51 Mustang was an American long-range, single-seat fighter and fighter-bomber used during World War II, the Korean War and other conflicts. The Mustang was conceived, designed and built by North American Aviation (NAA) in response to a specification issued directly to NAA by the British Purchasing Commission. The prototype NA-73X airframe was rolled out on 9 September 1940, 102 days after the contract was signed and, with an engine installed, first flew on 26 October.', 'General characteristics\r\nCrew: 1\r\nLength: 32 ft 3 in (9.83 m)\r\nWingspan: 37 ft 0 in (11.28 m)\r\nHeight: 13 ft 4½ in (4.08 m:tail wheel on ground, vertical propeller blade.)\r\nWing area: 235 sq ft (21.83 m²)\r\nEmpty weight: 7,635 lb (3,465 kg)\r\nLoaded weight: 9,200 lb (4,175 kg)\r\nMax. takeoff weight: 12,100 lb (5,490 kg)\r\nPowerplant: 1 × Packard V-1650-7 liquid-cooled supercharged V-12, 1,490 hp (1,111 kW) at 3,000 rpm;[89] 1,720 hp (1,282 kW) at WEP\r\nZero-lift drag coefficient: 0.0163\r\nDrag area: 3.80 sqft (0.35 m²)\r\nAspect ratio: 5.83\r\nPerformance\r\nMaximum speed: 437 mph (380 kn, 703 km/h) at 25,000 ft (7,600 m)\r\nCruise speed: 362 mph (315 kn, 580 km/h)\r\nStall speed: 100 mph (87 kn, 160 km/h)\r\nRange: 1,650 mi (1,434 nmi, 2,755 km)with external tanks\r\nService ceiling: 41,900 ft (12,800 m)\r\nRate of climb: 3,200 ft/min (16.3 m/s)\r\nWing loading: 39 lb/sqft (192 kg/m²)\r\nPower/mass: 0.18 hp/lb (300 W/kg)\r\nLift-to-drag ratio: 14.6\r\nRecommended Mach limit 0.8\r\nArmament\r\n6× 0.50 caliber (12.7mm) M2 Browning machine guns with 1,880 total rounds (400 rounds for each on the inner pair, and 270 rounds for each of the outer two pair)\r\n2× hardpoints for up to 2,000 lb (907 kg) of bombs\r\n6 or 10× T64 5.0 in (127 mm) H.V.A.R rockets (P-51D-25, P-51K-10 on)");
        $plane2->setTth(json_encode(array('speed'=>'680 km/h')));
        $plane2->setEngineId($this->getReference('engine1'));
        $plane2->addWeapon($this->getReference('weapons2'));
        $plane2->addWeapon($this->getReference('weapons3'));

        $manager->persist($plane2);

        $plane3 = new Plane();
        $plane3->setName("Lavochkin La-7");
        $plane3->setImg('la7.jpg');
        $plane3->setDescription("The Lavochkin La-7 (Russian: Лавочкин Ла-7) was a piston-engined Soviet fighter developed during World War II by the Lavochkin Design Bureau (OKB). It was a development and refinement of the Lavochkin La-5, and the last in a family of aircraft that had begun with the LaGG-1 in 1938. Its first flight was in early 1944 and it entered service with the Soviet Air Forces later in the year. A small batch of La-7s was given to the Czechoslovak Air Force the following year, but it was otherwise not exported. Armed with two or three 20 mm (0.79 in) cannon, it had a top speed of 661 kilometers per hour (411 mph). The La-7 was felt by its pilots to be at least the equal of any German piston-engined fighter and even shot down a Messerschmitt Me 262 jet fighter. It was phased out in 1947 by the Soviet Air Force, but lasted until 1950 with the Czechoslovak Air Force.', 'General characteristics\r\nCrew: 1\r\nLength: 8.6 m (28 ft 3 in)\r\nWingspan: 9.8 m (32 ft 2 in)\r\nHeight: 2.54 m (8 ft 4 in)\r\nWing area: 17.59 m2 (189.3 sq ft)\r\nGross weight: 3,315 kg (7,308 lb)\r\nPowerplant: 1 × Shvetsov ASh-82FN 14-cylinder, two-row, air-cooled radial, 1,230 kW (1,650 hp)\r\nPropellers: 3-bladed VISh-105V-4\r\nPerformance\r\nMaximum speed: 661 km/h (411 mph; 357 kn) @ 6,000 meters (19,685 ft)\r\nRange: 665 km (413 mi; 359 nmi) (1944 model)\r\nService ceiling: 10,450 m (34,285 ft)\r\nRate of climb: 15.72 m/s (3,095 ft/min)\r\nTime to altitude: 5.3 minutes to 5,000 meters (16,404 ft)\r\nArmament\r\nGuns: 2 × 20 mm ShVAK cannons with 200 rounds per gun or 3 × 20 mm Berezin B-20 cannons with 100 rpg\r\nBombs: 200 kg (440 lb) of bombs");
        $plane3->setTth(json_encode(array('speed'=>'680 km/h')));
        $plane3->setEngineId($this->getReference('engine2'));
        $plane3->addWeapon($this->getReference('weapons6'));

        $manager->persist($plane3);

        $plane4 = new Plane();
        $plane4->setName("Hawker Typhoon");
        $plane4->setImg('typhoon.jpg');
        $plane4->setDescription("The Hawker Typhoon (Tiffy in RAF slang), was a British single-seat fighter-bomber, produced by Hawker Aircraft. It was designed to be a medium-high altitude interceptor, as a direct replacement for the Hawker Hurricane, but several design problems were encountered, and it never completely satisfied this requirement.\r\nIts service introduction in mid-1941 was plagued with problems, and for several months the aircraft faced a doubtful future.[3] However, when the Luftwaffe brought the formidable Focke-Wulf Fw 190 into service in 1941 the Typhoon was the only RAF fighter capable of catching it at low altitudes; as a result it secured a new role as a low-altitude interceptor.\r\nThrough the support of pilots such as Roland Beamont it also established itself in roles such as night-time intruder and a long-range fighter.\r\nFrom late 1942 the Typhoon was equipped with bombs, and from late 1943 RP-3 ground attack rockets were added to its armoury. Using these two weapons, the Typhoon became one of the Second World War''s most successful ground-attack aircraft.', 'General characteristics\r\nCrew: One\r\nLength: 31 ft 11.5 in[nb 18] (9.73 m)\r\nWingspan: 41 ft 7 in (12.67 m)\r\nHeight: 15 ft 4 in [nb 19] (4.66 m)\r\nWing area: 279 ft² (29.6 m²)\r\nEmpty weight: 8,840 lb (4,010 kg)\r\nLoaded weight: 11,400 lb (5,170 kg)\r\nMax. takeoff weight: 13,250 lb [nb 20] (6,010 kg)\r\nPowerplant: 3 or 4-blade de Havilland or Rotol propeller × Napier Sabre IIA, IIB or IIC liquid-cooled H-24 piston engine, 2,180, 2,200 or 2,260 hp (1,626, 1,640 or 1,685 kW) each\r\nPerformance\r\nMaximum speed: 412 mph with Sabre IIB & 4-bladed propeller[nb 21] (663 km/h) at 19,000 ft (5,485 m)\r\nStall speed: 88 mph (142 km/h) IAS with flaps up\r\nRange: 510 mi [nb 22] (821 km)\r\nService ceiling: 35,200 ft (10,729 m)\r\nRate of climb: 2,740 ft/min [nb 23] (13.59 m/s)\r\nWing loading: 45.8 lb/ft² (223.5 kg/m²)\r\nPower/mass: 0.20 hp/lb (0.33 kW/kg)\r\nArmament\r\nGuns: 4 × 20 mm Hispano Mk II cannon\r\nRockets: 8 × RP-3 unguided air-to-ground rockets.\r\nBombs: 2 × 500 lb (227 kg) or 2 × 1,000 lb (454 kg) bombs");
        $plane4->setTth(json_encode(array('speed'=>'680 km/h')));
        $plane4->setEngineId($this->getReference('engine3'));
        $plane4->addWeapon($this->getReference('weapons4'));
        $plane4->addWeapon($this->getReference('weapons5'));

        $manager->persist($plane4);

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