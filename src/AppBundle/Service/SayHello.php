<?php

/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 30/08/2017
 * Time: 15:57
 */

namespace AppBundle\Service;

use AppBundle\Entity\Contact;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class SayHello
{
    private $em;
    private $test;

    public function __construct(EntityManagerInterface $entityManager,$test)
    {
        $this->em = $entityManager;
        dump($test); die;

    }

    public function sayHello(){

        return $this->em->getRepository(Contact::class)->findAll();
    }
}