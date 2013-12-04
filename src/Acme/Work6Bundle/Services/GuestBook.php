<?php

namespace Acme\Work6Bundle\Services;

use Acme\Work6Bundle\Entity\Guest;

class GuestBook
{
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function addMessage($message)
    {
        $guest = new Guest();
        $guest->setName($message->getName());
        $guest->setEmail($message->getEmail());
        $guest->setMessage($message->getMessage());
        $guest->setTime(time());

        $em = $this->doctrine->getManager();
        $em->persist($guest);
        $em->flush();

        return 1;
    }

    public function getAllMessages()
    {
        $message = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Guest')
            ->findAll();

        foreach ($message as $key => $val) {
            $messages[$key]['id'] = $val->getId();
            $messages[$key]['name'] = $val->getName();
            $messages[$key]['email'] = $val->getEmail();
            $messages[$key]['message'] = $val->getMessage();
        }
        return $messages;
    }

    public function delMessages($id)
    {
        $message = $this->doctrine
            ->getRepository('AcmeWork6Bundle:Guest')
            ->find($id);
        $em = $this->doctrine->getEntityManager();
        $em->remove($message);
        $em->flush();
    }
} 