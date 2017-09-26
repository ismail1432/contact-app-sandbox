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

class SayHello
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function sayHello(){

        return $this->em->getRepository(Contact::class)->findAll();
    }
}