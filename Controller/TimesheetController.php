<?php

namespace Karis\TimesheetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Karis\TimesheetBundle\Entity\Timesheet;
use Karis\TimesheetBundle\Form\Type\TimesheetType;

/**
 * Timesheet controller.
 *
 * @Route("/timesheet")
 */
class TimesheetController extends ContainerAware
{

    /**
     * Lists all Timesheet entities.
     *
     * @Route("/", name="karis_timesheet_timesheet")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entities = $em->getRepository('KarisTimesheetBundle:Timesheet')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Timesheet entity.
     *
     * @Route("/", name="karis_timesheet_timesheet_create")
     * @Method("POST")
     * @Template("KarisTimesheetBundle:Timesheet:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Timesheet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $em->persist($entity);
            $em->flush();

            return new RedirectResponse($this->container->get('router')->generate('karis_timesheet_timesheet_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Timesheet entity.
    *
    * @param Timesheet $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Timesheet $entity)
    {
        $form = $this->container->get('form.factory')->create(new TimesheetType(), $entity, array(
            'action' => $this->container->get('router')->generate('karis_timesheet_timesheet_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Timesheet entity.
     *
     * @Route("/new", name="karis_timesheet_timesheet_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Timesheet();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Timesheet entity.
     *
     * @Route("/{id}", name="karis_timesheet_timesheet_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entity = $em->getRepository('KarisTimesheetBundle:Timesheet')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Unable to find Timesheet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Timesheet entity.
     *
     * @Route("/{id}/edit", name="karis_timesheet_timesheet_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entity = $em->getRepository('KarisTimesheetBundle:Timesheet')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Unable to find Timesheet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Timesheet entity.
    *
    * @param Timesheet $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Timesheet $entity)
    {
        $form = $this->container->get('form.factory')->create(new TimesheetType(), $entity, array(
            'action' => $this->container->get('router')->generate('karis_timesheet_timesheet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Timesheet entity.
     *
     * @Route("/{id}", name="karis_timesheet_timesheet_update")
     * @Method("PUT")
     * @Template("KarisTimesheetBundle:Timesheet:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entity = $em->getRepository('KarisTimesheetBundle:Timesheet')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Unable to find Timesheet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return new RedirectResponse($this->container->get('router')->generate('karis_timesheet_timesheet_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Timesheet entity.
     *
     * @Route("/{id}", name="karis_timesheet_timesheet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $entity = $em->getRepository('KarisTimesheetBundle:Timesheet')->find($id);

            if (!$entity) {
                throw new NotFoundHttpException('Unable to find Timesheet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('karis_timesheet_timesheet'));
    }

    /**
     * Creates a form to delete a Timesheet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->container->get('form.factory')->createBuilder()
            ->setAction($this->container->get('router')->generate('karis_timesheet_timesheet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
