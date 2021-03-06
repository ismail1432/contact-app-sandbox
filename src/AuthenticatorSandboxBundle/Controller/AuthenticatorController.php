<?php

namespace AuthenticatorSandboxBundle\Controller;

use AuthenticatorSandboxBundle\Security\GithubAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\User\UserInterface;

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
        //https://github.com/login/oauth/authorize?client_id=dbfe8cf8abcd145d8d2d
        //die(var_dump($user));
        return $this->redirectToRoute('admin-github');

    }

    /**
     * @Route("/admin/github", name="admin-github")
     */
    public function adminGithubAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('authenticator/admin-github.html.twig',
            ['user'=> $user]);
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
