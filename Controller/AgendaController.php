<?php

namespace AltCloud\Instance3EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AltCloud\Instance3EventBundle\Entity\Agenda;
use AltCloud\Instance3EventBundle\Form\AgendaType;

/**
 * Agenda controller.
 *
 */
class AgendaController extends Controller
{
    /**
     *  Render an agenda partial.
     *
     */
	public function renderPartialAction($id, $displayoptions=false)
	{
			$agenda = $this->getDoctrine()
				->getRepository('ACInst3EventBundle:Agenda')
				->find($id);

			if (!$agenda) {
				throw $this->createNotFoundException('No Agenda found for id '.$id);
			}
		
        	return $this->render('ACInst3EventBundle:Agenda:renderPartial.html.twig', array(
    							 'agenda' => $agenda, 
    							 'tpl' => $tpl, 
    							 'node' => $node,
    							 'displayoptions' => $displayoptions));
    	}
    /**
     *  Render an agenda.
     *
     */
	public function renderAction($id, $node=false, $displayoptions=false)
	{
			$agenda = $this->getDoctrine()
				->getRepository('ACInst3EventBundle:Agenda')
				->find($id);

			if (!$agenda) {
				throw $this->createNotFoundException('No Agenda found for id '.$id);
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
		
        	return $this->render('ACInst3EventBundle:Agenda:render.html.twig', array(
    							 'agenda' => $agenda, 
    							 'tpl' => $tpl, 
    							 'node' => $node,
    							 'displayoptions' => $displayoptions));
    	}
    /**
     * Lists all Agenda entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ACInst3EventBundle:Agenda')->findAll();

        return $this->render('ACInst3EventBundle:Agenda:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Agenda entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3EventBundle:Agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agenda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3EventBundle:Agenda:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Agenda entity.
     *
     */
    public function newAction()
    {
        $entity = new Agenda();
        $form   = $this->createForm(new AgendaType(), $entity);

        return $this->render('ACInst3EventBundle:Agenda:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Agenda entity.
     *
     */
    public function createAction()
    {
        $entity  = new Agenda();
        $request = $this->getRequest();
        $form    = $this->createForm(new AgendaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_agenda_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ACInst3EventBundle:Agenda:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Agenda entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3EventBundle:Agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agenda entity.');
        }

        $editForm = $this->createForm(new AgendaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3EventBundle:Agenda:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Agenda entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3EventBundle:Agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agenda entity.');
        }

        $editForm   = $this->createForm(new AgendaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_agenda_edit', array('id' => $id)));
        }

        return $this->render('ACInst3EventBundle:Agenda:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Agenda entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ACInst3EventBundle:Agenda')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Agenda entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_agenda'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
