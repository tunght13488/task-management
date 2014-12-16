<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class TaskController
 *
 * @package AppBundle\Controller
 *
 * @Route("/tasks")
 */
class TaskController extends Controller
{
    /**
     * @Route("/", name="app.task.index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Task:index.html.twig');
    }

    /**
     * @Route("/new", name="app.task.new")
     * @Method("GET")
     */
    public function newAction()
    {
        return $this->render('AppBundle:Task:new.html.twig');
    }

    /**
     * @Route("/create", name="app.task.create")
     * @Method("POST")
     */
    public function createAction()
    {
        $id = 123;

        return $this->redirect($this->generateUrl('app.task.edit', array('id' => $id)));
    }

    /**
     * @Route("/{id}", name="app.task.edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        return $this->render('AppBundle:Task:edit.html.twig', array(
            'id' => $id,
        ));
    }

    /**
     * @Route("/{id}/update", name="app.task.update")
     * @Method("POST")
     */
    public function updateAction($id)
    {
        return $this->redirect($this->generateUrl('app.task.edit', array('id' => $id)));
    }

    /**
     * @Route("/{id}/delete", name="app.task.delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        return $this->redirect($this->generateUrl('app.task.index'));
    }
}
