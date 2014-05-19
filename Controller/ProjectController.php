<?php

namespace Karis\TimesheetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Karis\TimesheetBundle\Entity\Project;
use Karis\TimesheetBundle\Form\Type\ProjectType;

/**
 * Project controller.
 *
 * @Route("/project")
 */
class ProjectController extends ContainerAware
{

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="karis_timesheet_project")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entities = $em->getRepository('KarisTimesheetBundle:Project')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Project entity.
     *
     * @Route("/", name="karis_timesheet_project_create")
     * @Method("POST")
     * @Template("KarisTimesheetBundle:Project:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Project();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $em->persist($entity);
            $em->flush();

            return new RedirectResponse($this->container->get('router')->generate('karis_timesheet_project_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Project entity.
    *
    * @param Project $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Project $entity)
    {
        $form = $this->container->get('form.factory')->create(new ProjectType(), $entity, array(
            'action' => $this->container->get('router')->generate('karis_timesheet_project_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Project entity.
     *
     * @Route("/new", name="karis_timesheet_project_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Project();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}", name="karis_timesheet_project_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entity = $em->getRepository('KarisTimesheetBundle:Project')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="karis_timesheet_project_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entity = $em->getRepository('KarisTimesheetBundle:Project')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Unable to find Project entity.');
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
    * Creates a form to edit a Project entity.
    *
    * @param Project $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Project $entity)
    {
        $form = $this->container->get('form.factory')->create(new ProjectType(), $entity, array(
            'action' => $this->container->get('router')->generate('karis_timesheet_project_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Project entity.
     *
     * @Route("/{id}", name="karis_timesheet_project_update")
     * @Method("PUT")
     * @Template("KarisTimesheetBundle:Project:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $entity = $em->getRepository('KarisTimesheetBundle:Project')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return new RedirectResponse($this->container->get('router')->generate('karis_timesheet_project_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Project entity.
     *
     * @Route("/{id}", name="karis_timesheet_project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $entity = $em->getRepository('KarisTimesheetBundle:Project')->find($id);

            if (!$entity) {
                throw new NotFoundHttpException('Unable to find Project entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('karis_timesheet_project'));
    }

    /**
     * Creates a form to delete a Project entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->container->get('form.factory')->createBuilder()
            ->setAction($this->container->get('router')->generate('karis_timesheet_project_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
