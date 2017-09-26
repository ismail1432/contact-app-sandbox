<?php

namespace AuthenticatorSandboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthenticatorController extends Controller
{
    /**
     * @Route("/authenticator-sandbox")
     */
    public function indexAction()
    {

        return $this->render('authenticator/index.html.twig');
    }
}
