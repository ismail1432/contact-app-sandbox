<?php

namespace AuthenticatorSandboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AuthenticatorController extends Controller
{
    /**
     * @Route("/authenticator", name="authenticator")
     * @Template("authenticator/index.html.twig")
     */
    public function indexAction()
    {

        return ['test'=>'test'];
    }

    /**
     * @Route("/admin", name="admin")
     * @Template("authenticator/admin.html.twig")
     */
    public function adminAction()
    {

        return $this->redirectToRoute('admin/github');

    }

    /**
     * @Route("/admin/github", name="admin")
     * @Template("adminGithub/admin.html.twig")
     */
    public function adminGithubAction()
    {

        //return $this->redirectToRoute('admin/github');
    }

    /**
     * @Route("/github", name="github")
     * @Template("authenticator/index.html.twig")
     */
    public function githubConnectAction()
    {
        $client = $this->container->getParameter('client_id');
        return $this->redirect('https://github.com/login/oauth/authorize?client_id='.$client);
    }
}
