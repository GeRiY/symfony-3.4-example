<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PackageStatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Packagestatus controller.
 *
 * @Route("packagestatus")
 */
class PackageStatusController extends Controller
{
    /**
     * Lists all packageStatus entities.
     *
     * @Route("/", name="packagestatus_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $packageStatuses = $em->getRepository('AppBundle:PackageStatus')->findAll();

        return $this->render('packagestatus/index.html.twig', array(
            'packageStatuses' => $packageStatuses,
        ));
    }

    /**
     * Creates a new packageStatus entity.
     *
     * @Route("/new", name="packagestatus_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $packageStatus = new Packagestatus();
        $form = $this->createForm('AppBundle\Form\PackageStatusType', $packageStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($packageStatus);
            $em->flush();

            return $this->redirectToRoute('packagestatus_show', array('id' => $packageStatus->getId()));
        }

        return $this->render('packagestatus/new.html.twig', array(
            'packageStatus' => $packageStatus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a packageStatus entity.
     *
     * @Route("/{id}", name="packagestatus_show")
     * @Method("GET")
     */
    public function showAction(PackageStatus $packageStatus)
    {
        $deleteForm = $this->createDeleteForm($packageStatus);

        return $this->render('packagestatus/show.html.twig', array(
            'packageStatus' => $packageStatus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing packageStatus entity.
     *
     * @Route("/{id}/edit", name="packagestatus_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PackageStatus $packageStatus)
    {
        $deleteForm = $this->createDeleteForm($packageStatus);
        $editForm = $this->createForm('AppBundle\Form\PackageStatusType', $packageStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('packagestatus_edit', array('id' => $packageStatus->getId()));
        }

        return $this->render('packagestatus/edit.html.twig', array(
            'packageStatus' => $packageStatus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a packageStatus entity.
     *
     * @Route("/{id}", name="packagestatus_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PackageStatus $packageStatus)
    {
        $form = $this->createDeleteForm($packageStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($packageStatus);
            $em->flush();
        }

        return $this->redirectToRoute('packagestatus_index');
    }

    /**
     * Creates a form to delete a packageStatus entity.
     *
     * @param PackageStatus $packageStatus The packageStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PackageStatus $packageStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('packagestatus_delete', array('id' => $packageStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
