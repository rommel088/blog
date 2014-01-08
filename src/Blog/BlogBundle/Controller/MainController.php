<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Blog\BlogBundle\Forms;
use Pagerfanta\Pagerfanta;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Blog\BlogBundle\Entity;
use Blog\BlogBundle\Entity\TagCloud;
use Doctrine\ORM\Query\ResultSetMapping;

class MainController extends Controller
{
    public function indexAction(Request $request)
    {
        $page = $request->get('page');
        if( !$page ) {
            $page = 1;
        }

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                SELECT content
                FROM BlogBundle:Articles content
                ORDER BY content.created DESC');
        $adapter = new DoctrineORMAdapter($query);

        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage($this->container->getParameter('articles_per_page'));
        $pagerfanta->setCurrentPage($page);
        $articles = $pagerfanta->getCurrentPageResults();

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
                                                                 'sidebar' => $this->sidebarDataAction()->getContent(),
                                                                 'pagerfanta' => $pagerfanta));
    }

    public function moreArticleAction(Request $request)
    {
        $offset = $this->container->getParameter('articles_per_page') * $request->get('page') * $request->get('count');

        $em = $this->getDoctrine()->getManager();
        $query =$em->createQuery('
                SELECT content
                FROM BlogBundle:Articles content
                ORDER BY content.created DESC'
        )->setFirstResult($offset)->setMaxResults($this->container->getParameter('articles_per_page'));
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

        return $this->render('BlogBundle::moreArticles.html.twig', array('articles' => $result));
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

        $dispatcher = new EventDispatcher();
        $listener = new Request();
        $dispatcher->addListener('kernel.controller', array($listener, 'onFooAction'));

        return $this->render('BlogBundle::article.html.twig', array('article' => $result,
                                                                    'sidebar' => $this->sidebarDataAction()->getContent()));
    }

    public function sidebarDataAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM BlogBundle:Articles p
            ORDER BY p.created DESC'
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
            ORDER BY p.viewed DESC'
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
            ORDER BY p.created DESC'
        )->setMaxResults($this->container->getParameter('items_in_sidebar'));
        $articles = $query->getResult();
        $posts = "";
        foreach($articles as $key=>$value){
            $posts[$key]['id'] = $value->getId();
            $posts[$key]['title'] = $value->getMessage();
        }

        $query = $em->createQuery(
            'SELECT t.id,
                    t.tag,
                    COUNT(a.id) cnt
            FROM BlogBundle:Articles a
            JOIN a.tags t
            GROUP BY t.id
            ORDER BY cnt DESC')->setMaxResults(15);
        $tags = $query->getResult();
        $cloud = new TagCloud();
        foreach($tags as $key=>$value){
            $cloud->addTag(array('tag' => $value['tag'], 'size' => $value['cnt']));
        }

        return $this->render('BlogBundle::sidebar.html.twig', array('byCreation' => $byCreation,
                                                                    'byViewed' => $byViewed,
                                                                    'posts' => $posts,
                                                                    'cloud' => $cloud->render()));
    }

    public function mailAction()
    {
//        $request = Request::createFromGlobals();
//        $post = $request->request->all();
//
//        $params['name'] = $post['name'];
//        $params['mail'] = 'rommel088@yandex.ru';
//        $params['receiver'] = $post['mail'];
//        $params['text'] = $post['text'];
//
//
//        $myMailer = $this->container->get('MyMailer');
//        $myMailer->setParameters($params);
//        $myMailer->sendMail();
//
//        return new Response("ok");
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

            $guest = new Entity\GuestPosts();
            $guest->setName($form->getData()->getName());
            $guest->setEmail($form->getData()->getEmail());
            $guest->setMessage($form->getData()->getMessage());

            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirect($this->generateUrl('guestbook'));

        }

        $page = $request->get('page');
        if( !$page ) {
            $page = 1;
        }
//        try {
//            $pagerfanta->setCurrentPage($page);
//        } catch (NotValidCurrentPageException $e) {
//            throw new NotFoundHttpException();
//        }

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                SELECT content
                FROM BlogBundle:GuestPosts content
                ORDER BY content.created DESC');
        $adapter = new DoctrineORMAdapter($query);

        $pagerfanta = new Pagerfanta($adapter);

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
