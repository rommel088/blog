<?php

namespace Acme\Work6Bundle\Controller;

use Acme\Work6Bundle\Entity\Plane;
use Acme\Work6Bundle\Entity\Engine;
use Acme\Work6Bundle\Entity\Weapons;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $plane = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Plane')
            ->findAll();

        foreach ($plane as $planeKey => $planeVal) {
            $planes[$planeKey]['id'] = $planeVal->getId();
            $planes[$planeKey]['name'] = $planeVal->getName();
            $planes[$planeKey]['img'] = $planeVal->getImg();
            $planes[$planeKey]['description'] = $planeVal->getDescription();
        }

        $engine = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Engine')
            ->findAll();

        foreach ($engine as $engineKey => $engineVal) {
            $engines[$engineKey]['id'] = $engineVal->getId();
            $engines[$engineKey]['name'] = $engineVal->getName();
            $engines[$engineKey]['img'] = $engineVal->getImg();
            $engines[$engineKey]['description'] = $engineVal->getDescription();
        }

        $weapon = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Weapons')
            ->findAll();

        foreach ($weapon as $weaponKey => $weaponVal) {
            $weapons[$weaponKey]['id'] = $weaponVal->getId();
            $weapons[$weaponKey]['name'] = $weaponVal->getName();
            $weapons[$weaponKey]['img'] = $weaponVal->getImg();
            $weapons[$weaponKey]['description'] = $weaponVal->getDescription();
        }
        $merged = array_merge($engines, $weapons);
        $keys = array_rand($merged, 3);
        $features[] = $merged[$keys[0]];
        $features[] = $merged[$keys[1]];
        $features[] = $merged[$keys[2]];
//var_dump($features);


        return $this->render('AcmeWork6Bundle:Planes:home.html.twig', array('planes' => $planes,
                                                                            'features' => $features));
    }

    public function planesAction()
    {
        $plane = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Plane')
            ->findAll();

        foreach ($plane as $planeKey => $planeVal) {
            $planes[$planeKey]['id'] = $planeVal->getId();
            $planes[$planeKey]['name'] = $planeVal->getName();
            $planes[$planeKey]['img'] = $planeVal->getImg();
            $planes[$planeKey]['description'] = $planeVal->getDescription();
        }

        return $this->render('AcmeWork6Bundle:Planes:category.html.twig', array('content' => $planes,
                                                                                'source' => 'plane'));
    }

    public function enginesAction()
    {
        $engine = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Engine')
            ->findAll();

        foreach ($engine as $engineKey => $engineVal) {
            $engines[$engineKey]['id'] = $engineVal->getId();
            $engines[$engineKey]['name'] = $engineVal->getName();
            $engines[$engineKey]['img'] = $engineVal->getImg();
            $engines[$engineKey]['description'] = $engineVal->getDescription();
        }

        return $this->render('AcmeWork6Bundle:Planes:category.html.twig', array('content' => $engines,
            'source' => 'engine'));
    }

    public function weaponsAction()
    {
        $weapon = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Weapons')
            ->findAll();

        foreach ($weapon as $weaponKey => $weaponVal) {
            $weapons[$weaponKey]['id'] = $weaponVal->getId();
            $weapons[$weaponKey]['name'] = $weaponVal->getName();
            $weapons[$weaponKey]['img'] = $weaponVal->getImg();
            $weapons[$weaponKey]['description'] = $weaponVal->getDescription();
        }

        return $this->render('AcmeWork6Bundle:Planes:category.html.twig', array('content' => $weapons,
            'source' => 'weapon'));
    }

    public function planeAction($id)
    {
        $plane = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Plane')
            ->find($id);

        $planes['id'] = $plane->getId();
        $planes['name'] = $plane->getName();
        $planes['img'] = $plane->getImg();
        $planes['description'] = $plane->getDescription();
        $planes['engine']['id'] = $plane->getEngineId()->getId();
        $planes['engine']['name'] = $plane->getEngineId()->getName();
        $planes['engine']['img'] = $plane->getEngineId()->getImg();
        $planes['engine']['description'] = $plane->getEngineId()->getDescription();
        $weapons = $plane->getWeapons()->getValues();
        foreach($weapons as $key => $value) {
            $planes['weapons'][$key]['id'] = $value->getId();
            $planes['weapons'][$key]['name'] = $value->getName();
            $planes['weapons'][$key]['img'] = $value->getImg();
            $planes['weapons'][$key]['description'] = $value->getDescription();

        }

        return $this->render('AcmeWork6Bundle:Planes:craft.html.twig', array('plane' => $planes));
    }

    public function engineAction($id)
    {
        $engine = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Engine')
            ->find($id);
        $engines['id'] = $engine->getId();
        $engines['name'] = $engine->getName();
        $engines['img'] = $engine->getImg();
        $engines['description'] = $engine->getDescription();

        $plane = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Plane')
            ->findBy(array('engine_id' => $engines['id']));
        foreach($plane as $key => $value) {
            $planes[$key]['id'] = $value->getId();
            $planes[$key]['name'] = $value->getName();
            $planes[$key]['img'] = $value->getImg();
            $planes[$key]['description'] = $value->getDescription();
        }


        return $this->render('AcmeWork6Bundle:Planes:engine.html.twig', array('engine' => $engine, 'planes' => $planes));
    }

    public function weaponAction($id)
    {
        $weapon = $this->getDoctrine()
            ->getRepository('AcmeWork6Bundle:Weapons')
            ->find($id);

        $weapons['id'] = $weapon->getId();
        $weapons['name'] = $weapon->getName();
        $weapons['img'] = $weapon->getImg();
        $weapons['description'] = $weapon->getDescription();

        $planes = $weapon->getPlane()->getValues();
        foreach($planes as $key => $value) {
            $weapons['planes'][$key]['id'] = $value->getId();
            $weapons['planes'][$key]['name'] = $value->getName();
            $weapons['planes'][$key]['img'] = $value->getImg();
            $weapons['planes'][$key]['description'] = $value->getDescription();

        }

        return $this->render('AcmeWork6Bundle:Planes:weapons.html.twig', array('weapons' => $weapons));
    }
}
