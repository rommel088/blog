<?php

namespace Acme\Work6Bundle\Services;


class ViewPlanes {

    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getAllPlanes()
    {
        $plane = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Plane')
            ->findAll();

        foreach ($plane as $planeKey => $planeVal) {
            $planes[$planeKey]['id'] = $planeVal->getId();
            $planes[$planeKey]['name'] = $planeVal->getName();
            $planes[$planeKey]['img'] = $planeVal->getImg();
            $planes[$planeKey]['description'] = $planeVal->getDescription();
        }
        return $planes;
    }

    public function getAllEngines()
    {
        $engine = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Engine')
            ->findAll();

        foreach ($engine as $engineKey => $engineVal) {
            $engines[$engineKey]['id'] = $engineVal->getId();
            $engines[$engineKey]['name'] = $engineVal->getName();
            $engines[$engineKey]['img'] = $engineVal->getImg();
            $engines[$engineKey]['description'] = $engineVal->getDescription();
        }
        return $engines;
    }

    public function getAllWeapons()
    {
        $weapon = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Weapons')
            ->findAll();

        foreach ($weapon as $weaponKey => $weaponVal) {
            $weapons[$weaponKey]['id'] = $weaponVal->getId();
            $weapons[$weaponKey]['name'] = $weaponVal->getName();
            $weapons[$weaponKey]['img'] = $weaponVal->getImg();
            $weapons[$weaponKey]['description'] = $weaponVal->getDescription();
        }
        return $weapons;
    }

    public function getPlane($id)
    {
        $plane = $this->doctrine
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
        return $planes;
    }

    public function getEngine($id)
    {
        $engine = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Engine')
            ->find($id);
        $engines['id'] = $engine->getId();
        $engines['name'] = $engine->getName();
        $engines['img'] = $engine->getImg();
        $engines['description'] = $engine->getDescription();

        $plane = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Plane')
            ->findBy(array('engine_id' => $engines['id']));
        foreach($plane as $key => $value) {
            $planes[$key]['id'] = $value->getId();
            $planes[$key]['name'] = $value->getName();
            $planes[$key]['img'] = $value->getImg();
            $planes[$key]['description'] = $value->getDescription();
        }
        $engines['planes'] = $planes;
        return $engines;
    }

    public function getWeapon($id)
    {
        $weapon = $this->doctrine
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
        return $weapons;
    }


} 