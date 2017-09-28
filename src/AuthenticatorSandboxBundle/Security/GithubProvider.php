<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 27/09/2017
 * Time: 00:32
 */

namespace AuthenticatorSandboxBundle\Security;


use AuthenticatorSandboxBundle\Entity\User;
use GuzzleHttp\Client;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class GithubProvider implements UserProviderInterface
{
    private $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function loadUserByUsername($username)
    {

        $response = $this->client->get(sprintf('https://api.github.com/user?access_token=%s', $username));
        $userData = $response->getBody()->getContents();
        $userTab = json_decode($userData, true);


        if (empty($userData)) {
            throw new \LogicException('Did not managed to get your user info from Github.');
        }

        $user = new User();
        $user->createUser($userTab['name']);

        return $user;

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}