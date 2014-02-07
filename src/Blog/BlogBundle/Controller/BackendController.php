<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blog\BlogBundle\Forms;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Blog\BlogBundle\Entity;
use Symfony\Component\Security\Core\SecurityContext;

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

    public function loginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return $this->render('BlogBundle:Backend:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ));
//        return $this->renderLogin(array(
//            'last_username' => $lastUsername,
//            'error'         => $error,
//            'csrf_token' => $csrfToken,
//        ));
    }
} 