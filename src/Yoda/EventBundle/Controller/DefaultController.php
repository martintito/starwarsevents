<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($count, $firstName)
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
        //usar el metodo 'render' de la clase Controller... un atajo del anterior bloque de codigo
        /*return $this->render(
                'YodaEventBundle:Default:index.html.twig',
                array('name' => $firstname)
                );*/

        // these 2 lines are equivalent
        // $em = $this->container->get('doctrine')->getManager();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EventBundle:Event');

        $event = $repo->findOneBy(array(
            'name' => 'Darth\'s surprise birthday party',
        ));

        return $this->render(
            'EventBundle:Default:index.html.twig',
            array(
                'name' => $firstName,
                'count' => $count,
                'event'=> $event,
            )
        );
    }
}