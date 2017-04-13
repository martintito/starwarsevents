<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($count, $firstname)
    {
        //return $this->render('YodaEventBundle:Default:index.html.twig', array('lastname' => $name));
        //return new Response('It\'s a traaaaaaap!');
        /*$data = array(
            'count' => $count,
            'firstname' => $firstname,
            'ackbar' => 'It\'s a traaaaaaap!'            
        );
        $json = json_encode($data);
        
        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;*/
        
        /*$templating = $this->container->get('templating');
        
        return $templating->renderResponse(
                'YodaEventBundle:Default:index.html.twig',
                array('name' => $firstname)
                );*/
        
        return $this->render(
                'YodaEventBundle:Default:index.html.twig',
                array('name' => $firstname)
                );
    }
}
