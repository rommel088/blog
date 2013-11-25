<?php

namespace Acme\Work6Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function indexAction()
    {
        $viewPlanes = $this->container->get('ViewPlanes');

        $planes = $viewPlanes->getAllPlanes();
        $engines = $viewPlanes->getAllEngines();
        $weapons = $viewPlanes->getAllWeapons();

        $merged = array_merge($engines, $weapons);
        $keys = array_rand($merged, 3);
        $features[] = $merged[$keys[0]];
        $features[] = $merged[$keys[1]];
        $features[] = $merged[$keys[2]];

        return $this->render('AcmeWork6Bundle:Planes:home.html.twig', array('planes' => $planes,
                                                                            'features' => $features));
    }

    public function planesAction()
    {
        $viewPlanes = $this->container->get('ViewPlanes');
        $planes = $viewPlanes->getAllPlanes();

        return $this->render('AcmeWork6Bundle:Planes:category.html.twig', array('content' => $planes,
                                                                                'source' => 'plane'));
    }

    public function enginesAction()
    {
        $viewPlanes = $this->container->get('ViewPlanes');
        $engines = $viewPlanes->getAllEngines();

        return $this->render('AcmeWork6Bundle:Planes:category.html.twig', array('content' => $engines,
            'source' => 'engine'));
    }

    public function weaponsAction()
    {
        $viewPlanes = $this->container->get('ViewPlanes');
        $weapons = $viewPlanes->getAllWeapons();

        return $this->render('AcmeWork6Bundle:Planes:category.html.twig', array('content' => $weapons,
            'source' => 'weapon'));
    }

    public function planeAction($id)
    {
        $viewPlanes = $this->container->get('ViewPlanes');
        $planes = $viewPlanes->getPlane($id);
        return $this->render('AcmeWork6Bundle:Planes:craft.html.twig', array('plane' => $planes));
    }

    public function engineAction($id)
    {
        $viewPlanes = $this->container->get('ViewPlanes');
        $engines = $viewPlanes->getEngine($id);

        return $this->render('AcmeWork6Bundle:Planes:engine.html.twig', array('engine' => $engines, 'planes' => $engines['planes']));
    }

    public function weaponAction($id)
    {
        $viewPlanes = $this->container->get('ViewPlanes');
        $weapons = $viewPlanes->getWeapon($id);
        return $this->render('AcmeWork6Bundle:Planes:weapons.html.twig', array('weapons' => $weapons));
    }

    public function contactAction()
    {

        return $this->render('AcmeWork6Bundle:Planes:contact.html.twig');
    }

    public function mailAction()
    {
        $request = Request::createFromGlobals();
        $post = $request->request->all();

        $params['name'] = $post['name'];
        $params['mail'] = 'rommel088@yandex.ru';
        $params['receiver'] = $post['mail'];
        $params['text'] = $post['text'];


        $myMailer = $this->container->get('MyMailer');
        $myMailer->setParameters($params);
        $myMailer->sendMail();

        return new Response("ok");
    }
}
