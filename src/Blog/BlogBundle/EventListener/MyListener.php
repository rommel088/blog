<?php

namespace Blog\BlogBundle\EventListener;


class MyListener
{
    protected $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function onMove($event)
    {
        $id = $event->getRequest()->get('id');

        $em = $this->doctrine->getManager();
        $query = $em->createQuery(
            "UPDATE BlogBundle:Articles p
            SET p.viewed = p.viewed + 1
            WHERE p.id = :id"
        )->setParameter('id', $id);
        $query->getResult();
    }
} 