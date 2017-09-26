<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 26/09/2017
 * Time: 11:15
 */

namespace AppBundle\Event;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class UserAgentSubscriber implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {

        $this->logger = $logger;
    }

    public function onKernelRequest(GetResponseEvent $event){
        $this->logger->info('Very important message !!');
        $request = $event->getRequest();
        $userAgent = $request->headers->get('User-Agent');
        $this->logger->info('The user agent is: '. $userAgent);

    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'onKernelRequest'
        ];
    }

}