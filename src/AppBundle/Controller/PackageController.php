<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Package;
use AppBundle\Entity\TransferStatus;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Package controller.
 *
 * @Route("package")
 */
class PackageController extends Controller
{
    /**
     * Lists all package entities.
     *
     * @Route("/", name="package_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $packages = $em->getRepository('AppBundle:Package')->findAll();

        return $this->render('package/index.html.twig', array(
            'packages' => $packages,
        ));
    }

    /**
     * Creates a new package entity.
     *
     * @Route("/new", name="package_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $package = new Package();
        $form = $this->createForm('AppBundle\Form\PackageType', $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $username = $this->get('security.token_storage')->getToken()->getUsername();
            $user = $em->getRepository('AppBundle:User')->findOneByUsername($username);
            $package->setOwner($user);
            $em->persist($package);
            $em->flush();

            return $this->redirectToRoute('package_show', array('id' => $package->getId()));
        }

        return $this->render('package/new.html.twig', array(
            'package' => $package,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a package entity.
     *
     * @Route("/{id}", name="package_show")
     * @Method("GET")
     */
    public function showAction(Package $package)
    {
        $deleteForm = $this->createDeleteForm($package);

        return $this->render('package/show.html.twig', array(
            'package' => $package,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing package entity.
     *
     * @Route("/{id}/edit", name="package_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Package $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        $editForm = $this->createForm('AppBundle\Form\PackageType', $package);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('package_edit', array('id' => $package->getId()));
        }

        return $this->render('package/edit.html.twig', array(
            'package' => $package,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a package entity.
     *
     * @Route("/{id}", name="package_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Package $package)
    {
        $form = $this->createDeleteForm($package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($package);
            $em->flush();
        }

        return $this->redirectToRoute('package_index');
    }

    /**
     * Creates a form to delete a package entity.
     *
     * @param Package $package The package entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Package $package)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('package_delete', array('id' => $package->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing package entity.
     *
     * @Route("/change/transfer/status", name="change_package_transfer_status")
     * @Method({"POST"})
     */
    public function changeTransferStatusAction(Request $request)
    {
        $error = "";
        $em = $this->getDoctrine()->getManager();
        $selectPackage = $this->createFormBuilder(array('name' => 'search'))
            ->add('id', TextType::class, [
                'label' => 'Csomag azonosító'
            ])
            ->add('search', SubmitType::class, ['label' => 'Keresés'])
            ->getForm();

            $selectPackage->handleRequest($request);
            if($selectPackage->isSubmitted() && $selectPackage->isValid()){
                $id = $request->request->get('form')['id'];
                $package = $em->getRepository(Package::class)->find($id);
                $query = $em->createQuery("select ts from AppBundle:TransferStatus ts where ts.id > ".$package->getTransferStatus()->getId());
                $transferStatusArray = $query->getResult();
                if($package instanceof Package)
                {
                    $changeStatus = $this->createFormBuilder(array('name' => 'change'))
                        ->add('transferStatus', EntityType::class, [
                            'class' => 'AppBundle\Entity\TransferStatus',
                            'choices' => $transferStatusArray,
                            'choice_label' => 'name',
                            'label' => 'Szállító státusz'
                        ])
                        ->add('save', SubmitType::class, ['label' => 'Léptetés'])
                        ->getForm();

                    $changeStatus->handleRequest($request);
                    if ($changeStatus->isSubmitted() && $changeStatus->isValid()) {
                        $em->persist($package);
                        $em->flush();
                        $this->redirectToRoute('package_index');
                    }

                    return $this->render('processes/changePackageStatus.html.twig', array(
                        'package' => $package,
                        'form' => $changeStatus->createView()
                    ));
                }else{
                    $error = "A csomag nem létezik";
                }
            }
//        //print_r($editForm->isValid()); exit();
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em->persist($package);
//            $em->flush();
//            $this->redirectToRoute('package_index');
//        }

        return $this->render('processes/changePackageStatus.html.twig', array(
            'form' => $selectPackage->createView(),
            'error' => $error
        ));
    }
}
