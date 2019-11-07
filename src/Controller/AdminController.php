<?php

namespace App\Controller;

use App\Entity\Golf;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/backoffice", name="backoffice")
     * @return Response
     */
    public function index()
    {
        return $this->render('backoffice/index.html.twig');
    }


    /**
     * @Route("/backoffice/golf", name="backoffice_golf")
     * @return Response
     */
    public function golfAdmin()
    {
        $golfs = $this->getDoctrine()->getManager()->getRepository(Golf::class)->findAll();

        return $this->render('backoffice/golfs.html.twig', [
            'golfs' => $golfs,
        ]);
    }


    /**
     * @Route("/backoffice/user", name="backoffice_user")
     * @return Response
     */
    public function userAdmin()
    {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

        return $this->render('backoffice/users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/backoffice/golf/add", name="add_golf")
     * @param Request $request
     * @return Response
     */
    public function addGolf(Request $request)
    {
        $golf = new Golf();
        $em = $this->getDoctrine()->getManager();
        $newName = $request->request->get('newGoflName');
        $newLocation = $request->request->get('newGoflLocation');
        $golf->setNom($newName)->setLieu($newLocation);

        $em->persist($golf);
        $em->flush();

        return $this->redirectToRoute('backoffice_golf');
    }

    /**
     * @Route("/backoffice/golf/remove/{id}", name="remove_golf")
     * @param $id
     * @return Response
     */
    public function removeGolf($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Golf::class)->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('backoffice_golf');
    }
}
