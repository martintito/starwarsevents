<?php

namespace Yoda\EventBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    public function indexAction($name, $count) {
        //return $this->render('YodaEventBundle:Default:index.html.twig', array('lastname' => $name));
        //return new Response('It\'s a traaaaaaap!');
        /* $data = array(
          'count' => $count,
          'firstname' => $firstname,
          'ackbar' => 'It\'s a traaaaaaap!'
          );
          $json = json_encode($data);

          $response = new Response($json);
          $response->headers->set('Content-Type', 'application/json');

          return $response; */



        /* $templating = $this->container->get('templating');

          return $templating->renderResponse(
          'YodaEventBundle:Default:index.html.twig',
          array('name' => $firstname)
          ); */
        //usar el metodo 'render' de la clase Controller... un atajo del anterior bloque de codigo
        /* return $this->render(
          'YodaEventBundle:Default:index.html.twig',
          array('name' => $firstname)
          ); */

        // these 2 lines are equivalent
        // $em = $this->container->get('doctrine')->getManager();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('YodaEventBundle:Event');

        $event = $repo->findOneBy(array(
            'name' => 'Vader',
        ));

        //var_dump($event);
        //exit;

        return $this->render(
                        'YodaEventBundle:Default:index.html.twig', array(
                    'name' => $name,
                    'count' => $count,
                    'event' => $event,
                        )
        );
    }

    public function testAction() {

//        echo "come up here little bird!";
//        exit;

        return $this->render(
                        'YodaEventBundle:Default:test.html.twig'
        );
    }

    /**
     * Pruebas con EntityRepository.
     * 
     * @Template()
     * @Route("/prueba/{event_name}", name="prueba", requirements={"event_name" = "\w+"}, defaults={"event_name" = null})
     */
    public function pruebaAction($event_name) {
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository('YodaEventBundle:Event');
        //var_dump($eventRepo->findOneByName('master'));
        $objEvent = $eventRepo->findOneByName($event_name);
//        echo $objEvent->getName();
//        echo $objEvent->getLocation();
//        exit;

        return array(
            'event' => $objEvent,
        );
    }

    /**
     * Listar los eventos de un usuario
     * 
     * @Template()
     * @Route("/listareventos/{user}", name="listareventos", requirements={"user" = "\w+"}, defaults={"user" = null})
     */
    public function listareventosAction($user) {
        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository('YodaEventBundle:User');
        $objUser = $userRepo->findOneByUsernameOrEmail($user);

//        foreach ($objUser->getEvents() as $event) {
//            var_dump($event->getName());
//        }
        return array(
            'events' => $objUser->getEvents(),
        );
    }

}
