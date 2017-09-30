<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 26/09/2017
 * Time: 23:27
 */

namespace AuthenticatorSandboxBundle\Security;


use AuthenticatorSandboxBundle\Entity\User;
use GuzzleHttp\Client;
use M6Web\Bundle\GuzzleHttpBundle\M6WebGuzzleHttpBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\SimpleAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;


class GithubAuthenticator implements SimplePreAuthenticatorInterface
{

    private $client_id;
    private $client;
    private $client_secret;
    private $router;

    public function __construct(Client $client, $client_id, $client_secret, RouterInterface $router)
    {

        $this->client_id = $client_id;
        $this->client = $client;
        $this->client_secret = $client_secret;
        $this->router = $router;

    }

    public function createToken(Request $request, $providerKey)
    {
        // look for an apikey query parameter
        $code = $request->query->get('code');
        $redirectUri = $this->router->generate('admin', [], ROUTER::ABSOLUTE_URL);
        $datas =sprintf('https://github.com/login/oauth/access_token?client_id=%s&client_secret=%s&code=%s&redirect_uri=%s',
            $this->client_id,
            $this->client_secret,
            $code,
            urlencode($redirectUri)
        );

        $response = $this->client->post($datas);
        $body = $response->getBody()->getContents();
        $tab =  explode("=",$body);
        $token = explode("&",$tab[1]);
        $token = $token[0];
        if (!isset($token)) {
            throw new BadCredentialsException('No access_token returned by Github. Start over the process.');
        }

        return new PreAuthenticatedToken(
            'anon.',
            $token,
            $providerKey
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiKey = $token->getCredentials();
        $user = $userProvider->loadUserByUsername($apiKey);


        if (!$user) {
            // CAUTION: this message will be returned to the client
            // (so don't put any un-trusted messages / error strings here)
            throw new CustomUserMessageAuthenticationException(
                sprintf('API Key "%s" does not exist.', $apiKey)
            );
        }

        $user = $token->getUser();
        if ($user instanceof User) {
            return new PreAuthenticatedToken(
                $user,
                $apiKey,
                $providerKey,
                $user->getRoles()
            );
        }

        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            $user->getRoles()
        );
    }
}