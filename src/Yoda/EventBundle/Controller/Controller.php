<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Yoda\EventBundle\Entity\Event;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Controller extends BaseController
{
    public function getSecurityContext()
    {
        return $this->container->get('security.context');
    }
    
    public function enforceOwnerSecurity(Event $event)
    {
        $user = $this->getUser();
        //var_dump($event);exit;

        if ($user != $event->getOwner()) {
            // if you're using 2.5 or higher
            // throw $this->createAccessDeniedException('You are not the owner!!!');
            throw new AccessDeniedException('You are not the owner!!!');
            //$this->createAccessDeniedException('You are not the owner!!!');
        }
    }
}