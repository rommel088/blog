<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\Work6Bundle\Forms;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM BlogBundle:Articles p
            ORDER BY p.created ASC'
        )->setMaxResults($this->container->getParameter('articles_per_page'));

        $articles = $query->getResult();
        $result = "";
        foreach($articles as $key=>$value){
            $result[$key]['id'] = $value->getId();
            $result[$key]['title'] = $value->getTitle();
            $result[$key]['image'] = $value->getImage();
            $result[$key]['body'] = $value->getBody();
            $result[$key]['viewed'] = $value->getViewed();
            $result[$key]['created'] = $value->getCreated()->format('Y-m-d H:i:s');
            $result[$key]['updated'] = $value->getCreated()->format('Y-m-d H:i:s');
        }

        return $this->render('BlogBundle::home.html.twig', array('articles' => $result,
                                                                 'sidebar' => $this->sidebarDataAction()->getContent()));
    }

    public function articleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT p
            FROM BlogBundle:Articles p
            WHERE p.id = ".$id."
            ORDER BY p.created ASC"
        )->setMaxResults(1);
        $articles = $query->getResult();

        $result = "";
        foreach($articles as $key=>$value){
            $result[$key]['id'] = $value->getId();
            $result[$key]['title'] = $value->getTitle();
            $result[$key]['image'] = $value->getImage();
            $result[$key]['body'] = $value->getBody();
            $result[$key]['viewed'] = $value->getViewed();
            $result[$key]['created'] = $value->getCreated()->format('Y-m-d H:i:s');
            $result[$key]['updated'] = $value->getCreated()->format('Y-m-d H:i:s');
        }
        return $this->render('BlogBundle::article.html.twig', array('article' => $result,
                                                                    'sidebar' => $this->sidebarDataAction()->getContent()));
    }

    public function sidebarDataAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM BlogBundle:Articles p
            ORDER BY p.created ASC'
        )->setMaxResults($this->container->getParameter('items_in_sidebar'));
        $articles = $query->getResult();
        $byCreation = "";
        foreach($articles as $key=>$value){
            $byCreation[$key]['id'] = $value->getId();
            $byCreation[$key]['title'] = $value->getTitle();
        }

        $query = $em->createQuery(
            'SELECT p
            FROM BlogBundle:Articles p
            ORDER BY p.viewed ASC'
        )->setMaxResults($this->container->getParameter('items_in_sidebar'));
        $articles = $query->getResult();
        $byViewed = "";
        foreach($articles as $key=>$value){
            $byViewed[$key]['id'] = $value->getId();
            $byViewed[$key]['title'] = $value->getTitle();
        }

        $query = $em->createQuery(
            'SELECT p
            FROM BlogBundle:GuestPosts p
            ORDER BY p.created ASC'
        )->setMaxResults($this->container->getParameter('items_in_sidebar'));
        $articles = $query->getResult();
        $posts = "";
        foreach($articles as $key=>$value){
            $posts[$key]['id'] = $value->getId();
            $posts[$key]['title'] = $value->getMessage();
        }
        return $this->render('BlogBundle::sidebar.html.twig', array('byCreation' => $byCreation,
                                                                    'byViewed' => $byViewed,
                                                                    'posts' => $posts));
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

    public function guestAction(Request $request)
    {

        $guest = new Forms\Guest();
        $form = $this->createFormBuilder($guest)
            ->add('name', 'text')
            ->add('email', 'text')
            ->add('message', 'textarea')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {

//            $viewPlanes->addMessage($form->getData());
            return $this->redirect($this->generateUrl('guest'));

        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM BlogBundle:GuestPosts p
            ORDER BY p.created ASC'
        )->setMaxResults($this->container->getParameter('posts_per_page'));

        $message = $query->getResult();

        foreach ($message as $key => $val) {
            $messages[$key]['id'] = $val->getId();
            $messages[$key]['name'] = $val->getName();
            $messages[$key]['email'] = $val->getEmail();
            $messages[$key]['message'] = $val->getMessage();
            $messages[$key]['created'] = $val->getCreated()->format('Y-m-d H:i:s');
        }

        $page = $request->get('page');

        $adapter = new ArrayAdapter($messages);
        $pagerfanta = new Pagerfanta($adapter);

        if( !$page ) {
            $page = 1;
        }
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        $pagerfanta->setMaxPerPage($this->container->getParameter('posts_per_page'));
        $pagerfanta->setCurrentPage($page);
        $messages = $pagerfanta->getCurrentPageResults();



        return $this->render('BlogBundle::guest.html.twig', array(
            'form' => $form->createView(),
            'messages' => $messages,
            'pagerfanta' => $pagerfanta,
        ));
    }
}
