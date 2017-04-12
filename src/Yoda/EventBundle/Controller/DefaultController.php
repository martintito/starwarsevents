<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($lastname)
    {
        return $this->render('YodaEventBundle:Default:index.html.twig', array('lastname' => $lastname));
    }
}
