<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 27/09/2017
 * Time: 00:25
 */

namespace AuthenticatorSandboxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class User implements UserInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=150)
     */
    protected $username;
    private $password;
    private $salt;
    private $roles;
    private $mail;
    private $name;

   public function createUser($name){
       $this->name = $name;
   }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getName()
    {
        return $this->name;
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