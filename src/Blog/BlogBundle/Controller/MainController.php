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
        $searchType = $request->get('type');
        $searchQuery = $request->get('query');
        $searchParams = $this->getSearchWhere($searchType, $searchQuery);

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                    SELECT COUNT(content.id)
                    FROM BlogBundle:Articles content '
            .$searchParams['where'].
            ' ORDER BY content.created DESC');
        $query->setParameters($searchParams['params']);
        $count = $query->getSingleScalarResult();
        $hasMore = false;
        if ($count > ($this->container->getParameter('articles_per_page') * $page)) $hasMore = true;

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                SELECT content
                FROM BlogBundle:Articles content '
                .$searchParams['where'].
                ' ORDER BY content.created DESC');
        $query->setParameters($searchParams['params']);
        $adapter = new DoctrineORMAdapter($query);

        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage($this->container->getParameter('articles_per_page'));
        $pagerfanta->setCurrentPage($page);
        $articles = $pagerfanta->getCurrentPageResults();

        $result = "";
        if ($searchQuery) {
            $search = $searchQuery;
            $pattern = "/".$search."/is";
            $replace = '<b style="color:#FF0000; background:#FFFF00;">'.$search.'</b>';
        }

        foreach($articles as $key=>$value){

            $result[$key]['id'] = $value->getId();
            $result[$key]['title'] = $value->getTitle();
            $result[$key]['image'] = $value->getImage();
            if ($searchQuery) {
                $result[$key]['body'] = preg_replace($pattern, $replace, $value->getBody());
            } else {
                $result[$key]['body'] = $value->getBody();
            }
            $result[$key]['viewed'] = $value->getViewed();
            $result[$key]['tags'] = $this->getArticleTags($value->getId());
            $result[$key]['created'] = $value->getCreated()->format('Y-m-d H:i:s');
            $result[$key]['updated'] = $value->getCreated()->format('Y-m-d H:i:s');
        }

        return $this->render('BlogBundle::home.html.twig', array('articles' => $result,
                                                                 'sidebar' => $this->sidebarDataAction()->getContent(),
                                                                 'pagerfanta' => $pagerfanta,
                                                                 'hasMore' => $hasMore));
    }

    public function moreArticleAction(Request $request)
    {
        $offset = $this->container->getParameter('articles_per_page') * $request->get('page') * $request->get('count');

        $searchType = $request->get('type');
        $searchQuery = $request->get('query');
        $searchParams = $this->getSearchWhere($searchType, $searchQuery);

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                    SELECT COUNT(content.id)
                    FROM BlogBundle:Articles content '
                .$searchParams['where'].
                ' ORDER BY content.created DESC');
        $query->setParameters($searchParams['params']);
        $count = $query->getSingleScalarResult();
        $hasMore = false;
        if ($count - $offset > $this->container->getParameter('articles_per_page')) $hasMore = true;

        $em = $this->getDoctrine()->getEntityManager();
        $query =$em->createQuery('
                SELECT content
                FROM BlogBundle:Articles content '
                .$searchParams['where'].
                ' ORDER BY content.created DESC'
        )->setFirstResult($offset)->setMaxResults($this->container->getParameter('articles_per_page'));
        $query->setParameters($searchParams['params']);

        $articles = $query->getResult();
        $result = "";
        foreach($articles as $key=>$value){
            $result[$key]['id'] = $value->getId();
            $result[$key]['title'] = $value->getTitle();
            $result[$key]['image'] = $value->getImage();
            $result[$key]['body'] = $value->getBody();
            $result[$key]['viewed'] = $value->getViewed();
            $result[$key]['tags'] = $this->getArticleTags($value->getId());
            $result[$key]['created'] = $value->getCreated()->format('Y-m-d H:i:s');
            $result[$key]['updated'] = $value->getCreated()->format('Y-m-d H:i:s');
        }

        return $this->render('BlogBundle::moreArticles.html.twig', array('articles' => $result,
                                                                         'hasMore' => $hasMore));
    }

    public function articleAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
            "SELECT p
            FROM BlogBundle:Articles p
            WHERE p.id = ".$id."
            ORDER BY p.created ASC"
        )->setMaxResults(1);
        $articles = $query->getSingleResult();

        $result = "";
        $result['id'] = $articles->getId();
        $result['title'] = $articles->getTitle();
        $result['image'] = $articles->getImage();
        $result['body'] = $articles->getBody();
        $result['viewed'] = $articles->getViewed();
        $result['tags'] = $this->getArticleTags($articles->getId());
        $result['created'] = $articles->getCreated()->format('Y-m-d H:i:s');
        $result['updated'] = $articles->getCreated()->format('Y-m-d H:i:s');

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
            $cloud->addTag(array('tag' => $value['tag'], 'url' => '/?type=tag&query='.$value['tag'], 'size' => $value['cnt']));
        }
        $cloud->setHtmlizeTagFunction( function($tag, $size) {
            $link = '<a href="'.$tag['url'].'">'.$tag['tag'].'</a>';
            return "<span class='tag size{$size}'>{$link}</span> ";
        });
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

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                    SELECT COUNT(content.id)
                    FROM BlogBundle:GuestPosts content
                    ORDER BY content.created DESC');
        $count = $query->getSingleScalarResult();
        $hasMore = false;
        if ($count > ($this->container->getParameter('posts_per_page') * $page)) $hasMore = true;

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
            'hasMore' => $hasMore
        ));
    }

    public function morePostsAction(Request $request)
    {
        $offset = $this->container->getParameter('posts_per_page') * $request->get('page') * $request->get('count');

        $em = $this->getDoctrine()->getManager();

        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery('
                    SELECT COUNT(content.id)
                    FROM BlogBundle:GuestPosts content
                    ORDER BY content.created DESC');
        $count = $query->getSingleScalarResult();
        $hasMore = false;
        if ($count - $offset > ($this->container->getParameter('posts_per_page'))) $hasMore = true;

        $query =$em->createQuery('
                SELECT content
                FROM BlogBundle:GuestPosts content
                ORDER BY content.created DESC'
        )->setFirstResult($offset)->setMaxResults($this->container->getParameter('posts_per_page'));
        $posts = $query->getResult();
        $result = "";
        foreach($posts as $key=>$value){
            $result[$key]['id'] = $value->getId();
            $result[$key]['name'] = $value->getName();
            $result[$key]['email'] = $value->getEmail();
            $result[$key]['message'] = $value->getMessage();
            $result[$key]['created'] = $value->getCreated()->format('Y-m-d H:i:s');
        }

        return $this->render('BlogBundle::morePosts.html.twig', array('posts' => $result,
                                                                      'hasMore' => $hasMore));
    }

    public function aboutMeAction()
    {
        return $this->render('BlogBundle::aboutMe.html.twig', array('sidebar' => $this->sidebarDataAction()->getContent()));
    }

    private function getSearchWhere($searchType, $searchQuery)
    {

        $where = '';
        $params = [];
        if ($searchType) {
            if ($searchType == 'tag') {
                $where = "JOIN content.tags t
                          WHERE t.tag = :tag";
                $params = array(
                    'tag' => $searchQuery
                );
            } elseif ($searchType == 'intext') {
                $where = "WHERE content.body LIKE :query";
                $params = array(
                    'query' => "%".$searchQuery."%"
                );
            }
        }

        $result['where'] = $where;
        $result['params'] = $params;
        return $result;
    }

    private function getArticleTags($articleId)
    {
        $query = $this->getDoctrine()->getEntityManager()
            ->createQuery(
           "SELECT t.id,
                   t.tag
                FROM BlogBundle:Articles content
                JOIN content.tags t
                WHERE content.id = :id
                ORDER BY content.created DESC"
        );

        $query->setParameters(array('id' => $articleId));
        $tags = $query->getResult();
        return $tags;
    }
}
