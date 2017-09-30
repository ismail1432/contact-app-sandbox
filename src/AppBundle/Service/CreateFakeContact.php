<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 29/09/2017
 * Time: 14:22
 */

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CreateFakeContact
{
    protected $manager;
    /**
     * CreateFakeContact constructor.
     * @param EntityManager $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createContact($contact)
    {
        if($contact === null){
            throw new \Exception('There is no contact');
        }
        $this->manager->persist($contact);
        $this->manager->flush();
    }
}