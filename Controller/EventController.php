<?php

namespace AltCloud\Instance3EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AltCloud\Instance3EventBundle\Entity\Event;
use AltCloud\Instance3EventBundle\Form\EventType;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    public function listAction($node=false,$agenda=false,$_format=false, $displayoptions=false)
    {
        $em = $this->getDoctrine()->getEntityManager();

		if(is_string($agenda)){
        	$events = $em->getRepository('ACInst3EventBundle:Event')->findBy( array( 'agenda' => $agenda ) );
        }else{
		  	$events = $em->getRepository('ACInst3EventBundle:Event')->findAll();
		}
		
		if (is_object($node)){
			$nodetpl = $node->getSite()->getDeftemp();
			if(is_string($nodetpl))
				$tpl=$nodetpl;
		}
		
		if(!isset($tpl)){
			// Determine tpl based on request uri, if possible
		}
		
		if(!isset($tpl)){
			// Use default tpl
			// FIXME: Move to setting somewhere
			$tpl="JMORGSTJMBundle::layout.html.twig";
		}
		
//		if($_format && $_format == 'rss' ){
//			$response = $this->render("ACInst3EventBundle:Event:list.rss.twig", array('events' => $events));
//			$response->headers->set('Content-Type', 'application/rss+xml');
//		
//	        return $response;
//		}else
	        return $this->render("ACInst3EventBundle:Event:list.html.twig", array('events' => $events, 'tpl' => $tpl, 'node' => $node, 'displayoptions' => $displayoptions));

    }
    
    public function listPartialAction($agenda=false, $displayoptions=false)
    {
        $em = $this->getDoctrine()->getEntityManager();

		if(is_int($agenda)){
        	$events = $em->getRepository('ACInst3EventBundle:Event')->findBy( array( 'agenda' => $agenda ) );
        }else{
		  	$events = $em->getRepository('ACInst3EventBundle:Event')->findAll();
		}
		
        return $this->render('ACInst3EventBundle:Event:listPartial.html.twig', array('events' => $events, 'displayoptions' => $displayoptions));

    }
    
    /**
     *  Render an event partial.
     *
     */
	public function renderPartialAction($id, $displayoptions=false)
	{
			$event = $this->getDoctrine()
				->getRepository('ACInst3EventBundle:Event')
				->find($id);

			if (!$event) {
				throw $this->createNotFoundException('No Event found for id '.$id);
			}
		
        	return $this->render('ACInst3EventBundle:Event:renderPartial.html.twig', array(
    							 'event' => $event, 
    							 'displayoptions' => $displayoptions));
    	}
    /**
     *  Render an event.
     *
     */
	public function renderAction($id, $node=false, $displayoptions=false)
	{
			$event = $this->getDoctrine()
				->getRepository('ACInst3EventBundle:Event')
				->find($id);

			if (!$event) {
				throw $this->createNotFoundException('No Event found for id '.$id);
			}
	
			if (is_object($node)){
				$nodetpl = $node->getSite()->getDeftemp();
				if(is_string($nodetpl))
					$tpl=$nodetpl;
			}
			
			if(!isset($tpl)){
				// Determine tpl based on request uri, if possible
			}
			
			if(!isset($tpl)){
				// Use default tpl
				// FIXME: Move to setting somewhere
				$tpl="JMORGJMFBundle::layout.html.twig";
			}
		
        	return $this->render('ACInst3EventBundle:Event:render.html.twig', array(
    							 'event' => $event, 
    							 'tpl' => $tpl, 
    							 'node' => $node,
    							 'displayoptions' => $displayoptions));
    	}

    /**
     * Lists all Event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ACInst3EventBundle:Event')->findAll();

        return $this->render('ACInst3EventBundle:Event:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3EventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3EventBundle:Event:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createForm(new EventType(), $entity);

        return $this->render('ACInst3EventBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction()
    {
        $entity  = new Event();
        $request = $this->getRequest();
        $form    = $this->createForm(new EventType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_event_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ACInst3EventBundle:Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3EventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3EventBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3EventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm   = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_event_edit', array('id' => $id)));
        }

        return $this->render('ACInst3EventBundle:Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ACInst3EventBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_event'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
