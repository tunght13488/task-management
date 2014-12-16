<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Repository\TaskRepository;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class TaskController
 *
 * @package AppBundle\Controller
 *
 * @Route("/")
 */
class TaskController extends Controller
{
    /**
     * @Route("/", name="app.task.index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /** @var TaskRepository $repository */
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $tasks = $repository->findAll();

        return $this->render('AppBundle:Task:index.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    /**
     * @Route("/new", name="app.task.new")
     */
    public function newAction()
    {
        $task = new Task();

        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($this->getRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('app.task.edit', array('id' => $task->getId())));
        }

        return $this->render('AppBundle:Task:form.html.twig', array(
            'title' => 'Create new task',
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="app.task.edit")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $task = $em->getRepository('AppBundle:Task')->find($id);
        if (!$task) {
            throw $this->createNotFoundException('Task not found. ID: '.$id);
        }

        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($this->getRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('app.task.edit', array('id' => $task->getId())));
        }

        return $this->render('AppBundle:Task:form.html.twig', array(
            'title' => 'Edit task '.$id,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="app.task.delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);

        return $this->redirect($this->generateUrl('app.task.index'));
    }

    /**
     * @Route("/{id}/status/{status}", name="app.task.status")
     */
    public function statusAction($id, $status)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Task $task */
        $task = $em->getRepository('AppBundle:Task')->find($id);
        if (!$task) {
            throw $this->createNotFoundException('Task not found. ID: '.$id);
        }
        $task->setStatus($status);
        $em->flush();

        return $this->redirect($this->generateUrl('app.task.index'));
    }
}
