<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 27/09/2017
 * Time: 00:25
 */

namespace AuthenticatorSandboxBundle\Security;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $username;
    private $password;
    private $salt;
    private $roles;
    private $mail;

    public function __construct($username, $password, $salt, array $roles, $mail)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
        $this->mail = $mail;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }
}