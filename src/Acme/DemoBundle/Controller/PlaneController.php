<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class PlaneController extends Controller
{
    public function homeAction()
    {

        return $this->render(
            'AcmeDemoBundle:Plane:home.html.twig',
            array()
        );
    }

    public function craftAction($name)
    {
        $info = $this->getCraftInfo($name);
        return $this->render(
            'AcmeDemoBundle:Plane:craft.html.twig',
            array('info' => $info)
        );
    }

    public function engineAction($name)
    {
        $info = $this->getEngineInfo($name);
        return $this->render(
            'AcmeDemoBundle:Plane:engine.html.twig',
            array('info' => $info)
        );
    }

    public function photoAction($name)
    {
        return $this->render(
            'AcmeDemoBundle:Plane:photo.html.twig',
            array('name' => $name)
        );
    }

    private function getCraftInfo($name)
    {
        $info = "";
        switch ($name) {
            case "109g10":
                $info['header'] = "Messerschmitt Bf.109G-10";
                $info['name'] = "109g10";
                $info['engine'] = "Daimler-Benz DB 605 DC";
                $info['description'] = "Без внешних подвесок и с двигателем DB 605DC Bf 109G-10 был самым скоростным
                                        вариантом серии G, развивая при весе 3100 кг у земли 550 км/ч и 680 км/ч на высоте
                                        7400 м. Высота в 6000 м набиралась за 5,8 мин.";
                break;
            case "p51h":
                $info['header'] = "North American P-51H Mustang";
                $info['name'] = "p51h";
                $info['engine'] = "Packard V-1650-9 Merlin";
                $info['description'] = "P-51H появился в результате работ над экспериментальными версиями XP-51F и
                                        G Mustang в начале 1944 года. Но вместо серийного производства XP-51F и G, USAAF
                                        сочли более целесообразным производить версию Mustang с двигателем
                                        Packard Merlin V-1659-9. Этот двигатель оснащался автоматическим регулятором
                                        постоянного давления наддува Simmons и был оборудован системой впрыска водно-метаноловой
                                        смеси, которая позволяла двигателю развивать кратковременную чрезвычайную боевую
                                        мощность до 2000 л.с. North American Aviation дала проекту внутреннее обозначение
                                        NA 126, а уже в июне 1944 года (к этому времени была выполнена лишь часть начальных
                                        работ над проектом) на P-51H был выдан заказ.";
                break;
            case "temp5":
                $info['header'] = "Hawker Tempest Mk.V";
                $info['name'] = "temp5";
                $info['engine'] = "Napier Sabre II";
                $info['description'] = "Вместо \"Темпеста\" I решили строить в серии \"Темпест V\". 21 июня 1943 г. на
                                        первой серийной \"пятерке\" взлетел испытатель Б. Хамбл. Серийные самолеты имели уже
                                        не \"автомобильные\" двери, о фонарь - \"пузырь\" с обычной сдвижной секцией. Первые
                                        100 истребителей, названные серией 1, имели пушки Испано Мк. II с боезапасом 200
                                        снарядовна ствол (у \"Тайфуна\" приходилось по 140 снарядов но одну пушку). Стволы
                                        пушек немного выступали из крыло. Позднее, на серии 2, смонтировали пушки Испано Mk.V,
                                        с более короткими стволами. Внесли и еще ряд мелких изменений. Еще позже вместо
                                        двигателя \"Сейбр\" ПА стали ставить ПВ или ПС.";
                break;
        }
        return $info;

    }

    private function getEngineInfo($name)
    {
        $info = "";
        switch ($name) {
            case "DB605DC":
                $info['header'] = "Daimler-Benz DB 605 DC";
                $info['name'] = "DB605DC";
                $info['crafts'] = ["Messerschmitt Bf.109G-10", "Messerschmitt Bf 110"];
                $info['description'] = "The primary differences between the 605 and 601 were greater displacement, higher
                                        revolutions, higher compression ratio and a more powerful supercharger. Through
                                        careful study the engineers determined that the cylinders could be bored out to a
                                        larger diameter without seriously affecting the strength of the existing block.
                                        The difference was minimal, increasing from the 601's 150 mm cylinder bore to the 605's
                                        154 mm, but this increased the overall displacement from 33.9 litres to 35.7. Altered
                                        valve timing increased the inlet period and improved the scavenging to give greater
                                        volumetric efficiency at higher speeds, which improved the maximum allowable RPM from
                                        2,600 in the 601 to 2,800 in the 605. The combination of these changes raised power
                                        output from 1,350 PS (1,332 hp) to 1,475 PS (1455 hp). The engine was otherwise similar,
                                        notably in size, which was identical to the 601. However, its weight did increase from
                                        700 to 756 kg.";
                break;
            case "V-1650-9":
                $info['header'] = "Packard V-1650-9 Merlin";
                $info['name'] = "V-1650-9";
                $info['crafts'] = ["North American P-51H Mustang"];
                $info['description'] = "The Packard V-1650 was a version of the Rolls-Royce Merlin aircraft engine, produced
                                        under licence in the United States by the Packard Motor Car Company.[1] The engine
                                        was licensed in order to provide a 1,500 hp (1,100 kW; 1,500 PS)-class design at a
                                        time when U.S. engines of this rating were not considered ready for use even after
                                        years of development.";
                break;
            case "sabre2":
                $info['header'] = "Napier Sabre II";
                $info['name'] = "sabre2";
                $info['crafts'] = ["Hawker Tempest Mk.V"];
                $info['description'] = "The Napier Sabre was a British H-24-cylinder, liquid cooled, sleeve valve, piston
                                        aero engine, designed by Major Frank Halford and built by Napier & Son during World
                                        War II. The engine evolved to become one of the most powerful inline piston aircraft
                                        engines in the world developing from 2,200 horsepower (1,640 kW) in its earlier
                                        versions to 3,500 hp (2,600 kW) in late-model prototypes.";
                break;
        }
        return $info;

    }
} 