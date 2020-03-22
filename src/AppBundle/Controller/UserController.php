<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 * @Route("admin/user")
 */
class UserController extends Controller
{
    /*public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }*/

    /**
     *
     * @Route("/set/storage", name="set_user_storage")
     *
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function setUserStorageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

       $form = $this->createFormBuilder()
                ->add("storage", EntityType::class, [
                "class" => Address::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.isStorage = 1');
                },
                'choice_label' => 'streetAndNumber',
                ]
            )
        ->add("submit", SubmitType::class, [
            "label" => "Beállít",
            "attr" => [
                "class" => "btn btn-primary"
            ]
        ])->getForm();

       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $em->getRepository("AppBundle:User")->findOneByUsername($this->getUser()->getUsername());
            $storage = $em->getRepository(Address::class)->find($request->request->get("form")["storage"]);
            $user->setStorage($storage);
            $em->persist($user);

            $em->flush();

            //return $this->redirectToRoute('package_edit', array('id' => $package->getId()));
        }


      return $this->render("processes/setStorage.html.twig", ["form" => $form->createView()]);

    }
}
