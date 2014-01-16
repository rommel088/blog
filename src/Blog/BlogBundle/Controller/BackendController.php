<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blog\BlogBundle\Forms;
use Pagerfanta\Pagerfanta;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Blog\BlogBundle\Entity;

class BackendController extends Controller
{
    public function addArticleAction(Request $request)
    {
        $article = new Forms\Article();
        $form = $this->createFormBuilder($article)
            ->add('title', 'text')
            ->add('image', 'text')
            ->add('body', 'textarea')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {

            $guest = new Entity\Articles();
            $guest->setTitle($form->getData()->getTitle());
            $guest->setImage($form->getData()->getImage());
            $guest->setBody($form->getData()->getBody());
            $guest->setViewed(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));

        }
        return $this->render('BlogBundle:Backend:addArticle.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function delPostAction(Request $request)
    {
        $message = $this->getDoctrine()
            ->getRepository('BlogBundle:GuestPosts')
            ->find($request->get("idMessage"));
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($message);
        $em->flush();

        return new Response(1);
    }
} 