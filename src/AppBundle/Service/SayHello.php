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

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function sayHello(){

        return $this->em->getRepository(Contact::class)->findAll();
    }
}