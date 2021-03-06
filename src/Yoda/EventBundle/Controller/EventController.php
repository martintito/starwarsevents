<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Yoda\EventBundle\Entity\Event;
use Yoda\EventBundle\Form\EventType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     * @Template()
     * @Route("/", name="event")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        //$entities = $em->getRepository('YodaEventBundle:Event')->findAll();

        return array(
            'entities' => $user->getEvents(),
        );
    }
    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request)
    {
        $this->enforceUserSecurity('ROLE_EVENT_CREATE');
        
//        $securityContext = $this->get('security.context');
//        if(!$securityContext->isGranted('ROLE_ADMIN')){
//            throw $this->createAccessDeniedException('Need ROLE_ADMIN');
//        }
        
        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $this->getUser();
            $entity->setOwner($user);
            //var_dump($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('event_show', array('id' => $entity->getId())));
        }

        return $this->render('YodaEventBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Event entity.
    *
    * @param Event $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Event $entity)
    {
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('event_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $this->enforceUserSecurity('ROLE_EVENT_CREATE');
        
        

        $entity = new Event();
        $form   = $this->createCreateForm($entity);

        return $this->render('YodaEventBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YodaEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('YodaEventBundle:Event:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($id)
    {
        $this->enforceUserSecurity();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YodaEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }
        $this->enforceOwnerSecurity($entity);

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('YodaEventBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Event entity.
    *
    * @param Event $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Event $entity)
    {
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $this->enforceUserSecurity();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('YodaEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }
        $this->enforceOwnerSecurity($entity);

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('event_edit', array('id' => $id)));
        }

        return $this->render('YodaEventBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->enforceUserSecurity();
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('YodaEventBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }
            $this->enforceOwnerSecurity($entity);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('event'));
    }

    /**
     * Creates a form to delete a Event entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    private function enforceUserSecurity($role = 'ROLE_USER')
    {
        //$securityContext = $this->container->get('security.context');
        //if (!$securityContext->isGranted($role)) {
        if (!$this->getSecurityContext()->isGranted($role)) {
            // in Symfony 2.5
            // throw $this->createAccessDeniedException('message!');
            throw new AccessDeniedException('Need '.$role);
        }
    }
    
//    private function enforceOwnerSecurity($event)
//    {
//        $user = $this->getUser();
//        var_dump($event);exit;
//
//        if ($user != $event->getOwner()) {
//            // if you're using 2.5 or higher
//            // throw $this->createAccessDeniedException('You are not the owner!!!');
//            throw new AccessDeniedException('You are not the owner!!!');
//            //$this->createAccessDeniedException('You are not the owner!!!');
//        }
//    }
}
